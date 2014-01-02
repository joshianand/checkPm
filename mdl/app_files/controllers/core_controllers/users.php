<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for users
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Users extends G_controller {

    public function __construct() {
        parent::__construct(get_class());

        $this->load->model('core_models/system_management/Model_users', 'users');
        $this->load->model('core_models/system_management/Model_user_groups', 'usergroups');
    }

    /**
     * <p style="text-align:justify">
     * Display list page
     * </p>
     * @access public
     */
    public function index() {
        $page_data['token'] = $this->token;
        $this->construct_ui();

        $this->template->write_view('content', 'core_views/system_management/comp_users', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing user list making
     * </p>
     * @access public
     */
    public function GetUsers() {
        if (IS_AJAX) {
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sortData = $this->input->get('sort', TRUE);

            $sort_direction = ( $sortData[0]['dir'] == '') ? 'desc' : $sortData[0]['dir'];
            $sort_field = ( $sortData[0]['field'] == '') ? 'user_id' : $sortData[0]['field'];

            $data['users'] = $this->users->get_users($limit, $offset, $sort_direction, $sort_field);
            $data['count'] = $this->users->count_users();

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Display add new user page
     * </p>
     * @access public
     */
    public function add_new_user() {
        $this->construct_ui();
        $page_data['token'] = $this->token;
        $page_data['tid'] = $this->user_data['tid'];
        $page_data['header'] = 'Add new user';
        $page_data['action'] = 'add';
        $page_data['user_id'] = '';
        $page_data['user_details'] = $this->users->get_user_details(0);
        $page_data['user_groups'] = $this->users->get_user_groups();

        $this->template->write_view('content', 'core_views/system_management/form_users', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Display edit user page
     * </p>
     * @access public
     */
    public function edit_user() {
        $enc_user_id = $this->input->get('item', TRUE);
        $user_id = $this->encrypt->decode($enc_user_id);

        $this->construct_ui();
        $page_data['token'] = $this->token;
        $page_data['tid'] = $this->user_data['tid'];
        $page_data['header'] = 'Edit user';
        $page_data['action'] = 'edit';
        $page_data['user_id'] = $enc_user_id;
        $page_data['user_details'] = $this->users->get_user_details($user_id);
        $page_data['user_groups'] = $this->users->get_user_groups();

        $this->template->write_view('content', 'core_views/system_management/form_users', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing new user save
     * </p>
     * @access public
     */
    public function SaveUser() {
        if (IS_AJAX) {
            $user_login = array(
                'group_id' => $this->encrypt->decode($this->input->post('GroupSelection', TRUE)),
                'user_first_name' => trim($this->input->post('FirstName', TRUE)),
                'user_last_name' => trim($this->input->post('LastName', TRUE)),
                'login_name' => trim($this->input->post('LoginName', TRUE)),
                'login_pass' => trim($this->input->post('LoginPass', TRUE)),
                'image_name' => '',
                'is_active' => $this->input->post('active', TRUE)
            );

            $user_contact = array(
                'address' => trim($this->input->post('Address', TRUE)),
                'city' => trim($this->input->post('City', TRUE)),
                'state' => trim($this->input->post('State', TRUE)),
                'zip' => trim($this->input->post('Zip', TRUE)),
                'country' => trim($this->input->post('Country', TRUE)),
                'email' => trim($this->input->post('Email', TRUE)),
                'phone' => trim($this->input->post('Phone', TRUE)),
                'mobile' => trim($this->input->post('Mobile', TRUE)),
                'is_active' => 'yes'
            );


            $output_result = array();
            $validation_result = $this->validate_user('add', 0, $user_login, $user_contact);

            if ($validation_result == '') {
                $raw_pass = $user_login['login_pass'];
                $user_login['login_pass'] = generate_password($raw_pass);

                $update_result = $this->users->update_users($user_login, $user_contact);
                if ($update_result === TRUE) {
                    $email_data = array(
                        'user_name' => $user_login['user_first_name'] . ' ' . $user_login['user_last_name'],
                        'login_url' => base_url(),
                        'login_name' => $user_login['login_name'],
                        'login_pass' => $raw_pass
                    );

                    send_custom_email('user_registration', $user_contact['email'], '', 'Account created', $email_data);

                    $output_result['flag'] = 1;
                    $output_result['message'] = 'User created successfully.';
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = 'An error occured while creating user.';
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
     * Processing user update
     * </p>
     * @access public
     */
    public function UpdateUser() {
        if (IS_AJAX) {
            $posted_user_id = $this->input->post('user_id', TRUE);
            $user_id = $this->encrypt->decode($posted_user_id);
            $output_result = array();

            if ($this->users->is_valid_user_id($user_id)) {
                $user_login = array(
                    'group_id' => $this->encrypt->decode($this->input->post('GroupSelection', TRUE)),
                    'user_first_name' => trim($this->input->post('FirstName', TRUE)),
                    'user_last_name' => trim($this->input->post('LastName', TRUE)),
                    'is_active' => $this->input->post('active', TRUE)
                );

                $user_contact = array(
                    'address' => trim($this->input->post('Address', TRUE)),
                    'city' => trim($this->input->post('City', TRUE)),
                    'state' => trim($this->input->post('State', TRUE)),
                    'zip' => trim($this->input->post('Zip', TRUE)),
                    'country' => trim($this->input->post('Country', TRUE)),
                    'email' => trim($this->input->post('Email', TRUE)),
                    'phone' => trim($this->input->post('Phone', TRUE)),
                    'mobile' => trim($this->input->post('Mobile', TRUE)),
                    'is_active' => 'yes'
                );

                $validation_result = $this->validate_user('edit', $user_id, $user_login, $user_contact);
                if ($validation_result == '') {
                    $update_result = $this->users->update_users($user_login, $user_contact, 0, $user_id);
                    if ($update_result == TRUE) {
                        $output_result['flag'] = 1;
                        $output_result['message'] = 'User updated successfully.';
                    } else {
                        $output_result['flag'] = 0;
                        $output_result['message'] = 'An error occured while updating user. Please contact with administrator.';
                    }
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = $validation_result;
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = 'Sorry, given user information not found';
            }

            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing user delete
     * </p>
     * @access public
     */
    public function DeleteUser() {
        if (IS_AJAX) {
            $posted_user_id = $this->input->post('user_id', TRUE);
            $user_id = $this->encrypt->decode($posted_user_id);

            $output_result = array();
            if ($this->users->is_valid_user_id($user_id)) {
                $delete_result = $this->users->update_users(NULL, NULL, -1, $user_id);
                if ($delete_result === TRUE) {
                    $output_result['flag'] = 1;
                    $output_result['message'] = 'User deleted successfully.';
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = 'An error occured while deleteing user. Please contact with administrator.';
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = 'Invalid user given. Please select a valid user.';
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing user credential reset
     * </p>
     * @access public
     */
    public function ResetCredentials() {
        if (IS_AJAX) {
            $posted_user_id = $this->input->post('user_id', TRUE);
            $user_id = $this->encrypt->decode($posted_user_id);

            $output_result = array();
            if ($this->users->is_valid_user_id($user_id)) {
                $raw_pass = get_random_password(5);
                $new_pass = generate_password($raw_pass);

                $update_result = $this->users->reset_credential($user_id, $new_pass);
                if ($update_result === TRUE) {
                    $user_data = $this->shared->get_user_data($user_id);

                    $email_data = array(
                        'user_name' => element('full_name', $user_data),
                        'login_url' => base_url(),
                        'login_name' => element('login_name', $user_data),
                        'login_pass' => $raw_pass
                    );

                    send_custom_email('pass_reset', element('email', $user_data), '', 'Password Reset', $email_data);

                    $output_result['flag'] = 1;
                    $output_result['message'] = 'User password reset successfully. User will be notified via email.';
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = 'An error occured while updating user password. Please contact with administrator.';
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = 'Invalid user given. Please select a valid user.';
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Validate user data
     * </p>
     * @access protected
     * @param string $type Type of validation either add or edit
     * @param int $user_id User id
     * @param array $user_login User login data
     * @param array $user_contact User contact data
     * @return string Returns empty string if validation succeed otherwise validation message
     */
    protected function validate_user($type = 'add', $user_id = 0, $user_login = array(), $user_contact = array()) {
        if ($type == 'add') {
            if ($this->usergroups->is_valid_group_id($user_login['group_id']) == FALSE) {
                return 'Invalid group selected. Please select a valid user group.';
            } else if (trim($user_login['login_name']) == FALSE) {
                return 'Please provide the login name.';
            } else if ($this->users->is_duplicate_login_name($user_id, $user_login['login_name'])) {
                return 'Duplicate login name found. Please choose another login name.';
            } else if (trim($user_login['login_pass']) == FALSE) {
                return 'Please provide login password.';
            } else if (trim($user_login['user_first_name']) == FALSE && trim($user_login['user_last_name']) == FALSE) {
                return 'Please provide user name.';
            } else if (!filter_var($user_contact['email'], FILTER_VALIDATE_EMAIL)) {
                return 'Please provide valid email address.';
            } else if ($this->users->is_duplicate_user_contact($user_id, $user_contact['email'])) {
                return 'Duplicate email address found. Please provide another email address.';
            } else {
                return '';
            }
        } else {
            if ($this->usergroups->is_valid_group_id($user_login['group_id']) == FALSE) {
                return 'Invalid group selected. Please select a valid user group.';
            } else if (trim($user_login['user_first_name']) == FALSE && trim($user_login['user_last_name']) == FALSE) {
                return 'Please provide user name.';
            } else if (!filter_var($user_contact['email'], FILTER_VALIDATE_EMAIL)) {
                return 'Please provide valid email address.';
            } else if ($this->users->is_duplicate_user_contact($user_id, $user_contact['email'])) {
                return 'Duplicate email address found. Please provide another email address.';
            } else {
                return '';
            }
        }
    }

}

