<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for home login
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->prepareStylesAndScripts();
        $this->load->model('core_models/Model_shared', 'shared');
    }
    
    /**
     * <p style="text-align:justify">
     * Display login page
     * </p>
     * @access public
     */
    public function index() {
        $this->session->sess_destroy();
        $login_data['token'] = $this->security->get_csrf_hash();
        $this->load->view('home', $login_data);
    }

    /**
     * <p style="text-align:justify">
     * Login processing
     * </p>
     * @access public
     */
    public function login() {
        if (IS_AJAX) {
            $login_name = trim($this->input->post('username', TRUE));
            $login_pass = $this->input->post('password', TRUE);

            $login_result = $this->shared->validate_login($login_name, $login_pass);
            $output_result = array();

            if (count($login_result) > 0) {
                if (element('active', $login_result) == 'no') {
                    $output_result['flag'] = 0;
                    $output_result['message'] = 'Sorry, this account is blocked by administrator';
                } else {
                    list($stored_pw, $stored_salt) = explode('$', element('login_pass', $login_result));
                    if ($stored_pw == sha1($login_pass . $stored_salt)) {
                        $this->session->set_userdata('login_data', $login_result);
                        $output_result['flag'] = 1;
                        $output_result['message'] = '';
                    } else {
                        $output_result['flag'] = 0;
                        $output_result['message'] = 'Sorry, invalid user password given.';
                    }
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = 'Sorry, invalid user name given.';
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing assets
     * </p>
     * @access protected
     */
    protected function prepareStylesAndScripts() {
        //Styles
        $this->carabiner->css('bootstrap/css/bootstrap.min.css');
        $this->carabiner->css('css/metro.css');
        $this->carabiner->css('font-awesome/css/font-awesome.css');
        $this->carabiner->css('css/style.css');
        $this->carabiner->css('css/style_responsive.css');
        $this->carabiner->css('css/style_default.css');
        $this->carabiner->css('uniform/css/uniform.default.css');

        //Scripts
        //$this->carabiner->js('js/jquery-1.10.2.min.js');
        $this->carabiner->js('js/jquery-migrate-1.2.1.min.js');
        $this->carabiner->js('bootstrap/js/bootstrap.min.js');
        $this->carabiner->js('uniform/jquery.uniform.min.js');
        $this->carabiner->js('js/jquery.blockui.js');
        $this->carabiner->js('jquery-validation/dist/jquery.validate.min.js');
        $this->carabiner->js('js/app.js');
        $this->carabiner->js('js/commonui.js');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */