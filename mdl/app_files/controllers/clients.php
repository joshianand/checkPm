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
class clients extends G_controller {

    /**
     * Class constructor
     * @access public
     */
    public function __construct() {
        parent::__construct(get_class());

        //$this->load->model('Model_clients', 'clients');
        $this->load->library('module_libraries/search_domain/domainsearch');
        $this->load->helper('modules/search_domain/csv');
    }

    /**
     * @access public
     */
    public function manage_clients() {
        $option_settings = $this->session->userdata('domain_search_settings');
        //$page_data['slogan_keys'] = $this->slogan_model->GetSloganDataList(0, 0);
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
        $this->template->write_view('content', 'manage_clients', $page_data);
        $this->template->render();
    }
public function client_groups() {
        $option_settings = $this->session->userdata('domain_search_settings');
       // $page_data['slogan_keys'] = $this->slogan_model->GetSloganDataList(0, 0);
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
        $this->template->write_view('content', 'client_groups', $page_data);
        $this->template->render();
    }
    public function add_new_client() {
        $option_settings = $this->session->userdata('domain_search_settings');
        //$page_data['slogan_keys'] = $this->slogan_model->GetSloganDataList(0, 0);
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
        $this->template->write_view('content', 'add_new_client', $page_data);
        $this->template->render();
    }
    public function send_bulk_email() {
        $option_settings = $this->session->userdata('domain_search_settings');
        //$page_data['slogan_keys'] = $this->slogan_model->GetSloganDataList(0, 0);
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
        $this->template->write_view('content', 'send_bulk_email', $page_data);
        $this->template->render();
    }
    
}

/* End of file  slogan.php */
/* Location: ./application/controllers/slogan.php */
