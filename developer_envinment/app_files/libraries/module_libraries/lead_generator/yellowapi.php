<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'third_party/htmldom.php';

/**
 * <p style="text-align:justify">
 * Library for scrapping yellow page data
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Library
 * @category Library
 * @author Pronab Saha (pranab.su@gmail.com)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */
class Yellowapi {

    /**
     * Initialize the Yellow API with needed information
     */
    public function __construct() {
        
    }

    /**
     * <p style="text-align:justify">
     * Search business listings
     * </p>
     * @access public
     * @param string $what Searched text
     * @param string $where Searced location
     * @param int $page Page number
     * @return array Returns business list array
     */
    public function scrap_business($what = '', $where = '', $page = 1) {
        $search_details = array();

        $what = str_replace(' ', '+', $what);
        $where = str_replace(' ', '+', $where);

        if ($page == 1) {
            $query = "http://www.yellowpages.com/$where/$what?menu_search=false&order=name";
        } else {
            $query = "http://www.yellowpages.com/$where/$what?menu_search=false&order=name&page=$page";
        }

        $data = $this->scrape_request($query);
        $data = $this->scrape_between($data, '<div id="results">', "<div>");
        $html = str_get_html($data);

        $search_details['details'] = array();

        if ($html) {
            foreach ($html->find('div.listing-content') as $e) {
                $name = $e->find('div.srp-business-name', 0)->plaintext;

                $address_node = $e->find('span.street-address', 0);
                $city_node = $e->find('span.locality', 0);
                $state_node = $e->find('span.region', 0);
                $zip_node = $e->find('span.postal-code', 0);
                $phn_node = $e->find('span.business-phone', 0);
                $rate_node = $e->find('p.average', 0);

                if ($address_node) {
                    $address = $address_node->plaintext;
                } else {
                    $address = '';
                }

                if ($city_node) {
                    $city = $city_node->plaintext;
                } else {
                    $city = '';
                }

                if ($state_node) {
                    $state = $state_node->plaintext;
                } else {
                    $state = '';
                }

                if ($zip_node) {
                    $zip = $zip_node->plaintext;
                } else {
                    $zip = '';
                }

                if ($phn_node) {
                    $phone = $phn_node->plaintext;
                } else {
                    $phone = '';
                }

                if ($rate_node) {
                    $rating = $rate_node->plaintext;
                } else {
                    $rating = '';
                }

                $url_node = $e->find('li.website-feature', 0);
                if ($url_node) {
                    $url = $url_node->innertext;
                    preg_match_all('/<a[^>]+href=([\'"])(.+?)\1[^>]*>/i', $url, $machtes);
                    $website = $machtes[2][0];
                    $website_parts = parse_url($website);
                    $website = $website_parts['host'];
                } else {
                    $website = '';
                }

                $categories = '';
                foreach ($e->find('ul.business-categories') as $ul) {
                    foreach ($ul->find('li') as $li) {
                        $categories .= $li->plaintext;
                    }
                }

                $data = array(
                    'business_name' => $name,
                    'business_category' => $categories,
                    'street_address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'post_code' => $zip,
                    'phone' => $phone,
                    'average_rating' => $rating,
                    'company_url' => $website
                );


                array_push($search_details['details'], $data);
            }

            $search_details['pagination_text'] = $html->find('div.result-totals', 0)->plaintext;
        }

        return $search_details;
    }

    /**
     * <p style="text-align:justify">
     * Scrape email address from domain url
     * </p>
     * @param type $domain_url Domain url
     * @return mixed Returns FALSE if not found otherwise array of email address
     */
    public function scrape_emails($domain_url = '') {
        $domain_url = prep_url($domain_url);

        $html = $this->scrape_request($domain_url);
        if ($html) {
            $grabbed_emails = false;
            $grabbed_emails = $this->grab_from_title($html);

            if (!is_array($grabbed_emails)) {
                $grabbed_emails = $this->grab_from_meta($html);
            }

            if (!is_array($grabbed_emails)) {
                $grabbed_emails = $this->grab_from_homepage($html);
            }

            if (!is_array($grabbed_emails)) {
                $grabbed_emails = $this->grab_from_contact_page($html, $domain_url);
            }

            return $grabbed_emails;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Analyze website
     * </p>
     * @param type $domain_url Domain url
     * @return array Returns analyzed data
     */
    public function analyze_site($domain_url = '') {
        $domain_url = strtolower($domain_url);
        $domain_url = preg_replace('#^(http(s)?://)?w{3}\.#', '', $domain_url);

        $analyzed_data = array();
        $analyzed_data['domain_owner'] = $analyzed_data['domain_age'] = $analyzed_data['seo_tips'] = $analyzed_data['seo_score'] = '';

        $query = "http://www.statscrop.com/www/$domain_url";

        $data = $this->scrape_request($query);
        $html = str_get_html($data);

        if ($html) {
            foreach ($html->find('dl.attributes') as $dl) {
                foreach ($dl->find('dt') as $dt) {
                    if ($dt->plaintext == 'Domain Age:') {
                        $domain_age = $dl->find('dd', 1);
                        if ($domain_age) {
                            $analyzed_data['domain_age'] = $domain_age->plaintext;
                        }
                    }

                    if ($dt->plaintext == 'Domain Owner:') {
                        $domain_owner = $dl->find('dd', 3);
                        if ($domain_owner) {
                            $analyzed_data['domain_owner'] = $domain_owner->plaintext;
                        }
                    }
                }
            }


            $rank_parent = $html->find("#frameright", 0);
            if ($rank_parent) {
                $rank_tag = $rank_parent->find('div', 6)->children(2);
                if ($rank_tag) {
                    $score = $rank_tag->plaintext;
                    preg_match_all('!\d+!', $score, $matches);
                    $analyzed_data['seo_score'] = issset($matches[0][0])?$matches[0][0]:"";
                }
            }


            $seo_tips_tag = $html->find('#seo_info', 0);
            if ($seo_tips_tag) {
                foreach ($seo_tips_tag->find('ul') as $ul) {
                    $counter = 0;
                    foreach ($ul->find('li') as $li) {
                        if ($counter > 0) {
                            $analyzed_data['seo_tips'] .= $li->plaintext;
                        }
                        $counter++;
                    }
                }
            }
        }

        return $analyzed_data;
    }

    /**
     * <p style="text-align:justify">
     * Process scraping
     * </p>
     * @access protected
     * @param string $url Scrape query
     * @return mixed Returns raw scraped data
     */
    protected function scrape_request($url = '') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Scrpe between whole page
     * </p>
     * @access protected
     * @param string $data Page data
     * @param string $start Start mark
     * @param string $end End mark
     * @return mixed Returns raw scraped between data
     */
    protected function scrape_between($data, $start, $end) {
        $data = stristr($data, $start);
        $data = substr($data, strlen($start));
        $stop = stripos($data, $end);
        $data = substr($data, 0, $stop);
        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Grab email from title tag
     * </p>
     * @access protected
     * @param string $html Html data
     * @return array Return email array
     */
    protected function grab_from_title($html = '') {
        if (!preg_match('/<title>(.*)<\/title>/', $html, $contents)) {
            preg_match('/<TITLE>(.*)<\/TITLE>/', $html, $contents);
        }

        $grabbed_emails = false;

        if (count($contents) > 0) {
            $data = $contents[1];

            if ($data != '301 Moved Permanently') {
                $email_address_pattern = "([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})";
                if (preg_match('/' . $email_address_pattern . '/', $data, $list)) {
                    $grabbed_emails = $list[0];
                }
            }
        }


        return $grabbed_emails;
    }

    /**
     * <p style="text-align:justify">
     * Grab email from meta tag
     * </p>
     * @access protected
     * @param string $html Html data
     * @return array Return email array
     */
    protected function grab_from_meta($html = '') {
        $grabbed_emails = false;

        if (!preg_match('/<meta name="keywords" content="(.*)" \/> /i', $html, $contents)) {
            preg_match('/<meta name="description" content="(.*)" \/> /i', $html, $contents);
        }

        if ($contents) {
            $data = $contents[1];

            $email_address_pattern = "([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})";
            if (preg_match('/' . $email_address_pattern . '/', $data, $list)) {
                $grabbed_emails = $list[0];
            }
        }//end main if

        return $grabbed_emails;
    }

    /**
     * <p style="text-align:justify">
     * Grab text between tags
     * </p>
     * @param string $html Html data
     * @param string $tag Tag name
     * @param string $filter Filter
     * @return array Returns text array
     */
    protected function get_text_between_tags($html = '', $tag = '', $filter = '') {
        $dom = new DOMDocument;
        // the array to return
        $texts = array();

        if ($html) {
            // loads the html into the object
            $dom->loadHTML($html);

            // discards white space
            $dom->preserveWhiteSpace = false;

            // the tag by its tag name
            $content = $dom->getElementsByTagname($tag);


            foreach ($content as $item) {
                $node_value = $item->nodeValue;

                // adds node value to the $texts array
                if (!empty($filter) && $node_value != $filter) {
                    $texts[] = $node_value;
                } else {
                    $texts[] = $node_value;
                }
            }
        }


        return $texts;
    }

    /**
     * <p style="text-align:justify">
     * Get attribute value by tag
     * </p>
     * @access protected
     * @param string $html Html data
     * @param string $tag Tag name
     * @param string $attribute_name Attribute name
     * @return array Returns attribute value array
     */
    protected function get_attribute_value_by_tag($html = '', $tag = '', $attribute_name = '') {
        $attribute_values = array();

        $dom = new DOMDocument;

        if ($html) {
            // loads the html into the object
            $dom->loadHTML($html);

            // grab all the doms on the page
            $xpath = new DOMXPath($dom);

            //finding the a tag
            $tags = $xpath->evaluate("/html/body//" . $tag);

            //Loop to display all the links
            for ($i = 0; $i < $tags->length; $i++) {
                if ($attribute_name == 'href') {
                    $href = $tags->item($i);
                    $url = $href->getAttribute('href');
                    if ($url != "#") {
                        $attribute_values[] = $url;
                    }
                }
            }
        }


        return $attribute_values;
    }

    /**
     * <p style="text-align:justify">
     * Grab email from homw page
     * </p>
     * @access protected
     * @param string $html Html data
     * @return mixed Return FALSE if not found otherwise an array contains email address
     */
    protected function grab_from_homepage($html = '') {
        $grabbed_emails = array();

        $hyperlinks = $this->get_text_between_tags($html, 'a', '#');

        if (count($hyperlinks)) {
            $email_address_pattern = "([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})";

            for ($i = 0; $i < count($hyperlinks); $i++) {
                if (preg_match('/' . $email_address_pattern . '/', $hyperlinks[$i])) {
                    $grabbed_emails[] = $hyperlinks[$i];
                }
            }
        }//end if

        if (count($grabbed_emails)) {
            return $grabbed_emails;
        } else {
            return false;
        }
    }

    /**
     * <p style="text-align:justify">
     * Grab email from contact us page
     * </p>
     * @access protected
     * @param string $html Html data
     * @param string $domain_url Domain url
     * @return Return FALSE if not found otherwise an array contains email address
     */
    protected function grab_from_contact_page($html = '', $domain_url = '') {
        $grabbed_emails = array();

        $contact_url = '';

        $href_values = $this->get_attribute_value_by_tag($html, 'a', 'href');

        if (count($href_values)) {
            for ($i = 0; $i < count($href_values); $i++) {
                if (preg_match('/contact/', $href_values[$i]) || preg_match('/Contact/', $href_values[$i]) || preg_match('/CONTACT/', $href_values[$i])) {
                    $contact_url = $href_values[$i];
                    break;
                }
            }

            if (!empty($contact_url)) {
                $contact_page_url = $domain_url . '/' . $contact_url;

                $contact_page_html = $this->scrape_request($contact_page_url);

                $hyperlinks = $this->get_text_between_tags($contact_page_html, 'a', '#');

                if (count($hyperlinks)) {
                    $email_address_pattern = "([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})";

                    for ($i = 0; $i < count($hyperlinks); $i++) {
                        if (preg_match('/' . $email_address_pattern . '/', $hyperlinks[$i])) {
                            $grabbed_emails[] = $hyperlinks[$i];
                        }
                    }
                }
            }
        }

        if (count($grabbed_emails)) {
            return $grabbed_emails;
        } else {
            return false;
        }
    }

}