<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


if (!function_exists('extract_pagination_count')) {

    /**
     * <p style="text-align:justify">
     * Extract pagination counts
     * </p>
     * @author Pronab Saha <pranab.su@gmail.com>
     * @param mixed $pagination_string Pagination string
     * @return array Returns Pagination count array
     */
    function extract_pagination_count($pagination_string = '') {
        $pagination_string = trim($pagination_string);
        preg_match_all('!\d+!', $pagination_string, $matches);
        return $matches[0];
    }

}