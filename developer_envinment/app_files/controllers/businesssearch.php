<?php

class Businesssearch extends G_Controller {
    /**
     * Class constructor
     * @access public
     */
    public function __construct() {
        parent::__construct(get_class());

        $this->load->model('module_models/lead_generator/Model_yp', 'yp_model');
        $this->load->model('module_models/business_directory/Model_business_search', 'bs_model');
        $this->load->library(array(
            'excel',
            'module_libraries/lead_generator/yellowapi'
        ));
        $this->load->helper('modules/lead_generator/yp');
        $this->load->helper('modules/search_domain/csv');
    }

    /**
     * @access public
     */
    public function index() {
        $page_data['token'] = $this->token;
        $page_data['cities'] = $this->yp_model->getCities();
        $this->page_title = "Business Directory";
        
        $this->construct_ui();
        $this->template->write_view('content', 'module_views/business_directory/business_search', $page_data);
        $this->template->render();
    }
    
    /**
     * <p style="text-align:justify">
     * Get search data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function GetSearchList() {
        if (IS_AJAX) {
            $search_params = array(
                "city_id" => $this->input->get('city', TRUE) ? $this->input->get('city', TRUE): "",
                "search_text" => $this->input->get('search_text', TRUE) ? $this->input->get('search_text', TRUE): ""
            );
            
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'desc' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'search_id' : $sort_data[0]['field'];

            $data['search_data'] = $this->bs_model->GetSearchList($limit, $offset, $sort_direction, $sort_field, $search_params);
            $data['count'] = $this->bs_model->CountSearchList($search_params);
            
            echo json_encode($data);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }
}

?>
