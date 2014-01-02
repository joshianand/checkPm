<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for slogan generator
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author YOUR NAME (YOUR EMAIL ADDRESS)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */
class Domain extends G_controller {

    /**
     * Class constructor
     * @access public
     */
    public function __construct() {
        parent::__construct(get_class());

        $this->load->model('module_models/slogan_generator/Model_slogan', 'slogan_model');
        $this->load->model('module_models/search_domain/Model_domain', 'domain_model');

        $this->load->library('module_libraries/search_domain/domainsearch');

        $this->load->helper('modules/search_domain/csv');
    }

    /**
     * @access public
     */
    public function index() {
        $option_settings = $this->session->userdata('domain_search_settings');
        $page_data['slogan_keys'] = $this->slogan_model->GetSloganDataList(0, 0);
        $page_data['option_settings'] = array(
            'first_selectionorders' => trim($option_settings['first_selectionorders']) == FALSE ? 's_com' : $option_settings['first_selectionorders'],
            'second_selectionorders' => trim($option_settings['second_selectionorders']) == FALSE ? 's_net' : $option_settings['second_selectionorders'],
            'third_selectionorders' => trim($option_settings['third_selectionorders']) == FALSE ? 'c_com' : $option_settings['third_selectionorders'],
            'fourth_selectionorders' => trim($option_settings['fourth_selectionorders']) == FALSE ? 'c_net' : $option_settings['fourth_selectionorders'],
            'fifth_selectionorders' => trim($option_settings['fifth_selectionorders']) == FALSE ? 's_us' : $option_settings['fifth_selectionorders'],
            'sixth_selectionorders' => trim($option_settings['sixth_selectionorders']) == FALSE ? 'c_us' : $option_settings['sixth_selectionorders'],
        );
        $page_data['token'] = $this->token;
        $this->construct_ui();
        $this->template->write_view('content', 'module_views/search_domain/index', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Save selection settings
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function SaveSelectionSettings() {
        $domain_search_settings = array(
            'first_selectionorders' => $this->input->post('firstSelectionOrder', TRUE),
            'second_selectionorders' => $this->input->post('secondSelectionOrder', TRUE),
            'third_selectionorders' => $this->input->post('thirdSelectionOrder', TRUE),
            'fourth_selectionorders' => $this->input->post('fourthSelectionOrder', TRUE),
            'fifth_selectionorders' => $this->input->post('fifthSelectionOrder', TRUE),
            'sixth_selectionorders' => $this->input->post('sixthSelectionOrder', TRUE)
        );

        $this->session->set_userdata('domain_search_settings', $domain_search_settings);
    }

    /**
     * <p style="text-align:justify">
     * Get slogan list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function GetSloganList() {
        if ($this->input->is_ajax_request()) {
            $key = $this->input->post('sloganSource', TRUE);
            $data['options'] = $this->slogan_model->GetSloganList($key, 0, 0);
            echo json_encode($data);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Search domain by keywords
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function SearchByKeyword() {
        if (IS_AJAX) {
            $output_result = array();
            $output_result['flag'] = 1;

            $keywords = preg_split('/\r\n|\r|\n/', $this->input->post('keywords', TRUE));
            $max_domain_selection = $this->input->post('domainsPerKeyword', TRUE);

            if (count($keywords) > 0 && count($keywords) < 500) {
                $option_settings = $this->session->userdata('domain_search_settings');
                $selection_settings = array(
                    'first_selectionorders' => trim($option_settings['first_selectionorders']) == FALSE ? 's_com' : $option_settings['first_selectionorders'],
                    'second_selectionorders' => trim($option_settings['second_selectionorders']) == FALSE ? 's_net' : $option_settings['second_selectionorders'],
                    'third_selectionorders' => trim($option_settings['third_selectionorders']) == FALSE ? 'c_com' : $option_settings['third_selectionorders'],
                    'fourth_selectionorders' => trim($option_settings['fourth_selectionorders']) == FALSE ? 'c_net' : $option_settings['fourth_selectionorders'],
                    'fifth_selectionorders' => trim($option_settings['fifth_selectionorders']) == FALSE ? 's_us' : $option_settings['fifth_selectionorders'],
                    'sixth_selectionorders' => trim($option_settings['sixth_selectionorders']) == FALSE ? 'c_us' : $option_settings['sixth_selectionorders'],
                );

                $keyworkd_ids = $this->domain_model->SaveSuppliedKeywords($keywords);
                $keyword_names = array();
                foreach ($keywords as $keyword) {
                    array_push($keyword_names, $keyword);
                }

                $output_result['generated_id'] = $this->domainsearch->SearchByKeywords($keyworkd_ids, $keyword_names, 'city_service', $max_domain_selection, $selection_settings);
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = 'Number of keywords must be between 1-500';
            }

            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Search domain by city and services
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function SearchByCityService() {
        if (IS_AJAX) {
            $output_result = array();
            $output_result['flag'] = 1;

            $city_names = $this->input->post('cityNames', TRUE);
            $service_names = $this->input->post('serviceNames', TRUE);
            $max_domain_selection = $this->input->post('domainsPerCombination', TRUE);


            $option_settings = $this->session->userdata('domain_search_settings');
            $selection_settings = array(
                'first_selectionorders' => trim($option_settings['first_selectionorders']) == FALSE ? 's_com' : $option_settings['first_selectionorders'],
                'second_selectionorders' => trim($option_settings['second_selectionorders']) == FALSE ? 's_net' : $option_settings['second_selectionorders'],
                'third_selectionorders' => trim($option_settings['third_selectionorders']) == FALSE ? 'c_com' : $option_settings['third_selectionorders'],
                'fourth_selectionorders' => trim($option_settings['fourth_selectionorders']) == FALSE ? 'c_net' : $option_settings['fourth_selectionorders'],
                'fifth_selectionorders' => trim($option_settings['fifth_selectionorders']) == FALSE ? 's_us' : $option_settings['fifth_selectionorders'],
                'sixth_selectionorders' => trim($option_settings['sixth_selectionorders']) == FALSE ? 'c_us' : $option_settings['sixth_selectionorders'],
            );

            $output_result['generated_id'] = $this->domainsearch->SearchByCityService($city_names, $service_names, 'city_service', $max_domain_selection, $selection_settings);

            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Search by slogans
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function SearchBySlogan() {
        if ($this->input->is_ajax_request()) {
            $output_result = array();
            $output_result['flag'] = 1;

            $slogan_source = $this->input->post('sloganSource', TRUE);
            $slogan_ids = json_decode($this->input->post('slogans', TRUE));
            $max_domain_selection = $this->input->post('domainsPerSlogan', TRUE);

            $option_settings = $this->session->userdata('domain_search_settings');
            $selection_settings = array(
                'first_selectionorders' => trim($option_settings['first_selectionorders']) == FALSE ? 's_com' : $option_settings['first_selectionorders'],
                'second_selectionorders' => trim($option_settings['second_selectionorders']) == FALSE ? 's_net' : $option_settings['second_selectionorders'],
                'third_selectionorders' => trim($option_settings['third_selectionorders']) == FALSE ? 'c_com' : $option_settings['third_selectionorders'],
                'fourth_selectionorders' => trim($option_settings['fourth_selectionorders']) == FALSE ? 'c_net' : $option_settings['fourth_selectionorders'],
                'fifth_selectionorders' => trim($option_settings['fifth_selectionorders']) == FALSE ? 's_us' : $option_settings['fifth_selectionorders'],
                'sixth_selectionorders' => trim($option_settings['sixth_selectionorders']) == FALSE ? 'c_us' : $option_settings['sixth_selectionorders'],
            );

            if ($slogan_source > 0 && count($slogan_ids) == 0) {
                $slogan_ids = $this->slogan_model->GetSloganIds($slogan_source);
            }

            $slogan_names = $this->slogan_model->GetSloganNames($slogan_ids);
            
            $output_result['generated_id'] = $this->domainsearch->SearchBySlogan($slogan_ids, $slogan_names, 'city_service', $max_domain_selection, $selection_settings);

            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Save searched data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function SaveSearchedDomains() {
        if ($this->input->is_ajax_request()) {
            $output_result = array();

            $com_selections = json_decode($this->input->post('com_selections', TRUE));
            $net_selections = json_decode($this->input->post('net_selections', TRUE));
            $us_selections = json_decode($this->input->post('us_selections', TRUE));

            if (count($com_selections) == 0 && count($net_selections) == 0 && count($us_selections) == 0) {
                $output_result['flag'] = 0;
                $output_result['message'] = 'Please select at least 1 domain to save';
            } else {
                $saved_domains = array();
                foreach ($com_selections as $domain_id) {
                    $data = array(
                        'id' => $domain_id,
                        'status' => 'used'
                    );
                    array_push($saved_domains, $data);
                }

                foreach ($net_selections as $domain_id) {
                    $data = array(
                        'id' => $domain_id,
                        'status' => 'used'
                    );
                    array_push($saved_domains, $data);
                }

                foreach ($us_selections as $domain_id) {
                    $data = array(
                        'id' => $domain_id,
                        'status' => 'used'
                    );
                    array_push($saved_domains, $data);
                }

                if ($this->domain_model->SaveDomains($saved_domains) === TRUE) {
                    $output_result['flag'] = 1;
                    $output_result['message'] = 'Selected domains saved successfully';
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = 'An error occur. Please try again';
                }
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Get generated domains
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function GetGeneratedDomains() {
        if (IS_AJAX) {
            $domain_type = $this->input->get('domain_type', TRUE);
            $generated_id = $this->input->get('generated_id', TRUE);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'desc' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'domain_id' : $sort_data[0]['field'];

            $data['domains'] = $this->domain_model->GetGeneratedDomainList($generated_id, $domain_type, $sort_direction, $sort_field);
            $data['count'] = $this->domain_model->CountGeneratedDomains($generated_id, $domain_type);

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Download domains
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function DownloadGeneratedDomains() {
        $generated_id = $this->input->get('gid', TRUE);
        if (trim($generated_id) == FALSE) {
            show_error('Sorry, no generated domain found to be downloaded');
        } else {
            $data = $this->domain_model->GetDownloadableDomains($generated_id);
            array_to_csv($data, 'domains.csv');
        }
    }
}

/* End of file  slogan.php */
/* Location: ./application/controllers/slogan.php */
