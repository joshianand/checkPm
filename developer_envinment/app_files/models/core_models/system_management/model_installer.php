<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for installer
 * </p>
 * @package Core
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Model_installer extends G_model {

    /**
     * Class constructor
     * @access public
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * <p style="text-align:justify">
     * Get module names
     * </p>
     * @access public
     * @return array Returns module names
     */
    public function get_modules() {
        $data = array();

        $this->db->select('g_system_tasks.id as module_id,
                           g_system_tasks.task_name as module_name');
        $this->db->from('g_system_tasks');

        $this->db->where('g_system_tasks.id <>', 1);
        $this->db->where('g_system_tasks.id <>', 5);
        $this->db->where('g_system_tasks.parent_task_id', 0);
        $this->db->where('g_system_tasks.is_active', 'yes');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['module_id'] = $this->encrypt->encode($row['module_id']);
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Get database table names
     * </p>
     * @access public
     * @return array Returns table names
     */
    public function list_tables() {
        $core_prefix = 'g_';
        $table_names = array();

        $tables = $this->db->list_tables();


        foreach ($tables as $table) {

            if (preg_match("/$core_prefix/i", $table)) {
                continue;
            }

            array_push($table_names, $table);
        }

        return $table_names;
    }

    /**
     * <p style="text-align:justify">
     * Get module details
     * </p>
     * @access public
     * @param int $module_id Module id
     * @return array Returns module details
     */
    public function get_module_details($module_id = 0){
        $data = array();
        
        $this->db->select('g_system_tasks.id,
                           g_system_tasks.task_name as module_name');
        
        $this->db->from('g_system_tasks');
        
        $this->db->where('g_system_tasks.id', $module_id);
        
        $query = $this->db->get();
        $row = $query->row_array();
        
        $parent_id = $row['id'];
        $data['module_name'] = $row['module_name'];
        $data['module_folder'] = strtolower(str_replace(' ', '_', $row['module_name']));
        
        $this->db->select('g_system_tasks.task_name as module_name,
                           g_system_tasks.controller_name,
                           g_system_tasks.function_name,
                           g_system_tasks.sorting_order');
        
        $this->db->from('g_system_tasks');
        
        $this->db->where('g_system_tasks.parent_task_id', $parent_id);
        
        $query = $this->db->get();
        $data['module_childs'] = $query->result_array();
        
        return $data;
    }
}

/* End of file model_installer.php */
/* Location: ./application/models/model_installer.php */