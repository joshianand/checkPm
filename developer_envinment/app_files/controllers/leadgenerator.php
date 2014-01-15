<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for yellow page search
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
class Leadgenerator extends G_Controller {

    /**
     * Class constructor
     * @access public
     */
    public function __construct() {
        parent::__construct(get_class());

        $this->load->model('module_models/lead_generator/Model_yp', 'yp_model');
        $this->load->library(array(
            'excel',
            'module_libraries/lead_generator/yellowapi'
        ));
        $this->load->helper('modules/lead_generator/yp');
        $this->load->helper('modules/search_domain/csv');
    }

    /**
     * @access public
     */
    public function index() {
        $page_data['token'] = $this->token;
        $page_data['cities'] = $this->yp_model->getCities();
        $this->construct_ui();
        $this->template->write_view('content', 'module_views/lead_generator/index', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Get search data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function GetSearchList() {
        if (IS_AJAX) {
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'desc' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'search_id' : $sort_data[0]['field'];

            $data['search_data'] = $this->yp_model->GetSearchList($limit, $offset, $sort_direction, $sort_field);
            $data['count'] = $this->yp_model->CountSearchList();

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Get business details data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function GetBusinessDetails() {
        if (IS_AJAX) {
            $search_id = $this->input->get('search_id', TRUE);
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'desc' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'business_id' : $sort_data[0]['field'];

            $data['business_details'] = $this->yp_model->GetBusinessDetails($search_id, $limit, $offset, $sort_direction, $sort_field);
            $data['count'] = $this->yp_model->CountBusinessDetails($search_id);

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing saving searched data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function SaveYellowPageSearch() {
//        $this->CronYellowPagesSearch(time());exit;
        if ($this->input->is_ajax_request()) {
            set_time_limit(0);
            ini_set('memory_limit', '1G');

            $search_list = array();

            $output_result = array();
            $output_result['flag'] = 1;
            $output_result['message'] = "Scraping done. Please click left most triangle of row to expand scrape result";
            
            $city_selection = array();
            
            if($this->input->post('citySelection', TRUE) && !$this->input->post('selectAllCities', TRUE))
                $city_selection = $this->input->post('citySelection', TRUE);
            else
                $city_selection = $this->yp_model->GetAllCityIds();
            
            if(!empty($city_selection)) {
                $search_text = $this->input->post('searchText', TRUE);

                if($search_text != "") {
                    // seperate search text
                    $search_text_array = explode(",", $search_text);

                    $search_combinations = array();

                    foreach($city_selection as $city) {
                        foreach($search_text_array as $serach_text) {
                            // check whether combination is already present
                            if (!$this->yp_model->IsDuplicateWhatWhere($city, $serach_text)) {
                                $search_combinations[] = array(
                                    "city_id" => $city,
                                    "search_string" => $serach_text,
                                    "search_status" => 0,
                                    "added_on" => time()
                                );
                            }
                        }
                    }

                    if(!empty($search_combinations)) {
                        if (!$this->yp_model->AddSerachCombinations($search_combinations)) {
                            $output_result['flag'] = 0;
                            $output_result['message'] = "Some error has occurred.";
                        }
                    }

//                            $city_name = $this->yp_model->GetCityName($city_selection);
//
//                            if ($this->yp_model->IsDuplicateWhatWhere($city_selection, $search_text)) {
//                                $output_result['flag'] = 0;
//                                $output_result['message'] = "Duplicate city and search text found. Please choose another combination";
////                            } else {
//                                $data = array(
//                                    'city_id' => $city_selection,
//                                    'city_name' => $city_name,
//                                    'search_text' => $search_text,
//                                    'total_business_found' => 0,
//                                    'search_status' => 'pending',
//                                    'modified_date' => strtotime('now')
//                                );
//
//                                array_push($search_list, $data);
//                                $this->BasicBusinessSearch($search_list);
//                            }
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = "Please enter search text.";
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = "Please select any city.";
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing scrape emails
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function ScrapeEmails() {
        if (IS_AJAX) {
            set_time_limit(0);
            ini_set('memory_limit', '1G');
            libxml_use_internal_errors(true);

            $output_result = array();
            $output_result['flag'] = 1;

            $search_id = $this->input->post('search_id', TRUE);
            $business_sites = $this->yp_model->GetBusinessWebsites($search_id);

            if (count($business_sites) > 0) {
                $total_scraped = 0;

                foreach ($business_sites as $site) {
                    $domain = $site['company_url'];

                    $scrapped_emails = $this->yellowapi->scrape_emails($domain);
                    if (is_array($scrapped_emails)) {
                        if (count($scrapped_emails) > 1) {
                            $contact_emails = join(',', $scrapped_emails);
                        } else {
                            $contact_emails = $scrapped_emails[0];
                        }

                        $this->yp_model->UpdateVerifiedEmail($site['business_id'], $contact_emails);
                        $total_scraped += count($scrapped_emails);
                    }
                }

                $this->yp_model->UpdateScrapeStatus($search_id);
                $output_result['message'] = "Total $total_scraped emails scraped successfully";
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = 'No website found to generate email address';
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing site analyze
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function AnalyzeSite() {
        if (IS_AJAX) {
            set_time_limit(0);
            ini_set('memory_limit', '1G');
            libxml_use_internal_errors(true);

            $output_result = array();
            $output_result['flag'] = 1;

            $search_id = $this->input->post('search_id', TRUE);
            $business_sites = $this->yp_model->GetBusinessWebsites($search_id, FALSE);

            if (count($business_sites) > 0) {
                $total_analyzed = 0;

                foreach ($business_sites as $site) {
                    sleep(rand(3, 5));
                    $domain = $site['company_url'];

                    $analyzed_data = $this->yellowapi->analyze_site($domain);
                    $this->yp_model->UpdateSiteAnalyze($site['business_id'], $analyzed_data);
                    $total_analyzed++;
                }

                $this->yp_model->UpdateAnalyzeStatus($search_id);
                $output_result['message'] = "Total $total_analyzed websites analyzed successfully";
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = 'No website found to be analyze';
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing removing data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function DeleteYellowSearch() {
        if (IS_AJAX) {
            $search_id = $this->input->post('search_id', TRUE);
            if ($this->yp_model->UpdateSearchData(NULL, -1, $search_id) === TRUE) {
                echo "1*Search query deleted successfully";
            } else {
                echo "0*An error occur while deleting.";
            }
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing downloading data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function DownloadSearchResults() {
        $search_id = $this->input->get('search_id', TRUE);
        $format = $this->input->get('format', TRUE);

        $column_names = array();
        $column_head = array();

        $selection_string = "";

        $name_selection = $this->input->get('name', TRUE) == 'on' ? TRUE : FALSE;
        $category_selection = $this->input->get('cat', TRUE) == 'on' ? TRUE : FALSE;
        $address_selection = $this->input->get('add', TRUE) == 'on' ? TRUE : FALSE;
        $city_selection = $this->input->get('city', TRUE) == 'on' ? TRUE : FALSE;
        $state_selection = $this->input->get('state', TRUE) == 'on' ? TRUE : FALSE;
        $zip_selection = $this->input->get('zip', TRUE) == 'on' ? TRUE : FALSE;
        $phn_selection = $this->input->get('phn', TRUE) == 'on' ? TRUE : FALSE;
        $web_selection = $this->input->get('web', TRUE) == 'on' ? TRUE : FALSE;
        $mail_selection = $this->input->get('mail', TRUE) == 'on' ? TRUE : FALSE;
        $rate_selection = $this->input->get('rate', TRUE) == 'on' ? TRUE : FALSE;
        $domain_owner_selection = $this->input->get('domainOwner', TRUE) == 'on' ? TRUE : FALSE;
        $domain_age_selection = $this->input->get('domainAge', TRUE) == 'on' ? TRUE : FALSE;
        $seo_score_selection = $this->input->get('seoScore', TRUE) == 'on' ? TRUE : FALSE;
        $seo_tips_selection = $this->input->get('seoTips', TRUE) == 'on' ? TRUE : FALSE;
        
        $web_only = $this->input->get('webOption', TRUE) == 'on' ? TRUE : FALSE;
        $mail_only = $this->input->get('emailOption', TRUE) == 'on' ? TRUE : FALSE;

        $filename = $this->yp_model->GetDownloadFileName($search_id);
        
        if ($name_selection) {
            array_push($column_head, "business_name");
            array_push($column_names, "Business name");
            $selection_string .= "yellow_page_business_details.business_name,";
        }

        if ($category_selection) {
            array_push($column_head, "business_category");
            array_push($column_names, "Business category");
            $selection_string .= "yellow_page_business_details.business_category,";
        }

        if ($address_selection) {
            array_push($column_head, "street_address");
            array_push($column_names, "Address");
            $selection_string .= "yellow_page_business_details.street_address,";
        }

        if ($city_selection) {
            array_push($column_head, "city");
            array_push($column_names, "City");
            $selection_string .= "yellow_page_business_details.city,";
        }

        if ($state_selection) {
            array_push($column_head, "state");
            array_push($column_names, "State");
            $selection_string .= "yellow_page_business_details.state,";
        }

        if ($zip_selection) {
            array_push($column_head, "post_code");
            array_push($column_names, "Zip");
            $selection_string .= "yellow_page_business_details.post_code,";
        }

        if ($phn_selection) {
            array_push($column_head, "phone");
            array_push($column_names, "Phone");
            $selection_string .= "yellow_page_business_details.phone,";
        }

        if ($web_selection) {
            array_push($column_head, "company_url");
            array_push($column_names, "Web url");
            $selection_string .= "yellow_page_business_details.company_url,";
        }

        if ($mail_selection) {
            array_push($column_head, "emails");
            array_push($column_names, "Emails");
            $selection_string .= "yellow_page_business_details.emails,";
        }

        if ($rate_selection) {
            array_push($column_head, "average_rating");
            array_push($column_names, "Rating");
            $selection_string .= "yellow_page_business_details.average_rating,";
        }

        if ($domain_owner_selection) {
            array_push($column_head, "domain_owner");
            array_push($column_names, "Domain owner name");
            $selection_string .= "yellow_page_business_details.domain_owner,";
        }
        
        if ($domain_age_selection) {
            array_push($column_head, "domain_age");
            array_push($column_names, "Domain age");
            $selection_string .= "yellow_page_business_details.domain_age,";
        }
        
        if ($seo_score_selection) {
            array_push($column_head, "seo_score");
            array_push($column_names, "Seo score");
            $selection_string .= "yellow_page_business_details.seo_score,";
        }
        
        if ($seo_tips_selection) {
            array_push($column_head, "seo_tips");
            array_push($column_names, "Seo tips");
            $selection_string .= "yellow_page_business_details.seo_tips";
        }
        
        $businesses = $this->yp_model->DownloadBusienssDetails($search_id, $selection_string, $web_only, $mail_only);
        if (count($businesses) > 0) {
            if ($format == 'csv') {
                array_to_csv($businesses, $filename . ".csv");
            } else if ($format == 'xls') {
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Business listings');

                $letter = "A";
                foreach ($column_names as $header) {
                    $this->excel->getActiveSheet()->setCellValue("$letter" . "1", $header)->getStyle("$letter" . "1")->getFont()->setBold(true);
                    $letter++;
                }

                $count = 2;
                foreach ($businesses as $business) {
                    $letter = "A";
                    $i = 0;

                    foreach ($column_names as $header) {
                        $this->excel->getActiveSheet()->setCellValue($letter . $count, element($column_head[$i], $business));
                        $letter++;
                        $i++;
                    }

                    if ($count % 2 > 0) {
                        $cells = "A$count:P$count";
                        $color = "d6d6d6";

                        $this->excel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(
                                array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'startcolor' => array('rgb' => $color)
                        ));
                    }

                    $count++;
                }

                $letter = "A";
                foreach ($column_names as $header) {
                    $this->excel->getActiveSheet()->getColumnDimension("$letter")->setAutoSize(true);
                    $letter++;
                }

                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save('php://output');
            } else {
                show_error('Unkown file format given');
            }
        } else {
            show_error('Sorry no data found');
        }
    }

    /**
     * <p style="text-align:justify">
     * Search business list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    protected function BasicBusinessSearch($search_list = array()) {
        foreach ($search_list as $search) {
            $business_details = array();

            $what = $search['search_text'];
            $where = $search['city_name'];

            $total_business_found = 0;
            $page_count = 2;

            $businesses = $this->yellowapi->scrap_business($what, $where, 1);
            
            $listings = $businesses['details'];
            $pagination_string = $businesses['pagination_text'];
            
            if (count($listings) > 0) {
                $search_id = 0;
                $search_data = $this->yp_model->GetLastBusinessSearchId($search);
                
                if(!empty($search_data))
                    $search_id = $search_data["search_id"];
                else
                    $search_id = $this->yp_model->InsertSearchData($search);
                
                $this->yp_model->UpdateSearchRepeatStatus('business_search_status', $search_id);exit;

                foreach ($listings as $list) {
                    $data = array(
                        'search_id' => $search_id,
                        'business_name' => $list['business_name'],
                        'business_category' => $list['business_category'],
                        'street_address' => $list['street_address'],
                        'city' => $list['city'],
                        'state' => $list['state'],
                        'post_code' => $list['post_code'],
                        'phone' => $list['phone'],
                        'company_url' => $list['company_url'],
                        'emails' => '',
                        'average_rating' => $list['average_rating']
                    );

                    array_push($business_details, $data);
                }
            }

            if ($pagination_string) {
                $pagination_count = extract_pagination_count($pagination_string);

                $start_count = (int) $pagination_count[0];
                $end_count = (int) $pagination_count[1];
                $total_count = (int) $pagination_count[2];

                $total_business_found += ($end_count - $start_count) + 1;
            } else {
                $end_count = $total_business_found = $total_count = 0;
            }

            while ($end_count < $total_count) {
                sleep(rand(3, 5));

                $businesses = $this->yellowapi->scrap_business($what, $where, $page_count);

                $listings = $businesses['details'];
                $pagination_string = $businesses['pagination_text'];

                if (count($listings) > 0) {
                    foreach ($listings as $list) {
                        $data = array(
                            'search_id' => $search_id,
                            'business_name' => $list['business_name'],
                            'business_category' => $list['business_category'],
                            'street_address' => $list['street_address'],
                            'city' => $list['city'],
                            'state' => $list['state'],
                            'post_code' => $list['post_code'],
                            'phone' => $list['phone'],
                            'company_url' => $list['company_url'],
                            'emails' => '',
                            'average_rating' => $list['average_rating']
                        );

                        array_push($business_details, $data);
                    }

                    $pagination_count = extract_pagination_count($pagination_string);
                    $start_count = $pagination_count[0];
                    $end_count = $pagination_count[1];
                    $total_count = $pagination_count[2];
                    $total_business_found += ($end_count - $start_count) + 1;
                } else {
                    break;
                }
                $page_count++;
            }

            $update_data = array(
                'total_business_found' => $total_business_found,
                'search_status' => 'completed'
            );
            
            $this->yp_model->UpdateSearchData($update_data, 0, $search_id);
            $this->yp_model->InsertSearchDetailsData($business_details);
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Search business list
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function CronYellowPagesSearch($time = 0) {
        if($time == 0) {
            $time = time();
        }
        
        set_time_limit(0);
        ini_set('memory_limit', '1G');
        
        $search_list = array();
        $data = $this->yp_model->GetNextSearchCombination($time);
        
        if(!empty($data)) {
            if($data["process"] == "email_scraped") {
                $this->yp_model->UpdateSearchRepeatStatus('email_scraped_status', $search_id);
                $this->CronScrapeEmails($data["search_data"]["search_id"]);

                $this->yp_model->UpdateSearchRepeatStatus('site_analyzed_status', $search_id);
                $this->CronAnalyzeSite($data["search_data"]["search_id"]);
                
            } else if ($data["process"] == "site_analyzed") {
                $this->yp_model->UpdateSearchRepeatStatus('site_analyzed_status', $search_id);
                $this->CronAnalyzeSite($data["search_data"]["search_id"]);
            } else {
                $search_data = $data["search_data"];
                $city_name = $this->yp_model->GetCityName($search_data["city_id"]);
                
                $list_data = array();
                
                if(!isset($search_data["search_id"])) {
                    $list_data = array(
                        'city_id' => $search_data["city_id"],
                        'city_name' => $city_name,
                        'search_text' => $search_data["search_string"],
                        'total_business_found' => 0,
                        'search_status' => 'pending',
                        'modified_date' => strtotime('now')
                    );
                } else {
                    $list_data = array(
                        'city_id' => $search_data["city_id"],
                        'city_name' => $city_name,
                        'search_text' => $search_data["search_text"],
                        'total_business_found' => 0,
                        'search_status' => 'pending',
                        'modified_date' => strtotime('now')
                    );
                }
                
                array_push($search_list, $list_data);
                try{
                    $this->BasicBusinessSearch($search_list);
                    $this->yp_model->UpdateSearchCombinationStatus($search_data["id"], 1);
                    $data["search_data"] = $this->yp_model->GetLastBusinessSearchId($list_data);
                    
                    $this->yp_model->UpdateSearchRepeatStatus('email_scraped_status', $search_id);
                    $this->CronScrapeEmails($data["search_data"]["search_id"]);
                    
                    $this->yp_model->UpdateSearchRepeatStatus('site_analyzed_status', $search_id);
                    $this->CronAnalyzeSite($data["search_data"]["search_id"]);
                }
                catch(Exception $e){
                    $this->yp_model->UpdateSearchCombinationStatus($search_data["id"], 0);
                }
            }
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Processing scrape emails via cron job
     * </p>
     * @access protected
     * @author Pronab saha<pranab.su@gmail.com>
     */
    protected function CronScrapeEmails($search_id = 0) {
        if ($search_id != 0) {
            set_time_limit(0);
            ini_set('memory_limit', '1G');
            libxml_use_internal_errors(true);

            $output_result = array();
            $output_result['flag'] = 1;
            
            $business_sites = $this->yp_model->GetBusinessWebsites($search_id);

            if (count($business_sites) > 0) {
                $total_scraped = 0;

                foreach ($business_sites as $site) {
                    $domain = $site['company_url'];

                    $scrapped_emails = $this->yellowapi->scrape_emails($domain);
                    if (is_array($scrapped_emails)) {
                        if (count($scrapped_emails) > 1) {
                            $contact_emails = join(',', $scrapped_emails);
                        } else {
                            $contact_emails = $scrapped_emails[0];
                        }

                        $this->yp_model->UpdateVerifiedEmail($site['business_id'], $contact_emails);
                        $total_scraped += count($scrapped_emails);
                    }
                }

                $this->yp_model->UpdateScrapeStatus($search_id);
            } 
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Processing site analyze via cron job
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    protected function CronAnalyzeSite($search_id = 0) {
        if ($search_id != 0) {
            set_time_limit(0);
            ini_set('memory_limit', '1G');
            libxml_use_internal_errors(true);

            $output_result = array();
            $output_result['flag'] = 1;
            
            $business_sites = $this->yp_model->GetBusinessWebsites($search_id, FALSE);
            if (count($business_sites) > 0) {
                $total_analyzed = 0;

                foreach ($business_sites as $site) {
                    sleep(rand(3, 5));
                    $domain = $site['company_url'];

                    $analyzed_data = $this->yellowapi->analyze_site($domain);
                    $this->yp_model->UpdateSiteAnalyze($site['business_id'], $analyzed_data);
                    $total_analyzed++;
                }

                $this->yp_model->UpdateAnalyzeStatus($search_id);
            }
        }
    }
    
    /**
     * <p style="text-align:justify">
     * Get search data
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     */
    public function GetSearchCombinationList() {
        if (IS_AJAX) {
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'ASC' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'search_id' : $sort_data[0]['field'];

            $data['search_data'] = $this->yp_model->GetSearchCombinationList($limit, $offset, $sort_direction, $sort_field);
            $data['count'] = $this->yp_model->CountSearchCombinationList();

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }
    
    public function DeleteSearchCombination() {
        if (IS_AJAX) {
            $search_id = $this->input->post('search_id', TRUE);
            if ($this->yp_model->DeleteSearchCombination($search_id) === TRUE) {
                echo "1*Search query deleted successfully";
            } else {
                echo "0*An error occur while deleting.";
            }
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

}

/* End of file  ypsearch.php */
/* Location: ./application/controllers/ypsearch.php */
