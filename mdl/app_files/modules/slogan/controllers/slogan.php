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
class Slogan extends G_controller{
    /**
     * Class constructor
     * @access public
     */
    public function __construct(){
         parent::__construct(get_class());
         $this->load->model('module_models/slogan_generator/Model_slogan','slogan_model');
    }
    
    /**
     * @access public
     */
    public function index(){
        $page_data['token'] = $this->token;
        $this->construct_ui();
        $this->template->write_view('content', 'module_views/slogan_generator/index', $page_data);
        $this->template->render();
    }
    
    /**
     * <p style="text-align:justify">
     * Get slogan data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function GetSloganData() {
        if ($this->input->is_ajax_request()) {
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'desc' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'model_id' : $sort_data[0]['field'];

            $data['slogan_data'] = $this->slogan_model->GetSloganDataList($limit, $offset, $sort_direction, $sort_field);
            $data['count'] = $this->slogan_model->CountSloganDataList();

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Get slogans
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function GetSlogans() {
        if ($this->input->is_ajax_request()) {
            $data_id = $this->input->get('data_id', TRUE);
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'desc' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'model_id' : $sort_data[0]['field'];

            $data['slogans'] = $this->slogan_model->GetSloganList($data_id, $limit, $offset, $sort_direction, $sort_field);
            $data['count'] = $this->slogan_model->CountSloganList($data_id);

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Create slogan data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function CreateSloganData() {
        if ($this->input->is_ajax_request()) {
            $cities = trim($this->input->post('cities', TRUE));
            $services = trim($this->input->post('services', TRUE));

            if ($this->slogan_model->IsDuplicateSloganData($cities, $services, 0)) {
                echo '0*Duplicate slogan data found. Please choose another';
            } else {
                $slogan_data = array(
                    'cities' => $cities,
                    'services' => $services,
                    'modified_date' => strtotime('now')
                );
                $slogan_data_id = $this->slogan_model->UpdateSloganData($slogan_data, NULL, 1, 0);
                if ($slogan_data_id > 0) {
                    $generated_slogans = $this->GenerateSlogan($slogan_data_id, $cities, $services);
                    $this->slogan_model->SaveGeneratedSlogans($generated_slogans);
                    echo '1*Slogan added successfully';
                } else {
                    echo '0*An error occured. Please try again';
                }
            }
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Update slogan data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function UpdateSloganData() {
        if ($this->input->is_ajax_request()) {
            $data_id = $this->input->post('data_id', TRUE);
            $cities = $this->input->post('cities', TRUE);
            $services = $this->input->post('services', TRUE);

            if ($this->slogan_model->IsDuplicateSloganData($cities, $services, $data_id)) {
                echo '0*Duplicate slogan data found. Please choose another';
            } else {
                $slogan_data = array(
                    'cities' => $cities,
                    'services' => $services,
                    'modified_date' => strtotime('now')
                );
                $generated_slogans = $this->GenerateSlogan($data_id, $cities, $services);

                if ($this->slogan_model->UpdateSloganData($slogan_data, $generated_slogans, 0, $data_id) === TRUE) {
                    echo '1*Slogan updated successfully';
                } else {
                    echo '0*An error occured. Please try again';
                }
            }
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Delete slogan data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function DeleteSloganData() {
        if ($this->input->is_ajax_request()) {
            $data_id = $this->input->post('data_id', TRUE);
            if ($this->slogan_model->UpdateSloganData(NULL, NULL, -1, $data_id) === TRUE) {
                echo '1*Slogan deleted successfully';
            } else {
                echo '0*An error occured. Please try again';
            }
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Generate slogans
     * </p>
     * @access protected
     * @author Pronab saha<pranab.su@gmail.com>
     * @param mixed $slogan_data_id Slogan data id
     * @param mixed $cities City array
     * @param mixed $services Service array
     * @return array returns slogan array
     */
    protected function GenerateSlogan($slogan_data_id = 0, $cities = array(), $services = array()) {
        $slogans = array();
        $cities = explode(',', $cities);
        $services = explode(',', $services);

        foreach ($cities as $city) {
            foreach ($services as $service) {
                $data = array(
                    'slogan_data_id' => $slogan_data_id,
                    'slogan_name' => strtolower(trim($city) . " " . trim($service))
                );
                array_push($slogans, $data);
            }
        }

        return $slogans;
    }
}

/* End of file  slogan.php */
/* Location: ./application/controllers/slogan.php */
