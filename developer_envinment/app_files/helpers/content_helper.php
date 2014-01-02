<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('add_script')) {

    /**
     * <p style="text-align:justify">
     * Add external script file
     * </p>
     * @param type $script_file Path of script file
     */
    function add_script($script_file = '') {
        $CI = & get_instance();
        $CI->load->library('template');

        $script = '<script type="text/javascript" src="' . base_url() . 'scripts/' . $script_file . '"></script>';
        $CI->template->write('external_scripts', $script);
    }

}

if (!function_exists('add_styles')) {
    /**
     * <p style="text-align:justify">
     * Add external style file
     * </p>
     * @param type $style_file Path of style file
     */
    function add_styles($style_file = '') {
        $style = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'styles/' . $style_file . '"/>';
        $CI = & get_instance();
        $CI->load->library('template');
        $CI->template->write('external_styles', $style);
    }

}

if (!function_exists('send_custom_email')) {
    /**
     * <p style="text-align:justify">
     * Send custom email
     * </p>
     * @param string $template Template file name
     * @param string $to Destination address
     * @param string $cc CC address
     * @param string $subject Mail subject
     * @param array $data Mail data
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    function send_custom_email($template = '', $to = '', $cc = '', $subject = '', $data = array()) {
        $CI = & get_instance();
        $CI->load->library('parser');
        $CI->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;

        $CI->email->initialize($config);

        $CI->email->from('info@soft.com', 'Software Developer Pro');
        $CI->email->to($to);

        if ($cc != '') {
            $CI->email->cc($cc);
        }

        $CI->email->subject($subject);

        $message = $CI->parser->parse('emails/' . $template, $data, TRUE);

        $CI->email->message($message);

        if ($CI->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

if (!function_exists('recursive_remove_directory')) {

    /**
     * <p style="text-align:justify">
     * Remove a directory recusrsively
     * </p>
     * @param type $directory
     * @param type $empty
     * @return boolean
     */
    function recursive_remove_directory($directory = '', $empty = FALSE) {
        // if the path has a slash at the end we remove it here
        if (substr($directory, -1) == '/') {
            $directory = substr($directory, 0, -1);
        }

        // if the path is not valid or is not a directory ...
        if (!file_exists($directory) || !is_dir($directory)) {
            // ... we return false and exit the function
            return FALSE;

            // ... if the path is not readable
        } elseif (!is_readable($directory)) {
            // ... we return false and exit the function
            return FALSE;

            // ... else if the path is readable
        } else {

            // we open the directory
            $handle = opendir($directory);

            // and scan through the items inside
            while (FALSE !== ($item = readdir($handle))) {
                // if the filepointer is not the current directory
                // or the parent directory
                if ($item != '.' && $item != '..') {
                    // we build the new path to delete
                    $path = $directory . '/' . $item;

                    // if the new path is a directory
                    if (is_dir($path)) {
                        // we call this function with the new path
                        recursive_remove_directory($path);

                        // if the new path is a file
                    } else {
                        // we remove the file
                        unlink($path);
                    }
                }
            }
            // close the directory
            closedir($handle);

            // if the option to empty is not set to true
            if ($empty == FALSE) {
                // try to delete the now empty directory
                if (!rmdir($directory)) {
                    // return false if not possible
                    return FALSE;
                }
            }
            // return success
            return TRUE;
        }
    }

}

if (!function_exists('get_random_string')) {

    /**
     * <p style="text-align:justify">
     * Get random string
     * </p>
     * @param int $length Desired length of the string
     * @return string Retuns random string
     */
    function get_random_password($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}

if (!function_exists('generate_password')) {

    /**
     * <p style="text-align:justify">
     * Generate encrypted password
     * </p>
     * @param string $password Plain password
     * @return string Generate encrypted password
     */
    function generate_password($password = '') {
        $salt = sha1(uniqid());
        $digest = sha1($password . $salt) . '$' . $salt;
        return $digest;
    }

}