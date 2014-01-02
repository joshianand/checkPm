<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Library for domain search
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Library
 * @category Library
 * @author Pronab Saha (pranab.su@gmail.com)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */
class Domainsearch {

    private $city_names;
    private $service_names;
    private $word_order;
    private $per_slogan_counts;
    private $selection_orders;
    private $slogan_ids;
    private $slogan_names;
    private $domains;
    private $generated_domains;
    private $api_user = '';
    private $api_user_pass = '';

    public function __construct() {
        $CI = &get_instance();

        $CI->load->model('module_models/slogan_generator/Model_slogan', 'slogan_model');
        $CI->load->model('module_models/search_domain/Model_domain', 'domain_model');

        $this->api_user = "pronab";
        $this->api_user_pass = "pronabsaha";
        $this->city_names = '';
        $this->service_names = '';
        $this->word_order = 'city_service';
        $this->per_slogan_counts = 2;
        $this->selection_orders = $this->slogan_ids = $this->slogan_names = $this->domains = $this->generated_domains = array();
    }

    /**
     * <p style="text-align: justify">
     * Search domain by keywords
     * <p>
     * @access public
     * @author Pronab Saha (pranab.su@gmail.com)
     * @param mixed $keyword_ids Keyword ids
     * @param mixed $keyword_names Keyword names
     * @param string $word_order Word order either <b>city_service</b> or <b>service_city</b>
     * @param int $max_domain_selection Per keyword maximum domain count
     * @param mixed $selection_orders Selection order array value should be <b>s_com</b>-Straight accross and has no dash or Underscore, and is .com or 
     *                                                                    <b>s_net</b>-Straight accross and has no dash or Underscore, and is .net or 
     *                                                                    <b>c_com</b>-Straight accross and has the center - between the words, and is .com or 
     *                                                                    <b>c_net</b>-Straight accross and has the center - between the words, and is .net or 
     *                                                                    <b>s_us</b>-Straight accross and has no dash or Underscore, and is .us or 
     *                                                                    <b>c_us</b>-Straight accross and has the center - between the words, and is .us
     * @return string Returns unique generated id
     */
    public function SearchByKeywords($keyword_ids = array(), $keyword_names = array(), $word_order = 'city_service', $max_domain_selection = 1, $selection_orders = array()) {
        set_time_limit(0);

        $CI = &get_instance();

        $this->word_order = $word_order;
        $this->per_slogan_counts = $max_domain_selection;
        $this->selection_orders = $selection_orders;
        $this->slogan_ids = $keyword_ids;
        $this->slogan_names = $keyword_names;

        $generated_id = uniqid();

        $this->SearchDomains($generated_id, 'keyword');
        if (count($this->generated_domains) > 0) {
            $CI->domain_model->SaveGeneratedDomain($this->generated_domains);
        }

        return $generated_id;
    }

    /**
     * <p style="text-align: justify">
     * Search domain by city and service
     * <p>
     * @access public
     * @author Pronab Saha (pranab.su@gmail.com)
     * @param string $city_names Comma seperated city names
     * @param string $service_names Comma seperated service names
     * @param string $word_order Word order either <b>city_service</b> or <b>service_city</b>
     * @param int $per_slogan_counts Per slogan maximum domain count
     * @param mixed $selection_orders Selection order array value should be <b>s_com</b>-Straight accross and has no dash or Underscore, and is .com or 
     *                                                                    <b>s_net</b>-Straight accross and has no dash or Underscore, and is .net or 
     *                                                                    <b>c_com</b>-Straight accross and has the center - between the words, and is .com or 
     *                                                                    <b>c_net</b>-Straight accross and has the center - between the words, and is .net or 
     *                                                                    <b>s_us</b>-Straight accross and has no dash or Underscore, and is .us or 
     *                                                                    <b>c_us</b>-Straight accross and has the center - between the words, and is .us
     * @return string Returns unique generated id
     */
    public function SearchByCityService($city_names = '', $service_names = '', $word_order = 'city_service', $per_slogan_counts = 1, $selection_orders = array()) {
        set_time_limit(0);

        $CI = &get_instance();

        $this->city_names = $city_names;
        $this->service_names = $service_names;
        $this->word_order = $word_order;
        $this->per_slogan_counts = $per_slogan_counts;
        $this->selection_orders = $selection_orders;

        $cities = explode(', ', $this->city_names);
        $services = explode(', ', $this->service_names);

        $this->MakeSlogans($cities, $services);

        $generated_id = uniqid();

        $this->SearchDomains($generated_id);
        if (count($this->generated_domains) > 0) {
            $CI->domain_model->SaveGeneratedDomain($this->generated_domains);
        }

        return $generated_id;
    }

    /**
     * <p style="text-align: justify">
     * Search domain by slogan names
     * <p>
     * @access public
     * @author Pronab Saha (pranab.su@gmail.com)
     * @param mixed $slogan_ids Slogan ids
     * @param mixed $slogan_names Slogan names
     * @param string $word_order Word order either <b>city_service</b> or <b>service_city</b>
     * @param int $per_slogan_counts Per slogan maximum domain count
     * @param mixed $selection_orders Selection order array value should be <b>s_com</b>-Straight accross and has no dash or Underscore, and is .com or 
     *                                                                    <b>s_net</b>-Straight accross and has no dash or Underscore, and is .net or 
     *                                                                    <b>c_com</b>-Straight accross and has the center - between the words, and is .com or 
     *                                                                    <b>c_net</b>-Straight accross and has the center - between the words, and is .net or 
     *                                                                    <b>s_us</b>-Straight accross and has no dash or Underscore, and is .us or 
     *                                                                    <b>c_us</b>-Straight accross and has the center - between the words, and is .us
     * @return string Returns unique generated id
     */
    public function SearchBySlogan($slogan_ids = array(), $slogan_names = array(), $word_order = 'city_service', $per_slogan_counts = 1, $selection_orders = array()) {
        set_time_limit(0);

        $CI = &get_instance();

        $this->word_order = $word_order;
        $this->per_slogan_counts = $per_slogan_counts;
        $this->selection_orders = $selection_orders;
        $this->slogan_ids = $slogan_ids;
        $this->slogan_names = $slogan_names;

        $generated_id = uniqid();

        $this->SearchDomains($generated_id);
        if (count($this->generated_domains) > 0) {
            $CI->domain_model->SaveGeneratedDomain($this->generated_domains);
        }

        return $generated_id;
    }

    /**
     * <p style="text-align: justify">
     * Core domain search
     * <p>
     * @access protected
     * @author Pronab Saha (pranab.su@gmail.com)
     * @param string $generated_id Generated id
     * @param string $source Source either <b>keyword</b> or <b>slogan</b>
     */
    protected function SearchDomains($generated_id = '', $source = 'slogan') {
        $slogan_lefts = count($this->slogan_names);
        $count = 0;
        $selected_domains = array();
        
        foreach ($this->slogan_names as $slogan) {
            $total_found = $total_looped = 0;
            $orders = $this->selection_orders;

            while ($total_looped < 6) {
                if ($total_found == $this->per_slogan_counts) {
                    break;
                }

                $order = array_shift($orders);
                if ($order) {
                    $parts = explode('_', $order);

                    $is_plain = $parts[0] == 's' ? TRUE : FALSE;
                    $tld = "." . $parts[1];

                    $domain_name = $this->ConvertStringToDomain($tld, $slogan, $is_plain);
                    if ($this->IsDomainAvailable($domain_name, $slogan_lefts) && in_array($domain_name, $selected_domains) == FALSE) {
                        array_push($selected_domains, $domain_name);
                        
                        if ($tld == '.com') {
                            $tld = 'com';
                        } else if ($tld == '.net') {
                            $tld = 'net';
                        } else if ($tld == '.us') {
                            $tld = 'us';
                        }

                        $data = array(
                            'generated_id' => $generated_id,
                            'slogan_or_keyword_id' => $this->slogan_ids[$count],
                            'domain_name' => $domain_name,
                            'domain_type' => $tld,
                            'generation_source' => $source,
                            'status' => 'free'
                        );

                        array_push($this->generated_domains, $data);

                        $total_found++;
                        $slogan_lefts--;
                    }
                }
                $total_looped++;
                $slogan_lefts--;
            }

            $count++;
        }
    }

    /**
     * <p style="text-align: justify">
     * Check domain availability
     * <p>
     * @access protected
     * @author Pronab Saha (pranab.su@gmail.com)
     * @param string $domain_name Domain name
     * @param int $slogan_lefts Slogan left count
     * @return boolean Returns TRUE if available otherwise FALSE
     */
    protected function IsDomainAvailable($domain_name = '', $slogan_lefts = 300) {
//        $CI = &get_instance();
//
//        if ($CI->domain_model->IsDomainAvailable() == FALSE) {
//            return FALSE;
//        } else {
//            $username = $this->api_user;
//            $password = $this->api_user_pass;
//
//            if ($slogan_lefts > 300) {
//                sleep(10);
//            }
//
//            $contents = file_get_contents("http://www.whoisxmlapi.com/whoisserver/WhoisService?domainName=$domain_name&cmd=GET_DN_AVAILABILITY&username=$username&password=$password&outputFormat=JSON");
//
//
//            $res = json_decode($contents);
//            if ($res) {
//                $domainInfo = $res->DomainInfo;
//                if ($domainInfo) {
//                    if ($domainInfo->domainAvailability == 'AVAILABLE') {
//                        //array_push($this->domains, $domain_name);
//                        return TRUE;
//                    } else {
//                        $CI->domain_model->InsertUnavailableDomain($domain_name);
//                        return FALSE;
//                    }
//                } else {
//                    return FALSE;
//                }
//            }
//        }
        return TRUE;
    }

    /**
     * <p style="text-align: justify">
     * Convert string into domain name
     * <p>
     * @access protected
     * @author Pronab Saha (pranab.su@gmail.com)
     * @param string $tld TLD
     * @param string $text Text
     * @param string $is_plain Is plain order
     * @return string Returns domain name
     */
    protected function ConvertStringToDomain($tld = '.com', $text = '', $is_plain = TRUE) {
        if ($is_plain) {
            $text = preg_replace('/\s/', '', $text);
        } else {
            $text = preg_replace('/\s/', '-', $text);
        }

        return $text . $tld;
    }

    /**
     * <p style="text-align: justify">
     * Make slogans
     * <p>
     * @access protected
     * @author Pronab Saha (pranab.su@gmail.com)
     * @param mixed $cities City array
     * @param mixed $services Service array
     */
    protected function MakeSlogans($cities = array(), $services = array()) {
        $CI = &get_instance();

        if ($this->word_order == 'city_service') {
            foreach ($cities as $city) {
                foreach ($services as $service) {
                    array_push($this->slogan_names, trim(strtolower($city . " " . $service)));
                }
            }
        } else {
            foreach ($services as $service) {
                foreach ($cities as $city) {
                    array_push($this->slogan_names, trim(strtolower($service . " " . $city)));
                }
            }
        }

        $slogan_data = array(
            'cities' => $this->city_names,
            'services' => $this->service_names,
            'modified_date' => strtotime('now')
        );

        $slogan_data_id = $CI->slogan_model->UpdateSloganData($slogan_data);
        $slogans = array();
        foreach ($this->slogan_names as $slogan) {
            $data = array(
                'slogan_data_id' => $slogan_data_id,
                'slogan_name' => $slogan
            );
            array_push($slogans, $data);
        }

        $CI->slogan_model->SaveGeneratedSlogans($slogans);
        $this->slogan_ids = $CI->slogan_model->GetSloganIds($slogan_data_id);
    }

    /**
     * <p style="text-align: justify">
     * Validate inputs
     * <p>
     * @access protected
     * @author Pronab Saha (pranab.su@gmail.com)
     * @return string Returns empty string if inputs are valid otherwise validation message
     */
    protected function ValidateInputs() {
        if (trim($this->city_names) == FALSE) {
            return 'No city name given. Please provide city names';
        } else if (trim($this->service_names) == FALSE) {
            return 'No service name given. Please provide service names';
        } else if ($this->word_order != 'city_service' || $this->word_order != 'service_city') {
            return '';
        } else if (count($this->selection_orders) != 6) {
            return 'Total selection order should be 6';
        } else {
            return '';
        }
    }

}

