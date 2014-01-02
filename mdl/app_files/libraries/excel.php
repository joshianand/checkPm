<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "third_party/PHPExcel.php";

/**
 * Excel
 * <p style="text-align:justify">
 * Library for excel file read/export
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Library
 * @category Library
 * @author Pronab Saha (pronab@kashmart.com)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */
class Excel extends PHPExcel {

    /**
     * Class constructor
     */
    public function __construct() {
        parent::__construct();
    }
}

/* End of file excel.php */
/* Location: ./application/libraries/excel.php */