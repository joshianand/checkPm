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
class Model_yp extends G_model{
    /**
     * Class constructor
     * @access public
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * <p style="text-align:justify">
     * Get city name
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param string $city_id City id
     * @return int Returns City name
     */
    public function GetCityName($city_id = 0){
        $this->db->select('g_cities.city_name');
        $this->db->from('g_cities');
        $this->db->where('g_cities.city_id', $city_id);
        
        $query = $this->db->get();
        $row = $query->row_array();
        
        if(count($row) > 0){
            return $row['city_name'];
        } else {
            return '';
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Get city list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @return mixed Returns city array 
     */
    public function GetCities(){
        $data = array();
        
        $this->db->select('g_cities.city_id,
                           g_cities.city_name,
                           g_cities.city_symbol');
        $this->db->from('g_cities');
        
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
    public function GetSearchList($limit = 25, $offset = 0, $sort_direction = 'desc', $sort_field = 'search_id') {
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
    public function CountSearchList() {
        return $this->db->count_all_results('yellow_page_search_lists');
    }

    /**
     * <p style="text-align:justify">
     * Get business detail list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $search_id Search id
     * @param int $limit Limit value
     * @param int $offset Offset value
     * @param string $sort_direction Sort direction asc or desc
     * @param string $sort_field Sort field
     * @param boolean $get_non_verified_only Get non verified rows only
     * @return mixed Returns business detail list
     */
    public function GetBusinessDetails($search_id = 0, $limit = 25, $offset = 0, $sort_direction = 'desc', $sort_field = 'business_id', $get_non_verified_only = FALSE) {
        $data = array();

        $this->db->select('yellow_page_business_details.business_id,
                           yellow_page_business_details.business_name,
                           yellow_page_business_details.business_category,
                           yellow_page_business_details.street_address,
                           yellow_page_business_details.city,
                           yellow_page_business_details.state,
                           yellow_page_business_details.post_code,
                           yellow_page_business_details.latitude,
                           yellow_page_business_details.longitude,
                           yellow_page_business_details.phone,
                           yellow_page_business_details.company_url,
                           yellow_page_business_details.coupon_url,
                           yellow_page_business_details.emails,
                           yellow_page_business_details.open_hours,
                           yellow_page_business_details.payment_methods,
                           yellow_page_business_details.average_rating,
                           yellow_page_business_details.rating_count');
        $this->db->from('yellow_page_business_details');

        $this->db->where('yellow_page_business_details.search_id', $search_id);

        if ($get_non_verified_only) {
            $this->db->where('yellow_page_business_details.is_verified', 'no');
        }

        switch ($sort_field) {
            case 'business_id':
                $this->db->order_by('yellow_page_business_details.business_id', $sort_direction);
                break;

            case 'business_name':
                $this->db->order_by('yellow_page_business_details.business_name', $sort_direction);
                break;

            case 'business_category':
                $this->db->order_by('yellow_page_business_details.business_category', $sort_direction);
                break;

            case 'street_address':
                $this->db->order_by('yellow_page_business_details.street_address', $sort_direction);
                break;

            case 'city':
                $this->db->order_by('yellow_page_business_details.city', $sort_direction);
                break;

            case 'state':
                $this->db->order_by('yellow_page_business_details.state', $sort_direction);
                break;

            case 'post_code':
                $this->db->order_by('yellow_page_business_details.post_code', $sort_direction);
                break;

            case 'company_url':
                $this->db->order_by('yellow_page_business_details.company_url', $sort_direction);
                break;

            case 'emails':
                $this->db->order_by('yellow_page_business_details.emails', $sort_direction);
                break;

            case 'phone':
                $this->db->order_by('yellow_page_business_details.phone', $sort_direction);
                break;

            case 'average_rating':
                $this->db->order_by('yellow_page_business_details.average_rating', $sort_direction);
                break;

            default :
                $this->db->order_by('yellow_page_business_details.search_id', 'desc');
                break;
        }

        if ($limit > 0) {
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
     * Get business detail list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $search_id Search id
     * @return int Returns total business details
     */
    public function CountBusinessDetails($search_id = 0) {
        $this->db->where('yellow_page_business_details.search_id', $search_id);
        return $this->db->count_all_results('yellow_page_business_details');
    }

    /**
     * <p style="text-align:justify">
     * Get business details for download
     * </p>
     * @access public
     * @param int $search_id Search id
     * @param string $selection_string Selection query string
     * @param boolean $select_web Select website business only
     * @param boolean $select_email Select email business only
     * @return mixed Returns business detail list
     */
    public function DownloadBusienssDetails($search_id=0, $selection_string = '', $select_web = TRUE, $select_email = TRUE){
        $this->db->select($selection_string);
        
        $this->db->from('yellow_page_business_details');
        
        if($select_web){
            $this->db->where('yellow_page_business_details.company_url <>', '');
        }
        
        if($select_email){
            $this->db->where('yellow_page_business_details.emails <>', '');
        }
        
        $this->db->where('yellow_page_business_details.search_id', $search_id);
        
        $this->db->order_by('yellow_page_business_details.search_id', 'desc');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * <p style="text-align:justify">
     * Get what and where list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $city_id City id
     * @param string $search_text Search text
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function IsDuplicateWhatWhere($city_id = '', $search_text = '') {
        $this->db->where('yellow_page_search_lists.city_id', $city_id);
        $this->db->where('yellow_page_search_lists.search_text', $search_text);

        $count = $this->db->count_all_results('yellow_page_search_lists');
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
    /**
     * <p style="text-align:justify">
     * Insert/Update/Delete search data in batch mode
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param mixed $search_data Search data array
     * @param int $action Action either <b>1 for insert</b> or <b>0 for update</b> or <b>-1 for delete</b>
     * @param int $key Search id
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function UpdateSearchData($search_data = array(), $action = 1, $key = 0) {
        if ($action == 1) {
            //Create operation
            $this->db->trans_start();

            $this->db->insert_batch('yellow_page_search_lists', $search_data);

            $this->db->trans_complete();
            return $this->db->trans_status();
        } else if ($action == 0) {
            //Update operation
            $this->db->trans_start();

            if (isset($search_data['total_business_found'])) {
                $this->db->set("yellow_page_search_lists.total_business_found", $search_data['total_business_found']);
            }

            if (isset($search_data['search_status'])) {
                $this->db->set("yellow_page_search_lists.search_status", $search_data['search_status']);
            }

            $this->db->where('yellow_page_search_lists.search_id', $key);
            $this->db->update('yellow_page_search_lists');

            $this->db->trans_complete();
            return $this->db->trans_status();
        } else if ($action == -1) {
            //Delete operation
            $this->db->trans_start();

            $this->db->where('yellow_page_business_details.search_id', $key);
            $this->db->delete('yellow_page_business_details');

            $this->db->where('yellow_page_search_lists.search_id', $key);
            $this->db->delete('yellow_page_search_lists');

            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }

    /**
     * <p style="text-align:justify">
     * Insert search details data in batch mode
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param type $details_data Details data array
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function InsertSearchDetailsData($details_data = array()) {
        if (count($details_data) > 0) {
            $this->db->trans_start();

            $this->db->insert_batch('yellow_page_business_details', $details_data);

            $this->db->trans_complete();
            return $this->db->trans_status();
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Insert single search data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param type $search_data Search data array
     * @return int Returns inserted id
     */
    public function InsertSearchData($search_data = array()) {
        $this->db->trans_start();

        $this->db->insert('yellow_page_search_lists', $search_data);

        $id = $this->db->insert_id();

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return $id;
        } else {
            return 0;
        }
    }

   
    /**
     * <p style="text-align:justify">
     * Get download file name
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $search_id Search id
     * @return string Returns downloadable file name
     */
    public function GetDownloadFileName($search_id = 0) {
        $this->db->select('yellow_page_search_lists.city_name,
                           yellow_page_search_lists.search_text');
        $this->db->from('yellow_page_search_lists');

        $this->db->where('yellow_page_search_lists.search_id', $search_id);

        $query = $this->db->get();
        $row = $query->row_array();

        if (count($row) > 0) {
            return $row['city_name'] . "_" . str_replace(' ', '_', $row['search_text']);
        } else {
            return '';
        }
    }

    /**
     * <p style="text-align:justify">
     * Get business websites
     * </p>
     * @access public
     * @param int $search_id Search id
     * @param string $check_mail Check for email address
     * @return array Returns business websites
     */
    public function GetBusinessWebsites($search_id = 0 , $check_mail = TRUE){
        $data = array();
        
        $this->db->select('yellow_page_business_details.business_id,
                           yellow_page_business_details.company_url');
        
        $this->db->from('yellow_page_business_details');
        
        $this->db->where('yellow_page_business_details.company_url <>', '');
        
        if($check_mail){
            $this->db->where('yellow_page_business_details.emails', '');
        }
        
        $this->db->where('yellow_page_business_details.search_id', $search_id);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['company_url'] = trim($row['company_url']);
                
                if($row['company_url']){
                    array_push($data, $row);
                }
            }
        }
        
        return $data;
    }
    
    /**
     * <p style="text-align:justify">
     * Update verified email addresses
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $business_id Business id
     * @param string $email_addresses Email addresses
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function UpdateVerifiedEmail($business_id = 0, $email_addresses = ''){
        $this->db->trans_start();
        
        $this->db->set('yellow_page_business_details.emails', $email_addresses);
        
        $this->db->where('yellow_page_business_details.business_id',$business_id);
        $this->db->update('yellow_page_business_details');
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    /**
     * <p style="text-align:justify">
     * Update wesbite analyzed data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param int $business_id Business id
     * @param string $analyzed_data Analyzed data
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function UpdateSiteAnalyze($business_id = 0, $analyzed_data = array()){
        $this->db->trans_start();
        
        $this->db->where('yellow_page_business_details.business_id',$business_id);
        $this->db->update('yellow_page_business_details', $analyzed_data); 
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    /**
     * <p style="text-align:justify">
     * Update scrape status
     * </p>
     * @access public
     * @param int $search_id Search id
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function UpdateScrapeStatus($search_id = 0){
        $this->db->trans_start();
        
        $this->db->set('yellow_page_search_lists.email_scraped', 'yes');
        
        $this->db->where('yellow_page_search_lists.search_id',$search_id);
        $this->db->update('yellow_page_search_lists');
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    /**
     * <p style="text-align:justify">
     * Update analyze status
     * </p>
     * @access public
     * @param int $search_id Search id
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function UpdateAnalyzeStatus($search_id = 0){
        $this->db->trans_start();
        
        $this->db->set('yellow_page_search_lists.site_analyzed', 'yes');
        
        $this->db->where('yellow_page_search_lists.search_id',$search_id);
        $this->db->update('yellow_page_search_lists');
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}

/* End of file model_yp.php */
/* Location: ./application/models/model_yp.php */