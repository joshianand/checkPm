<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * <p style="text-align:justify">
 * Core controller
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class G_Controller extends CI_Controller {

    protected $token;
    protected $page_title;
    protected $user_data = array();

    /**
     * Class constructor
     * @access public
     */
    public function __construct($page_title = '') {
        parent::__construct();
        
        $task_id = trim($this->input->get('tid', TRUE));
        $this->token = $this->security->get_csrf_hash();
        $this->page_title = $page_title;
        
        $this->user_data = $this->session->userdata('login_data');

        if ($task_id) {
            $this->user_data['tid'] = $task_id;
            $this->session->set_userdata('login_data', $this->user_data);
        }

        $this->load->model('core_models/Model_shared', 'shared');
        $this->prepare_styles_and_scripts();

        $this->validate_access();
    }

    /**
     * <p style="text-align:justify">
     * Processing access
     * </p>
     * @access protected
     */
    protected function validate_access() {
        if (count($this->user_data) == 0) {
            redirect('home');
        } else {
            if (isset($this->user_data['tid'])) {
                $task_id = $this->encrypt->decode($this->user_data['tid']);
                $group_id = $this->user_data['group_id'];

                if ($this->shared->is_accessible($task_id, $group_id) == FALSE) {
                    show_error('Sorry, page not found');
                }
            }
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing UI construction
     * </p>
     * @access protected
     */
    protected function construct_ui() {
        $page_data['user_data'] = $this->user_data;
        $page_data['page_title'] = $this->page_title;
        $page_data['menu_data'] = $this->shared->get_menu_items(element('group_id', $this->user_data));

        if($this->page_title == 'Dashboard' || $this->page_title == 'Profile'){
            $page_data['nav_data'] = array(
                'task_name' => '',
                'task_link' => '',
                'parent_task_name' => ''
            );
        } else {
            $page_data['nav_data'] = $this->shared->get_task_details($this->encrypt->decode($this->user_data['tid']));
        }
        
        $this->template->write_view('header_nav', 'shared/header_nav', $page_data);
        $this->template->write_view('sidebar_nav', 'shared/sidebar_nav', $page_data);
        $this->template->write_view('bread_crumb', 'shared/bread_crumb', $page_data);
    }

    /**
     * <p style="text-align:justify">
     * Processing asset managing
     * </p>
     * @access protected
     */
    protected function prepare_styles_and_scripts() {
        //Styles
//        $this->carabiner->css('kendo/styles/kendo.common.min.css');
//        $this->carabiner->css('kendo/styles/kendo.bootstrap.min.css');
//        $this->carabiner->css('bootstrap/css/bootstrap.css');
//        $this->carabiner->css('bootstrap/css/bootstrap-responsive.min.css');
//        $this->carabiner->css('css/metro.css');
//        $this->carabiner->css('font-awesome/css/font-awesome.css');
//        $this->carabiner->css('css/style.css');
//        $this->carabiner->css('css/style_responsive.css');
//        $this->carabiner->css('css/style_default.css');
//        $this->carabiner->css('gritter/css/jquery.gritter.css');
//        $this->carabiner->css('uniform/css/uniform.default.css');
        //Scripts
        //$this->carabiner->js('js/jquery-1.10.2.min.js');
        
        $this->carabiner->js('kendo/js/kendo.web.min.js');
        $this->carabiner->js('breakpoints/breakpoints.js');
        $this->carabiner->js('jquery-slimscroll/jquery.slimscroll.min.js');
        $this->carabiner->js('bootstrap/js/bootstrap.min.js');
        $this->carabiner->js('js/jquery.blockui.js');
        $this->carabiner->js('js/jquery.cookie.js');
        $this->carabiner->js('gritter/js/jquery.gritter.js');
        $this->carabiner->js('uniform/jquery.uniform.min.js');
        $this->carabiner->js('js/jquery.pulsate.min.js');
        $this->carabiner->js('js/app.js');

        $this->carabiner->js('js/commonui.js');
    }

}

/* End of file  core_controller.php */
/* Location: ./application/controllers/core_controller.php */
