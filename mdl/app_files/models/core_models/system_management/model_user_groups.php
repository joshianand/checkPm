<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for user groups
 * </p>
 * @package Core
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Model_user_groups extends G_model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * <p style="text-align:justify">
     * Get user groups
     * </p>
     * @access public
     * @param type $limit Limit value
     * @param type $offset Offset value
     * @param type $sort_direction Sort direction
     * @param type $sort_field Sort field
     * @return array Returns user group array
     */
    public function get_user_groups($limit = 10, $offset = 0, $sort_direction = 'desc', $sort_field = 'group_name') {
        $data = array();

        $this->db->select('g_user_groups.id as group_id,
                           g_user_groups.group_name as group_name,
                           g_user_groups.is_active as active');
        $this->db->from('g_user_groups');
        
        $this->db->where('g_user_groups.ID <>', 1);
        $this->db->where('g_user_groups.ID <>', 2);

        switch ($sort_field) {
            case 'group_name':
                $this->db->order_by('g_user_groups.group_name', $sort_direction);
                break;

            case 'active':
                $this->db->order_by('g_user_groups.is_active', $sort_direction);
                break;

            default:
                $this->db->order_by('g_user_groups.id', 'desc');
                break;
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['group_id'] = $this->encrypt->encode($row['group_id']);
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Count user groups
     * </p>
     * @access public
     * @return int Returns total user groups
     */
    public function count_user_groups() {
        $this->db->where('g_user_groups.id <>', 1);
        $this->db->where('g_user_groups.ID <>', 2);
        return $this->db->count_all_results('g_user_groups');
    }

    /**
     * <p style="text-align:justify">
     * Get group details
     * </p>
     * @access public
     * @param int $group_id Group id
     * @return array Returns user group array
     */
    public function get_group_details($group_id = 0){
        $this->db->select('g_user_groups.group_name as group_name,
                           g_user_groups.is_active as active');
        $this->db->from('g_user_groups');
        $this->db->where('g_user_groups.id', $group_id);
        
        $query = $this->db->get();
        return $query->row_array();
    }
    
    /**
     * <p style="text-align:justify">
     * Get group task details
     * </p>
     * @access public
     * @param int $group_id group id
     * @return array Returns group task details array
     */
    public function get_group_tasks($group_id=0){
        $task_model=array();
        
        $this->db->select('g_system_tasks.id as task_id,
                           g_system_tasks.task_name as task_name');
        $this->db->from('g_system_tasks');
        $this->db->order_by('g_system_tasks.sorting_order','asc');
        
        $this->db->where('g_system_tasks.parent_task_id', 0);
        $this->db->where('g_system_tasks.is_active', 'yes');
        
        $parent_tasks = $this->db->get();
        if ($parent_tasks->num_rows() > 0) {
            foreach ($parent_tasks->result_array() as $parent_task){
                $data['parent_name'] = element('task_name', $parent_task);
                $data['parent_items'] = array();
                
                $this->db->select('g_system_tasks.id as child_id,
                                   g_system_tasks.task_name as child_name');
                $this->db->from('g_system_tasks');
                
                $this->db->where('g_system_tasks.parent_task_id', $parent_task['task_id']);
                $this->db->where('g_system_tasks.is_active', 'yes');
                
                $this->db->order_by('g_system_tasks.sorting_order','asc');
                
                $child_tasks = $this->db->get();
                if ($child_tasks->num_rows() > 0) {
                    foreach ($child_tasks->result_array() as $child_task) {
                        $this->db->where('g_group_tasks.group_id',$group_id);
                        $this->db->where('g_group_tasks.task_id',$child_task['child_id']);
                        $count = $this->db->count_all_results('g_group_tasks');
                        $child_task['checked'] = $count == 0 ? '' : 'checked: checked';
                        
                        $child_task['child_id'] = $this->encrypt->encode($child_task['child_id']);
                        array_push($data['parent_items'], $child_task);
                    }
                }
                array_push($task_model, $data);
            }
        }
        
        return $task_model;
    }
    
    /**
     * <p style="text-align:justify">
     * Check validity of group id
     * </p>
     * @access public
     * @param int $group_id Group id
     * @return boolean Returns TRUE if valid otherwise FALSE
     */
    public function is_valid_group_id($group_id = 1) {
        $this->db->where('g_user_groups.id', $group_id);
        $count = $this->db->count_all_results('g_user_groups');

        if ($count == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
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
     * Check for duplicate group name
     * </p>
     * @access public
     * @param int $group_id Group id
     * @param string $group_name Group name
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function is_duplicate_group_name($group_id = 0, $group_name = '') {
        if ($group_id != 0) {
            $this->db->where('g_user_groups.id <>', $group_id);
        }
        $this->db->where('g_user_groups.group_name', $group_name);
        $count = $this->db->count_all_results('g_user_groups');

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Update user group
     * </p>
     * @access public
     * @param type $name Group name
     * @param type $is_active Active status
     * @param type $tasks Task array
     * @param int $action Action must be either 1(for insert),-1(for delete) or 0(for update)
     * @param int $key Group id
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function update_group($name = '', $is_active = 'yes', $tasks = array(), $action = 1, $key = 0) {
        if ($action == 1) {
            //insert
            $this->db->trans_start();

            $data = array(
                'group_name' => $name,
                'is_active' => $is_active
            );
            $this->db->insert('g_user_groups', $data);
            $inserted_id = $this->db->insert_id();

            $task_data = array();
            $date = strtotime('now');

            foreach ($tasks as $id) {
                $task = array(
                    'group_id' => $inserted_id,
                    'task_id' => $id,
                    'modified_date' => $date
                );
                array_push($task_data, $task);
            }

            if (count($task_data) > 0) {
                $this->db->insert_batch('g_group_tasks', $task_data);
            }
            
            $this->db->trans_complete();

            return $this->db->trans_status();
        } else if($action ==0){
            //update
            $this->db->trans_start();
            
            $this->db->set('g_user_groups.group_name',$name);
            $this->db->set('g_user_groups.is_active',$is_active);
            
            $this->db->where('g_user_groups.id', $key);
            $this->db->update('g_user_groups');
            
            $this->db->where('g_group_tasks.group_id',$key);
            $this->db->delete('g_group_tasks');
            
            $task_data = array();
            $date = strtotime('now');

            foreach ($tasks as $id) {
                $task = array(
                    'group_id' => $key,
                    'task_id' => $id,
                    'modified_date' => $date
                );
                array_push($task_data, $task);
            }

            if (count($task_data) > 0) {
                $this->db->insert_batch('g_group_tasks', $task_data);
            }
            
            $this->db->trans_complete();
            
            return $this->db->trans_status();
        } else if($action ==-1){
            //delete
            $this->db->trans_start();
            
            $this->db->where('g_group_tasks.group_id',$key);
            $this->db->delete('g_group_tasks');
            
            $this->db->where('g_logins.group_id',$key);
            $this->db->delete('g_logins');
            
            $this->db->where('g_user_groups.id',$key);
            $this->db->delete('g_user_groups');
            
            $this->db->trans_complete();
            
            return $this->db->trans_status();
        }
    }

}

