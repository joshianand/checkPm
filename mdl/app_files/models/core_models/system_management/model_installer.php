<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for module installer
 * </p>
 * @package Core
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Model_installer extends G_model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * <p style="text-align:justify">
     * Get installed modules
     * </p>
     * @access public
     * @param type $limit Limit value
     * @param type $offset Offset value
     * @param type $sort_direction Sort direction
     * @param type $sort_field Sort field
     * @return array Returns Installed module array
     */
    public function get_modules($limit = 10, $offset = 0, $sort_direction = 'desc', $sort_field = 'module_id') {
        $data = array();

        $this->db->select('g_installed_modules.id as module_id,
                           g_installed_modules.task_id as task_id,
                           g_installed_modules.module_name,
                           g_installed_modules.developer_name,
                           g_installed_modules.installed_date,
                           g_installed_modules.developed_date,
                           g_installed_modules.developer_email,
                           g_installed_modules.developer_contact,
                           g_installed_modules.`version` as version,
                           g_installed_modules.is_active');
        $this->db->from('g_installed_modules');


        switch ($sort_field) {
            case 'module_name':
                $this->db->order_by('g_installed_modules.module_name', $sort_direction);
                break;

            case 'developer_name':
                $this->db->order_by('g_installed_modules.developer_name', $sort_direction);
                break;

            case 'installed_date':
                $this->db->order_by('g_installed_modules.installed_date', $sort_direction);
                break;

            case 'developed_date':
                $this->db->order_by('g_installed_modules.developed_date', $sort_direction);
                break;

            case 'developer_email':
                $this->db->order_by('g_installed_modules.developer_email', $sort_direction);
                break;

            case 'developer_contact':
                $this->db->order_by('g_installed_modules.developer_contact', $sort_direction);
                break;

            case 'version':
                $this->db->order_by('g_installed_modules.`version`', $sort_direction);
                break;
            
            case 'is_active':
                $this->db->order_by('g_installed_modules.is_active', $sort_direction);
                break;
            
            default:
                $this->db->order_by('g_installed_modules.id', 'desc');
                break;
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['module_id'] = $this->encrypt->encode($row['module_id']);
                $row['task_id'] = $this->encrypt->encode($row['task_id']);
                $row['installed_date'] = date("F j,Y", $row['installed_date']);
                $row['is_active'] = $row['is_active'] == 'yes' ? TRUE : FALSE;
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Count installed modules
     * </p>
     * @access public
     * @return int Returns total installed modules
     */
    public function count_modules() {
        return $this->db->count_all_results('g_installed_modules');
    }

    /**
     * <p style="text-align:justify">
     * Check validity of task id
     * </p>
     * @access public
     * @param int $task_id Task id
     * @return boolean Returns TRUE if valid otherwise FALSE
     */
    public function is_valid_module_id($task_id = 0) {
        $this->db->where('g_installed_modules.id', $task_id);
        $count = $this->db->count_all_results('g_installed_modules');

        if ($count == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Check for duplicate module folder name
     * </p>
     * @access public
     * @param string $module_name Module name
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function is_duplicate_module_folder_name($module_folder_name = '') {
        $this->db->where('g_installed_modules.module_folder_name', "$module_folder_name");

        $count = $this->db->count_all_results('g_installed_modules');

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Import installation sql
     * </p>
     * @param string $sql Sql query
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function run_sql_file($sql = '') {
        $this->db->trans_start();

        $this->db->query($sql);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * <p style="text-align:justify">
     * Get module folder name
     * </p>
     * @param int $module_id Module id
     * @return string Returns module folder name
     */
    public function get_module_folder_name($module_id = 0) {
        $this->db->select('g_installed_modules.module_folder_name');
        $this->db->from('g_installed_modules');
        $this->db->where('g_installed_modules.id', $module_id);

        $query = $this->db->get();
        $row = $query->row_array();

        return $row['module_folder_name'];
    }

    /**
     * <p style="text-align:justify">
     * Get module and task id
     * </p>
     * @param string $module_name Module name
     * @return array Returns module and task id
     */
    public function get_module_and_task_id($module_name = '') {
        $this->db->select('g_installed_modules.id as module_id,
                           g_installed_modules.task_id');

        $this->db->from('g_installed_modules');
        $this->db->where('g_installed_modules.module_name', $module_name);

        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /**
     * <p style="text-align:justify">
     * Get sub module names
     * </p>
     * @param int $task_id Task id
     * @return array Returns Sub module names
     */
    public function get_sub_modules($task_id = 0) {
        $data = array();

        $this->db->select('g_system_tasks.task_name');
        $this->db->from('g_system_tasks');
        $this->db->where('g_system_tasks.parent_task_id', $task_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['task_name'] = $row['task_name'];
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Update modules
     * </p>
     * @access public
     * @param array $module_data Module data
     * @param array $module_details Module details
     * @param string $module_title Module title
     * @param int $action Action must be either 1(for insert), 0 (for update), -1(for delete)
     * @param int $key Module id
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function update_module($module_data = array(), $module_details = array(), $module_title = '', $action = 1, $module_id = 0, $task_id = 0) {
        if ($action == 1) {
            $parent_task = array(
                'task_name' => $module_title,
                'parent_task_id' => 0,
                'is_active' => 'yes'
            );

            //insert
            $this->db->trans_start();

            $this->db->insert('g_system_tasks', $parent_task);
            $parent_id = $this->db->insert_id();

            $module_data['task_id'] = $parent_id;
            $this->db->insert('g_installed_modules', $module_data);

            if (count($module_details) > 0) {
                $details_taks = array();

                foreach ($module_details as $details) {
                    $data = array(
                        'task_name' => $details['name'],
                        'parent_task_id' => $parent_id,
                        'controller_name' => $details['controller'],
                        'function_name' => $details['function'],
                        'sorting_order' => 0,
                        'is_active' => 'yes'
                    );

                    array_push($details_taks, $data);
                }

                $this->db->insert_batch('g_system_tasks', $details_taks);
            }
            $this->db->trans_complete();

            return $this->db->trans_status();
        } else if ($action == 0) {
            if (count($module_details) > 0) {
                $details_taks = array();

                foreach ($module_details as $details) {
                    $data = array(
                        'task_name' => $details['name'],
                        'parent_task_id' => $task_id,
                        'controller_name' => $details['controller'],
                        'function_name' => $details['function'],
                        'sorting_order' => 0,
                        'is_active' => 'yes'
                    );

                    array_push($details_taks, $data);
                }

                $this->db->insert_batch('g_system_tasks', $details_taks);
            }
        } else if ($action == -1) {
            //delete
            $this->db->trans_start();

            $this->db->where('g_group_tasks.task_id', $task_id);
            $this->db->delete('g_group_tasks');

            $this->db->where('g_system_tasks.id', $task_id);
            $this->db->delete('g_system_tasks');

            $this->db->where('g_system_tasks.parent_task_id', $task_id);
            $this->db->delete('g_system_tasks');

            $this->db->where('g_installed_modules.id', $module_id);
            $this->db->delete('g_installed_modules');

            $this->db->trans_complete();

            return $this->db->trans_status();
        }
    }

    /**
     * <p style="text-align:justify">
     * Update task
     * </p>
     * @access public
     * @param int $task_id Task id
     * @param string $is_active Active status either <b>yes</b> or <b>no</b>
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function update_task($task_id = 0, $is_active = 'no') {
        $this->db->trans_start();

        $this->db->set('g_system_tasks.is_active', $is_active);
        $this->db->where('g_system_tasks.id', $task_id);
        $this->db->update('g_system_tasks');

        $this->db->set('g_installed_modules.is_active', $is_active);
        $this->db->where('g_installed_modules.task_id', $task_id);
        $this->db->update('g_installed_modules');
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

}

