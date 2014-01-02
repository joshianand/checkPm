<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for user groups
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Usergroups extends G_controller {

    public function __construct() {
        parent::__construct(get_class());
        $this->load->model('core_models/system_management/Model_user_groups', 'usergroups');
    }
    
    /**
     * <p style="text-align:justify">
     * Display list page
     * </p>
     * @access public
     */
    public function index() {
        $this->construct_ui();
        $page_data['token'] = $this->token;
        $this->template->write_view('content', 'core_views/system_management/comp_user_groups', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing user list making
     * </p>
     * @access public
     */
    public function GetUserGroups() {
        if (IS_AJAX) {
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sortData = $this->input->get('sort', TRUE);

            $sortDirection = ( $sortData[0]['dir'] == '') ? 'desc' : $sortData[0]['dir'];
            $sortField = ( $sortData[0]['field'] == '') ? 'group_name' : $sortData[0]['field'];

            $data['groups'] = $this->usergroups->get_user_groups($limit, $offset, $sortDirection, $sortField);
            $data['count'] = $this->usergroups->count_user_groups();

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Display add new user group page
     * </p>
     * @access public
     */
    public function add_new_group() {
        $this->construct_ui();
        $page_data['token'] = $this->token;
        $page_data['tid'] = $this->user_data['tid'];
        $page_data['header'] = 'Add user group';
        $page_data['action'] = 'add';
        $page_data['group_id'] = '';
        $page_data['group_details'] = $this->usergroups->get_group_details(0);
        $page_data['group_tasks'] = $this->usergroups->get_group_tasks(0);

        $this->template->write_view('content', 'core_views/system_management/form_user_groups', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Display edit user group page
     * </p>
     * @access public
     */
    public function edit_group() {
        $enc_group_id = $this->input->get('item', TRUE);
        $group_id = $this->encrypt->decode($enc_group_id);

        $this->construct_ui();
        $page_data['token'] = $this->token;
        $page_data['tid'] = $this->user_data['tid'];
        $page_data['header'] = 'Edit user group';
        $page_data['action'] = 'edit';
        $page_data['group_id'] = $enc_group_id;
        $page_data['group_details'] = $this->usergroups->get_group_details($group_id);
        $page_data['group_tasks'] = $this->usergroups->get_group_tasks($group_id);

        $this->template->write_view('content', 'core_views/system_management/form_user_groups', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing new user group save
     * </p>
     * @access public
     */
    public function SaveUserGroup() {
        if (IS_AJAX) {
            $group_name = trim($this->input->post('GroupName', TRUE));
            $active = $this->input->post('active', TRUE);
            $task_array = json_decode($this->input->post('task', TRUE));
            $tasks = array();

            foreach ($task_array as $value) {
                array_push($tasks, $this->encrypt->decode($value));
            }

            $output_result = array();
            $validation_result = $this->validate_group(0, $group_name, $tasks);

            if ($validation_result == '') {
                $update_result = $this->usergroups->update_group($group_name, $active, $tasks, 1);
                if ($update_result === TRUE) {
                    $output_result['flag'] = 1;
                    $output_result['message'] = 'User group saved successfully.';
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = 'An error occured while saving user group. Please contact with administrator.';
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = $validation_result;
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing user group update
     * </p>
     * @access public
     */
    public function UpdateUserGroup() {
        if (IS_AJAX) {
            $posted_group_id = $this->input->post('group_id', TRUE);

            $group_id = $this->encrypt->decode($posted_group_id);
            $group_name = trim($this->input->post('GroupName', TRUE));
            $active = $this->input->post('active', TRUE);

            $task_array = json_decode($this->input->post('task', TRUE));
            $tasks = array();
            foreach ($task_array as $value) {
                array_push($tasks, $this->encrypt->decode($value));
            }

            $output_result = array();
            $validation_result = $this->validate_group($group_id, $group_name, $tasks);

            if ($validation_result == '') {
                $update_result = $this->usergroups->update_group($group_name, $active, $tasks, 0, $group_id);
                if ($update_result === TRUE) {
                    $output_result['flag'] = 1;
                    $output_result['message'] = 'User group updated successfully.';
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = 'An error occured while updating user group.';
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = $validation_result;
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing user group delete
     * </p>
     * @access public
     */
    public function DeleteUserGroup() {
        if (IS_AJAX) {
            $enc_group_id = $this->input->post('group_id', TRUE);
            $group_id = $this->encrypt->decode($enc_group_id);

            $output_result = array();
            if ($this->usergroups->is_valid_group_id($group_id)) {
                $delete_result = $this->usergroups->update_group('', '', NULL, -1, $group_id);
                if ($delete_result === TRUE) {
                    $output_result['flag'] = 1;
                    $output_result['message'] = 'User group deleted successfully.';
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = 'An error occured while deleting user group. Please contact with administrator.';
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = 'Invalid group information given. Please select a valid group. Click here to close this message';
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Validate user group
     * </p>
     * @access protected
     * @param int $group_id Group id
     * @param string $group_name Group name
     * @param array $tasks Task details array
     * @return string Returns empty string if validation succeed otherwise validation message
     */
    protected function validate_group($group_id = 0, $group_name = '', $tasks = array()) {
        if ($group_id != 0) {
            if ($this->usergroups->is_valid_group_id($group_id) == FALSE) {
                return 'Invalid group information given. Please select a valid group.';
            }
        } else if (trim($group_name) == FALSE) {
            return 'No group name given. Please provide the group name.';
        } else if ($this->usergroups->is_duplicate_group_name($group_id, $group_name)) {
            return 'Duplicate group name found. Please choose another group name.';
        } else if (count($tasks) <= 0) {
            return 'No task is selected. Please select some task.';
        } else {
            return '';
        }
    }

}

