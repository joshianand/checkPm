<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * K_Zip
 * <p style="text-align:justify">
 * Library for extended CI ZIP class
 * </p>
 */
class G_Zip extends CI_Zip {

    /**
     * Class constructor
     */
    public function __construct() {
        parent::__construct();
    }

    function get_files_from_folder($directory='', $put_into='') {
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                if (is_file($directory . $file)) {
                    $fileContents = file_get_contents($directory . $file);

                    $this->add_data($put_into . $file, $fileContents);
                } elseif ($file != '.' and $file != '..' and is_dir($directory . $file)) {

                    $this->add_dir($put_into . $file . '/');

                    $this->get_files_from_folder($directory . $file . '/', $put_into . $file . '/');
                }
            }
        }
        closedir($handle);
    }

}

