<?php
/**
 * <p style="text-align:justify">
 * Controller for settings
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab saha (pranab.su@gmail.com)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */

class Settings extends G_Controller {
    
    /**
     * Class constructor
     * @access public
     */
    public function __construct() {
        parent::__construct(get_class());

        $this->load->model('module_models/lead_generator/Model_setting', 'setting_model');
    }
    
    /**
     * @access public
     */
    public function index() {
        $page_data['token'] = $this->token;
        $page_data['settings'] = $this->setting_model->getAllSettings();
        $this->page_title = "Settings";
        $this->construct_ui();
        $this->template->write_view('content', 'module_views/lead_generator/settings', $page_data);
        $this->template->render();
    }
    
    function save_settings(){
        if($this->session->userdata("login_data")){
            $login_data = $this->session->userdata("login_data");
            if(isset($login_data["user_id"])){
                if($this->input->post("runCronFor")){
                    $this->setting_model->save($this->input->post());
                }

                redirect("settings/index");
            }
            else{
                redirect("");
            }
        }
        else{
            show_error("Some error has occurred");
        }
    }
}

?>
