<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for dashboard
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Dashboard extends G_controller {
    
    public function __construct() {
        parent::__construct(get_class());
    }
    
    /**
     * <p style="text-align:justify">
     * Display dashboard page
     * </p>
     * @access public
     */
    public function index() {
        $page_data['token'] = $this->token;

        $this->construct_ui('Dashboard');
        $this->template->write_view('content', 'core_views/dashboard', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing log out
     * </p>
     * @access public
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}

