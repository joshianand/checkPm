<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for ....
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */
class Model_business_search extends G_model{
    /**
     * Class constructor
     * @access public
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * <p style="text-align:justify">
     * Get search list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $limit Limit value
     * @param int $offset Offset value
     * @param string $sort_direction Sort direction asc or desc
     * @param string $sort_field Sort field
     * @return mixed Returns search list
     */
    public function GetSearchList($limit = 25, $offset = 0, $sort_direction = 'desc', $sort_field = 'search_id', $search_params = array()) {
        $data = array();

        $this->db->select('yellow_page_search_lists.search_id,
                           yellow_page_search_lists.city_name,
                           yellow_page_search_lists.search_text,
                           yellow_page_search_lists.total_business_found,
                           yellow_page_search_lists.search_status,
                           yellow_page_search_lists.modified_date,
                           yellow_page_search_lists.email_scraped,
                           yellow_page_search_lists.site_analyzed');
        $this->db->from('yellow_page_search_lists');
        
        if(!empty($search_params)) {
            foreach($search_params as $params_key => $params) {
                if($params != "")
                    $this->db->where($params_key, $params);
            }
        }
        

        switch ($sort_field) {
            case 'search_id':
                $this->db->order_by('yellow_page_search_lists.search_id', $sort_direction);
                break;

            case 'city_name':
                $this->db->order_by('yellow_page_search_lists.city_name', $sort_direction);
                break;

            case 'search_text':
                $this->db->order_by('yellow_page_search_lists.search_text', $sort_direction);
                break;

            case 'email_scraped':
                $this->db->order_by('yellow_page_search_lists.email_scraped', $sort_direction);
                break;

            case 'site_analyzed':
                $this->db->order_by('yellow_page_search_lists.site_analyzed', $sort_direction);
                break;
            
            case 'search_text':
                $this->db->order_by('yellow_page_search_lists.search_text', $sort_direction);
                break;

            case 'total_business_found':
                $this->db->order_by('yellow_page_search_lists.total_business_found', $sort_direction);
                break;

            case 'search_status':
                $this->db->order_by('yellow_page_search_lists.search_status', $sort_direction);
                break;

            case 'modified_date':
                $this->db->order_by('yellow_page_search_lists.modified_date', $sort_direction);
                break;

            default :
                $this->db->order_by('yellow_page_search_lists.search_id', 'desc');
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
     * Count search list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @return int Returns total searches
     */
    public function CountSearchList($search_params) {
        
        if(!empty($search_params)) {
            foreach($search_params as $params_key => $params) {
                $this->db->where($params_key, $params);
            }
        }
        
        return $this->db->count_all_results('yellow_page_search_lists');
    }
}

/* End of file model_business_search.php */
/* Location: ./application/models/model_business_search.php */