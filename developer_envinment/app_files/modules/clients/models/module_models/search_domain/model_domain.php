<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for domain search
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
class Model_domain extends G_model {

    /**
     * Class constructor
     * @access public
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * <p style="text-align:justify">
     * Insert supplied keyword data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param mixed $keywords Keyword data array
     * @return array|boolean Returns FALSE if failed otherwise inserted id list
     */
    public function SaveSuppliedKeywords($keywords = array()) {
        $inserted_ids = array();
        
        $this->db->trans_start();

        foreach ($keywords as $keyword) {
            $this->db->set('supplied_keywords.keyword_name', $keyword);
            $this->db->insert('supplied_keywords');
            array_push($inserted_ids, $this->db->insert_id());
        }

        $this->db->trans_complete();
        if($this->db->trans_status() === TRUE){
            return $inserted_ids;
        } else {
            return FALSE;
        }
    }
    
    /**
     * <p style="text-align: justify">
     * Is domain available
     * <p>
     * @access public
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param string $domain_name Domain name
     * @return boolean Returns TRUE if available otherwise FALSE
     */
    public function IsDomainAvailable($domain_name = '') {
        $this->db->where('unavailable_domains.domain_name', $domain_name);
        $count = $this->db->count_all_results('unavailable_domains');

        if ($count == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align: justify">
     * Insert unavailable domain
     * <p>
     * @access public
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param string $domain_name Domain name
     * @return boolean Returns TRUE if available otherwise FALSE
     */
    public function InsertUnavailableDomain($domain_name = '') {
        $data = array(
            'domain_name' => $domain_name,
            'modified_date' => strtotime('now')
        );

        $this->db->trans_start();

        $this->db->insert('unavailable_domains', $data);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * <p style="text-align: justify">
     * Insert generated domains
     * <p>
     * @access public
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param mixed $domains Domain array
     * @return boolean Returns TRUE if available otherwise FALSE
     */
    public function SaveGeneratedDomain($domains = array()) {
        $this->db->trans_start();

        $this->db->insert_batch('generated_domains', $domains);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * <p style="text-align: justify">
     * Get generated domain list
     * <p>
     * @access public
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param string $generated_id Generated id
     * @param string $domain_type Domain type either <b>com</b> or <b>net</b> or <b>us</b>
     * @param string $sort_direction Sort direction
     * @param string $sort_field Sofrt field
     * @return mixed Returns generated domain names
     */
    public function GetGeneratedDomainList($generated_id = 0, $domain_type = 'com', $sort_direction = 'asc', $sort_field = 'domain_id') {
        $data = array();

        $this->db->select('generated_domains.id as domain_id,
                           generated_domains.domain_name');
        $this->db->from('generated_domains');

        $this->db->where('generated_domains.generated_id', $generated_id);
        $this->db->where('generated_domains.domain_type', $domain_type);

        switch ($sort_field) {
            case 'domain_id':
                $this->db->order_by('generated_domains.id', $sort_direction);
                break;

            case 'domain_name':
                $this->db->order_by('generated_domains.domain_name', $sort_direction);
                break;

            default :
                $this->db->order_by('generated_domains.id', 'asc');
                break;
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
     * <p style="text-align: justify">
     * Count total generated domain names
     * <p>
     * @access public
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param string $generated_id Generated id
     * @param string $domain_type Domain type either <b>com</b> or <b>net</b> or <b>us</b>
     * @return int Returns total generated domain names
     */
    public function CountGeneratedDomains($generated_id = 0, $domain_type = 'com') {
        $this->db->where('generated_domains.domain_type', $domain_type);
        $this->db->where('generated_domains.generated_id', $generated_id);
        return $this->db->count_all_results('generated_domains');
    }

    /**
     * <p style="text-align: justify">
     * Save searched domain
     * <p>
     * @access public
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param mixed $domains Domain array
     * @return boolean Returns TRUE if available otherwise FALSE
     */
    public function SaveDomains($domains = array()) {
        $this->db->trans_start();

        $this->db->update_batch('generated_domains', $domains, 'id');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * <p style="text-align: justify">
     * Get downlodable domains
     * <p>
     * @access public
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param string $generated_id Generated id
     * @return mixed Returns domain downladable array
     */
    public function GetDownloadableDomains($generated_id = '') {
        $data = array();
        $slogan_ids = array();
        $keyword_ids = array();
        $domain_data = array();
        $download_list = array();

        $this->db->select('generated_domains.slogan_or_keyword_id,
                           generated_domains.domain_name,
                           generated_domains.generation_source');
        $this->db->from('generated_domains');
        $this->db->where('generated_domains.generated_id', $generated_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($row['generation_source'] == 'keyword') {
                    if (in_array($row['slogan_or_keyword_id'], $keyword_ids) == FALSE) {
                        array_push($keyword_ids, $row['slogan_or_keyword_id']);
                    }
                } else if ($row['generation_source'] == 'slogan') {
                    if (in_array($row['slogan_or_keyword_id'], $keyword_ids) == FALSE) {
                        array_push($slogan_ids, $row['slogan_or_keyword_id']);
                    }
                }

                array_push($domain_data, $row);
            }
        }

        if (count($keyword_ids) > 0) {
            $keyword_names = array();

            $this->db->select('supplied_keywords.keyword_name');
            $this->db->from('supplied_keywords');
            $this->db->where_in('supplied_keywords.keyword_id', $keyword_ids);

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    array_push($keyword_names, $row['keyword_name']);
                }
            }

            $count = 0;
            foreach ($keyword_names as $keyword) {
                $data = array(
                    'keyword' => $keyword,
                    'domains' => $this->FetchDomains($keyword_ids[$count++], $domain_data, 'keyword')
                );

                array_push($download_list, $data);
            }
        }

        if (count($slogan_ids) > 0) {
            $slogan_names = array();

            $this->db->select('generated_slogans.slogan_name');
            $this->db->from('generated_slogans');
            $this->db->where_in('generated_slogans.slogan_id', $slogan_ids);

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    array_push($slogan_names, $row['slogan_name']);
                }
            }

            $count = 0;
            foreach ($slogan_names as $slogan) {
                $data = array(
                    'slogan' => $slogan,
                    'domains' => $this->FetchDomains($slogan_ids[$count], $domain_data, 'slogan')
                );

                $count++;
                array_push($download_list, $data);
            }
        }

        return $download_list;
    }

    /**
     * <p style="text-align: justify">
     * Fetch domains
     * <p>
     * @access public
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param int $id Id
     * @param mixed $domain_data Domain data array
     * @param string $source Source string
     * @return string Returns comma seperated domain list
     */
    protected function FetchDomains($id = 0, $domain_data = array(), $source = 'slogan') {
        $domains = array();

        foreach ($domain_data as $domain) {
            if ($domain['slogan_or_keyword_id'] == $id && $domain['generation_source'] == $source) {
                array_push($domains, $domain['domain_name']);
            }
        }

        return join(',', $domains);
    }
}

/* End of file model_domain.php */
/* Location: ./application/models/model_domain.php */