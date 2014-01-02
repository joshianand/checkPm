<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for shared and common purpose
 * </p>
 * @package Core
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Model_shared extends G_model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * <p style="text-align:justify">
     * Get user detail
     * </p>
     * @access public
     * @param int $user_id User id
     * @return array Returns user details array.
     */
    public function get_user_data($user_id = 0) {
        $this->db->select('g_logins.user_first_name as first_name,
                           g_logins.user_last_name as last_name,
                           g_user_contacts.email as email,
                           g_logins.login_name as login_name');
        $this->db->from('g_logins');

        $this->db->join('g_user_contacts', 'g_logins.id = g_user_contacts.login_id');

        $this->db->where('g_user_contacts.login_id', $user_id);

        $query = $this->db->get();
        $result = $query->row_array();
        $result['full_name'] = $result['first_name'] . ' ' . $result['last_name'];

        return $result;
    }

    /**
     * <p style="text-align:justify">
     * Validate user login
     * </p>
     * @access public
     * @param string $login_name Login name
     * @return array Returns user data
     */
    public function validate_login($login_name = '') {
        $this->db->select('g_logins.id as user_id,
                           g_logins.user_first_name as first_name,
                           g_logins.user_last_name as last_name,
                           g_logins.login_name as login_name,
                           g_logins.login_pass as login_pass,
                           g_logins.image_name as login_image,
                           g_user_groups.id as group_id,
                           g_user_groups.group_name as group_name,
                           g_logins.is_active as active');

        $this->db->from('g_logins');
        $this->db->join('g_user_groups', 'g_logins.group_id = g_user_groups.id');

        $this->db->where('g_logins.login_name', $login_name);

        $query = $this->db->get();
        $result = $query->row_array();

        if (count($result) > 0) {
            $result['user_name'] = $result['first_name'] . ' ' . $result['last_name'];
        }
        return $result;
    }

    /**
     * <p style="text-align:justify">
     * Get menu items
     * </p>
     * @access public
     * @param int $group_id Group id
     * @return array Returns menu item array
     */
    public function get_menu_items($group_id = 1) {
        $menu_model = array();

        $this->db->select('g_system_tasks.id as task_id,
                           g_system_tasks.task_name as task_name,
                           g_system_tasks.controller_name as controller_name,
                           g_system_tasks.function_name as function_name');
        $this->db->from('g_system_tasks');

        $this->db->where('g_system_tasks.category', 'Menu');
        $this->db->where('g_system_tasks.parent_task_id', 0);
        $this->db->where('g_system_tasks.is_active', 'yes');

        $this->db->order_by('g_system_tasks.sorting_order', 'asc');

        $parent_menus = $this->db->get();
        if ($parent_menus->num_rows() > 0) {
            foreach ($parent_menus->result_array() as $parent_row) {
                $data['parent_name'] = element('task_name', $parent_row);
                $data['parent_controller_name'] = element('controller_name', $parent_row);
                $data['parent_function_name'] = element('function_name', $parent_row);
                $data['parent_items'] = array();

                $this->db->select('g_system_tasks.id as child_id,
                                   g_system_tasks.task_name as child_name,
                                   g_system_tasks.controller_name as child_controller,
                                   g_system_tasks.function_name as child_function');
                $this->db->from('g_system_tasks');

                if ($group_id > 2) {
                    $this->db->join('g_group_tasks', 'g_system_tasks.id = g_group_tasks.task_id');
                    $this->db->where('g_group_tasks.group_id', $group_id);
                }

                $this->db->where('g_system_tasks.parent_task_id', $parent_row['task_id']);
                $this->db->where('g_system_tasks.is_active', 'yes');

                $this->db->order_by('g_system_tasks.sorting_order', 'asc');

                $child_menus = $this->db->get();

                if ($child_menus->num_rows() > 0) {
                    foreach ($child_menus->result_array() as $child_row) {
                        $child_id = $this->encrypt->encode($child_row['child_id']);
                        $child_row['child_link'] = site_url($child_row['child_controller'] . "/" . $child_row['child_function'] . "?tid=$child_id");
                        array_push($data['parent_items'], $child_row);
                    }
                }
                array_push($menu_model, $data);
            }
        }

        return $menu_model;
    }

    /**
     * <p style="text-align:justify">
     * Get task details
     * </p>
     * @access public
     * @param int $task_id Task id
     * @return array Returns task item details array
     */
    public function get_task_details($task_id = 0) {
        $data = array();
        
        $this->db->select('g_system_tasks.parent_task_id,
                           g_system_tasks.task_name,
                           g_system_tasks.controller_name,
                           g_system_tasks.function_name,
                           g_system_tasks.parent_task_id');
        $this->db->from('g_system_tasks');

        $this->db->where('g_system_tasks.id', $task_id);

        $query = $this->db->get();

        $row = $query->row_array();

        $data['task_name'] = $row['task_name'];
        $data['task_link'] = site_url($row['controller_name'] . "/" . $row['function_name'] . "?tid=$task_id");

        $parent_id = $row['parent_task_id'];
        if ($parent_id > 0) {
            $this->db->select('g_system_tasks.task_name');
            $this->db->from('g_system_tasks');

            $this->db->where('g_system_tasks.id', $parent_id);

            $query = $this->db->get();
            
            $row = $query->row_array();
            
            $data['parent_task_name'] = $row['task_name'];
        }
        
        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Check task accessibility
     * </p>
     * @access public
     * @param int $task_id Task id
     * @param int $group_id Group id
     * @return boolean Returns TRUE if accessible otherwise FALSE
     */
    public function is_accessible($task_id = 0, $group_id = 1) {
        if ($group_id == 1 || $group_id == 2) {
            return TRUE;
        } else {
            $this->db->join('g_system_tasks', 'g_group_tasks.task_id = g_system_tasks.id');
            $this->db->where('g_system_tasks.id', $task_id);
            $this->db->where('g_system_tasks.is_active', 'yes');
            $this->db->where('g_group_tasks.group_id', $group_id);

            $count = $this->db->count_all_results('g_group_tasks');

            if ($count == 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}

