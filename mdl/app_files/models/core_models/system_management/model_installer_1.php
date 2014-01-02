<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for module registration
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
     * Get modules
     * </p>
     * @access public
     * @param type $parent_id Parent module id
     * @param type $limit Limit value
     * @param type $offset Offset value
     * @param type $sort_direction Sort direction
     * @param type $sort_field Sort field
     * @return array Returns Module array
     */
    public function get_modules($parent_id = 0, $limit = 10, $offset = 0, $sort_direction = 'desc', $sort_field = 'module_id') {
        $data = array();

        $this->db->select('g_system_tasks.id as module_id,
                           g_system_tasks.task_name as task_name,
                           g_system_tasks.controller_name,
                           g_system_tasks.function_name,
                           g_system_tasks.sorting_order as sorting_order,
                           g_system_tasks.is_active as active');
        $this->db->from('g_system_tasks');
        
        if($parent_id == 0){
            $this->db->where('g_system_tasks.id <>', 1);
            $this->db->where('g_system_tasks.parent_task_id', 0);
        } else {
            $this->db->where('g_system_tasks.parent_task_id', $parent_id);
        }
        
        switch ($sort_field) {
            case 'task_name':
                $this->db->order_by('g_system_tasks.task_name', $sort_direction);
                break;

            case 'sorting_order':
                $this->db->order_by('g_system_tasks.sorting_order', $sort_direction);
                break;
            
            case 'active':
                $this->db->order_by('g_system_tasks.is_active', $sort_direction);
                break;

            default:
                $this->db->order_by('g_system_tasks.id', 'desc');
                break;
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['module_id'] = $this->encrypt->encode($row['module_id']);
                $row['active'] = $row['active'] == 'yes' ? TRUE : FALSE;
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Count modules
     * </p>
     * @access public
     * @param int $parent_id Parent module id
     * @return int Returns total modules
     */
    public function count_modules($parent_id = 0) {
        if($parent_id == 0){
            $this->db->where('g_system_tasks.id <>', 1);
            $this->db->where('g_system_tasks.parent_task_id', 0);
        } else {
            $this->db->where('g_system_tasks.parent_task_id', $parent_id);
        }
        return $this->db->count_all_results('g_system_tasks');
    }

    /**
     * <p style="text-align:justify">
     * Check validity of task id
     * </p>
     * @access public
     * @param int $task_id Task id
     * @return boolean Returns TRUE if valid otherwise FALSE
     */
    public function is_valid_task_id($task_id=0){
        $this->db->where('g_system_tasks.id', $task_id);
        $count = $this->db->count_all_results('g_system_tasks');

        if ($count == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Check duplicate task name
     * </p>
     * @access public
     * @param int $task_id Task id
     * @param string $task_name Task name
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function is_duplicate_task_name($task_id = 0, $task_name = ''){
        if($task_id != 0){
             $this->db->where('g_system_tasks.id <>', $task_id);
        }
        $this->db->where('g_system_tasks.task_name', $task_name);
        
        $count = $this->db->count_all_results('g_system_tasks');
        
        if($count > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Check for duplicate task controller name
     * </p>
     * @access public
     * @param int $task_id Task id
     * @param string $controller_name Controller name
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function is_duplicate_controller_name($task_id = 0, $controller_name = ''){
        if($task_id != 0){
             $this->db->where('g_system_tasks.id <>', $task_id);
        }
        $this->db->where('g_system_tasks.controller_name', $controller_name);
        
        $count = $this->db->count_all_results('g_system_tasks');
        
        if($count > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Check for duplicate task function name
     * </p>
     * @access public
     * @param int $task_id Task id
     * @param string $controller_name Controller name
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function is_duplicate_function_name($task_id = 0, $function_name = ''){
        if($task_id != 0){
             $this->db->where('g_system_tasks.id <>', $task_id);
        }
        $this->db->where('g_system_tasks.function_name', $function_name);
        
        $count = $this->db->count_all_results('g_system_tasks');
        
        if($count > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Update modules
     * </p>
     * @access public
     * @param array $module_data Module data
     * @param int $action Action must be either 1(for insert),-1(for delete) or 0(for update)
     * @param int $key Module id
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function update_module($module_data = array(), $action = 1, $key = 0) {
        if ($action == 1) {
            //insert
            $this->db->trans_start();

            $this->db->insert('g_system_tasks', $module_data);

            $this->db->trans_complete();

            return $this->db->trans_status();
        } else if($action ==0){
            //update
            $this->db->trans_start();
            
            $this->db->where('g_system_tasks.id', $key);
            $this->db->update('g_system_tasks', $module_data);

            $this->db->trans_complete();
            
            return $this->db->trans_status();
        } else if($action ==-1){
            //delete
            $this->db->trans_start();
            
            $this->db->where('g_system_tasks.id',$key);
            $this->db->delete('g_system_tasks');
            
            $this->db->trans_complete();
            
            return $this->db->trans_status();
        }
    }

}

