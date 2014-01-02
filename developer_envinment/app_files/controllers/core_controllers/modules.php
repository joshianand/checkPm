<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for task modules
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Modules extends G_controller {

    public function __construct() {
        parent::__construct(get_class());

        $this->load->model('core_models/system_management/Model_modules', 'modules');
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
        $this->template->write_view('content', 'core_views/system_management/comp_modules', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing module list making
     * </p>
     * @access public
     */
    public function GetModules() {
        if (IS_AJAX) {
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $enc_parent_id = $this->input->get('parent_id', TRUE);
            $parent_id = trim($enc_parent_id) == FALSE ? 0 : $this->encrypt->decode($enc_parent_id);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'desc' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'module_id' : $sort_data[0]['field'];

            $data['modules'] = $this->modules->get_modules($parent_id, $limit, $offset, $sort_direction, $sort_field);
            $data['count'] = $this->modules->count_modules($parent_id);

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing new module save
     * </p>
     * @access public
     */
    public function CreateModules() {
        if (IS_AJAX) {
            $enc_parent_id = $this->input->post('parent_id', TRUE);
            $parent_id = trim($enc_parent_id) == FALSE ? 0 : $this->encrypt->decode($enc_parent_id);

            $module_data = array(
                'task_name' => $this->input->post('task_name', TRUE),
                'parent_task_id' => $parent_id,
                'controller_name' => $this->input->post('controller_name', TRUE),
                'function_name' => $this->input->post('function_name', TRUE),
                'sorting_order' => $this->input->post('sorting_order', TRUE),
                'category' => 'Menu',
                'is_active' => $this->input->post('active', TRUE) == 'true' ? 'yes' : 'no'
            );

            $validation_result = $this->validate_modules(0, $module_data);
            if ($validation_result == '') {
                $update_result = $this->modules->update_module($module_data);
                if ($update_result === TRUE) {
                    if ($module_data['parent_task_id'] == 0) {
                        $this->create_code_dirs('', $module_data['task_name']);
                    }
                    echo "1*Module saved successfully.";
                } else {
                    echo "0*An error occur while saving module. Contact with administrator";
                }
            } else {
                echo "0*$validation_result";
            }
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing module update
     * </p>
     * @access public
     */
    public function UpdateModule() {
        if (IS_AJAX) {
            $enc_parent_id = $this->input->post('parent_id', TRUE);
            $parent_id = trim($enc_parent_id) == FALSE ? 0 : $this->encrypt->decode($enc_parent_id);

            $enc_module_id = $this->input->post('module_id', TRUE);
            $module_id = $this->encrypt->decode($enc_module_id);

            $old_folder_name = $this->input->post('folder_name', TRUE);
            
            $module_data = array(
                'task_name' => $this->input->post('task_name', TRUE),
                'parent_task_id' => $parent_id,
                'controller_name' => $this->input->post('controller_name', TRUE),
                'function_name' => $this->input->post('function_name', TRUE),
                'sorting_order' => $this->input->post('sorting_order', TRUE),
                'category' => 'Menu',
                'is_active' => $this->input->post('active', TRUE) == 'true' ? 'yes' : 'no'
            );

            $validation_result = $this->validate_modules($module_id, $module_data);
            if ($validation_result == '') {
                $update_result = $this->modules->update_module($module_data, 0, $module_id);
                if ($update_result === TRUE) {
                    if ($module_data['parent_task_id'] == 0) {
                        $this->create_code_dirs($old_folder_name, $module_data['task_name']);
                    }
                    
                    echo "1*Module updated successfully.";
                } else {
                    echo "0*An error occur while updating module. Contact with administrator";
                }
            } else {
                echo "0*$validation_result";
            }
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing module delete
     * </p>
     * @access public
     */
    public function DeleteModule() {
        if (IS_AJAX) {
            $enc_module_id = $this->input->post('module_id', TRUE);
            $module_id = $this->encrypt->decode($enc_module_id);
            
            $folder_name = $this->input->post('folder_name', TRUE);
            
            $update_result = $this->modules->update_module(NULL, -1, $module_id);
            if ($update_result === TRUE) {
                $this->remove_code_dirs($folder_name);
                echo "1*Module deleted successfully.";
            } else {
                echo "0*An error occur while deleting module.";
            }
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Validate module
     * </p>
     * @access protected
     * @param int $task_id Task id
     * @param array $module_data Module data array
     * @return string Returns empty string if validation succeed otherwise validation message
     */
    protected function validate_modules($task_id = 0, $module_data = array()) {
        if ($this->modules->is_duplicate_task_name($task_id, $module_data['task_name'])) {
            return 'Duplicate name found. Please choose another name';
        } else if ($this->modules->is_duplicate_controller_name($task_id, $module_data['controller_name']) && $module_data['controller_name'] != '') {
            return 'Duplicate controller name found. Please choose another name';
        } else {
            return '';
        }
    }

    /**
     * <p style="text-align:justify">
     * Create code directories
     * </p>
     * @access protected
     * @param string $old_folder_name Source folder name
     * @param string $new_folder_name Destination folder name
     */
    protected function create_code_dirs($old_folder_name = '', $new_folder_name = '') {
        $dst_name = strtolower(str_replace(' ', '_', $new_folder_name));

        if ($old_folder_name != '') {
            $src_name = strtolower(str_replace(' ', '_', $old_folder_name));
            
            rename(APPPATH . "models/module_models/$src_name" , APPPATH . "models/module_models/$dst_name");
            rename(APPPATH . "views/module_views/$src_name", APPPATH . "views/module_views/$dst_name");
            rename(APPPATH . "helpers/modules/$src_name" , APPPATH . "helpers/modules/$dst_name");
            rename(APPPATH . "libraries/module_libraries/$src_name" , APPPATH . "libraries/module_libraries/$dst_name");
            rename(FCPATH . "scripts/module_scripts/$src_name" , APPPATH . "scripts/module_scripts/$dst_name");
            rename(FCPATH . "styles/module_styles/$src_name" , APPPATH . "styles/module_styles/$dst_name");
            rename(FCPATH . "images/module_images/$src_name" , APPPATH . "styles/module_images/$dst_name");
            rename(FCPATH . "public_uploads/module_files/$src_name" , APPPATH . "public_uploads/module_files/$dst_name");
        } else {
            mkdir(APPPATH . "models/module_models/$dst_name");
            mkdir(APPPATH . "views/module_views/$dst_name");
            mkdir(APPPATH . "helpers/modules/$dst_name");
            mkdir(APPPATH . "libraries/module_libraries/$dst_name");
            mkdir(FCPATH . "scripts/module_scripts/$dst_name");
            mkdir(FCPATH . "styles/module_styles/$dst_name");
            mkdir(FCPATH . "images/module_images/$dst_name");
            mkdir(FCPATH . "public_uploads/module_files/$dst_name");
        }
    }

    /**
     * <p style="text-align:justify">
     * Remove code directories
     * </p>
     * @access protected
     * @param string $folder_name Destination folder name
     */
    protected function remove_code_dirs($folder_name = ''){
        recursive_remove_directory(APPPATH . "models/module_models/$folder_name", TRUE);
        recursive_remove_directory(APPPATH . "views/module_views/$folder_name", TRUE);
        recursive_remove_directory(APPPATH . "helpers/modules/$folder_name", TRUE);
        recursive_remove_directory(APPPATH . "libraries/module_libraries/$folder_name", TRUE);
        recursive_remove_directory(FCPATH . "scripts/module_scripts/$folder_name", TRUE);
        recursive_remove_directory(FCPATH . "styles/module_styles/$folder_name", TRUE);
        recursive_remove_directory(FCPATH . "images/module_images/$folder_name", TRUE);
        recursive_remove_directory(FCPATH . "public_uploads/module_files/$folder_name", TRUE);
        
        rmdir(APPPATH . "models/module_models/$folder_name");
        rmdir(APPPATH . "views/module_views/$folder_name");
        rmdir(APPPATH . "helpers/modules/$folder_name");
        rmdir(APPPATH . "libraries/module_libraries/$folder_name");
        rmdir(FCPATH . "scripts/module_scripts/$folder_name");
        rmdir(FCPATH . "styles/module_styles/$folder_name");
        rmdir(FCPATH . "images/module_images/$folder_name");
        rmdir(FCPATH . "public_uploads/module_files/$folder_name");
    }
}

