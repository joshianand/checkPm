<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Core model
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class G_Model extends CI_Model{
    /**
     * Class constructor
     * @access public
     */
    public function __construct(){
        parent::__construct();
    }
}