<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for slogans
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @author Pronab Saha (pranab.su@gmail.com)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */
class Model_slogan extends G_model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * <p style="text-align:justify">
     * Get slogan data list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $limit Limit value
     * @param int $offset Offset value
     * @param string $sort_direction Sort direction asc or desc
     * @param string $sort_field Sort field
     * @return mixed Returns slogan data
     */
    public function GetSloganDataList($limit = 25, $offset = 0, $sort_direction = 'desc', $sort_field = 'data_id') {
        $data = array();

        $this->db->select('slogan_data.data_id,
                           slogan_data.cities,
                           slogan_data.services,
                           slogan_data.modified_date');
        $this->db->from('slogan_data');

        switch ($sort_field) {
            case 'data_id':
                $this->db->order_by('slogan_data.data_id', $sort_direction);
                break;

            case 'cities':
                $this->db->order_by('slogan_data.cities', $sort_direction);
                break;

            case 'services':
                $this->db->order_by('slogan_data.services', $sort_direction);
                break;

            case 'modified_date':
                $this->db->order_by('slogan_data.modified_date', $sort_direction);
                break;

            default :
                $this->db->order_by('slogan_data.data_id', 'desc');
                break;
        }

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['modified_date'] = date("F j,Y", $row['modified_date']);
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Count slogan data list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @return int Returns total slogan data
     */
    public function CountSloganDataList() {
        return $this->db->count_all_results('slogan_data');
    }

    /**
     * <p style="text-align:justify">
     * Get slogan list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $slogan_data_id Slogan data id
     * @param int $limit Limit value
     * @param int $offset Offset value
     * @param string $sort_direction Sort direction asc or desc
     * @param string $sort_field Sort field
     * @return mixed Returns slogans
     */
    public function GetSloganList($slogan_data_id = 0, $limit = 25, $offset = 0, $sort_direction = 'desc', $sort_field = 'slogan_id') {
        $data = array();

        $this->db->select('generated_slogans.slogan_id,
                           generated_slogans.slogan_name');
        $this->db->from('generated_slogans');

        if($slogan_data_id > 0){
            $this->db->where('generated_slogans.slogan_data_id', $slogan_data_id);
        }
        

        switch ($sort_field) {
            case 'slogan_id':
                $this->db->order_by('generated_slogans.slogan_id', $sort_direction);
                break;

            case 'slogan_name':
                $this->db->order_by('generated_slogans.slogan_name', $sort_direction);
                break;

            default :
                $this->db->order_by('generated_slogans.slogan_id', 'desc');
                break;
        }

        if($limit > 0){
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Count slogan list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $slogan_data_id Slogan data id
     * @return int Returns total slogans
     */
    public function CountSloganList($slogan_data_id = 0) {
        $this->db->where('generated_slogans.slogan_data_id', $slogan_data_id);
        return $this->db->count_all_results('generated_slogans');
    }

    /**
     * <p style="text-align:justify">
     * Get multiple slogan names against corresponding slogan ids
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param mixed $slogan_ids Slogan ids array
     * @return mixed Returns slogan name array
     */
    public function GetSloganNames($slogan_ids = array()){
        $data = array();
        
        $this->db->select('generated_slogans.slogan_name');
        $this->db->from('generated_slogans');
        $this->db->where_in('generated_slogans.slogan_id', $slogan_ids);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                array_push($data, $row['slogan_name']);
            }
        }
        
        return $data;
    }
    
    /**
     * <p style="text-align:justify">
     * Get slogan ids from slogan data id
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param mixed $slogan_data_id Slogan data id
     * @return mixed Returns slogan id array
     */
    public function GetSloganIds($slogan_data_id = 0){
        $data = array();
        
        $this->db->select('generated_slogans.slogan_id');
        $this->db->from('generated_slogans');
        $this->db->where_in('generated_slogans.slogan_data_id', $slogan_data_id);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                array_push($data, $row['slogan_id']);
            }
        }
        
        return $data;
    }
    
    /**
     * <p style="text-align:justify">
     * Insert/Update/Delete slogan data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param mixed $slogan_data Slogan data array
     * @param mixed $generated_slogans Generated slogans
     * @param int $action Action either <b>1 for insert</b> or <b>0 for update</b> or <b>-1 for delete</b>
     * @param int $key Slogan data id
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function UpdateSloganData($slogan_data = array(), $generated_slogans = array(), $action = 1, $key = 0) {
        if ($action == 1) {
            //Create operation
            $this->db->trans_start();

            $this->db->insert('slogan_data', $slogan_data);
            $slogan_data_id = $this->db->insert_id();

            $this->db->trans_complete();

            return $slogan_data_id;
        } else if ($action == 0) {
            //Update operation
            $this->db->trans_start();

            $this->db->set("slogan_data.cities", $slogan_data['cities']);
            $this->db->set("slogan_data.services", $slogan_data['services']);
            $this->db->where('slogan_data.data_id', $key);
            $this->db->update('slogan_data');

            $this->db->where('generated_slogans.slogan_data_id', $key);
            $this->db->delete('generated_slogans');

            $this->db->insert_batch('generated_slogans', $generated_slogans);

            $this->db->trans_complete();
            return $this->db->trans_status();
        } else if ($action == -1) {
            //Delete operation
            $this->db->trans_start();

            $this->db->where('generated_slogans.slogan_data_id', $key);
            $this->db->delete('generated_slogans');

            $this->db->where('slogan_data.data_id', $key);
            $this->db->delete('slogan_data');

            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }

    /**
     * <p style="text-align:justify">
     * Save generated solgans
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param mixed $generated_slogans Generated slogan array
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function SaveGeneratedSlogans($generated_slogans = array()) {
        $this->db->trans_start();

        $this->db->insert_batch('generated_slogans', $generated_slogans);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * <p style="text-align:justify">
     * Check for duplicate slogan data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param string $cities City names
     * @param string $services Service names
     * @param int $slogan_data_id Slogan data id
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function IsDuplicateSloganData($cities = '', $services = '', $slogan_data_id = 0){
        $this->db->where('slogan_data.cities',$cities);
        $this->db->where('slogan_data.services',$services);
        
        if($slogan_data_id > 0){
            $this->db->where('slogan_data.data_id <>',$slogan_data_id);
        }
        
        if($this->db->count_all_results('slogan_data') > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

