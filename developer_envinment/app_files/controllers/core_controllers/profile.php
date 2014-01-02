<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for user profile
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Profile extends G_controller {

    public function __construct() {
        parent::__construct(get_class());

        $this->load->model('core_models/Model_profile', 'profile');
        $this->load->model('core_models/system_management/Model_users', 'users');
    }

    /**
     * <p style="text-align:justify">
     * Display profile page
     * </p>
     * @access public
     */
    public function index() {
        $page_data['token'] = $this->token;

        $this->construct_ui();
        $page_data['personal_info'] = $this->profile->get_personal_data(element('user_id', $this->user_data));
        
        $this->template->write_view('content', 'core_views/profile', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing user personal data update
     * </p>
     * @access public
     */
    public function UpdatePersonalData() {
        if (IS_AJAX) {
            $output_result = array();

            $user_id = element('user_id', $this->user_data);

            $user = array(
                'user_first_name' => $this->input->post('FirstName', TRUE),
                'user_last_name' => $this->input->post('LastName', TRUE)
            );

            $user_contact = array(
                'address' => $this->input->post('Address', TRUE),
                'city' => $this->input->post('City', TRUE),
                'state' => $this->input->post('State', TRUE),
                'zip' => $this->input->post('Zip', TRUE),
                'country' => $this->input->post('Country', TRUE),
                'email' => $this->input->post('Email', TRUE),
                'phone' => $this->input->post('Phone', TRUE),
                'mobile' => $this->input->post('Mobile', TRUE)
            );

            $validation_result = $this->validate_personal_data($user_id, $user, $user_contact);
            if ($validation_result == '') {
                $update_result = $this->profile->update_personal_data($user_id, $user, $user_contact);
                if ($update_result === TRUE) {
                    $this->user_data['user_first_name'] = $user['user_first_name'];
                    $this->user_data['user_last_name'] = $user['user_last_name'];

                    $this->session->set_userdata('login_data', $this->user_data);

                    $output_result['flag'] = 1;
                    $output_result['message'] = 'Personal information updated successfully.';
                } else {
                    $data['flag'] = 0;
                    $data['message'] = 'An error occured while updating personam information.';
                }
            } else {
                $output_result['flag'] = 0;
                $output_result['message'] = $validation_result;
            }

            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing user credential update
     * </p>
     * @access public
     */
    public function UpdateCredential() {
        if (IS_AJAX) {
            $user_id = element('user_id', $this->user_data);

            $login_name = $this->input->post('LoginName', TRUE);
            $old_pass = $this->input->post('OldPassword', TRUE);
            $new_pass = $this->input->post('NewPassword', TRUE);
            $re_pass = $this->input->post('RetypePassword', TRUE);

            $validation_result = $this->validate_credentials($user_id, $login_name, $old_pass, $new_pass, $re_pass);

            if ($validation_result == '') {
                $new_pass = generate_password($new_pass);
                $result = $this->profile->update_credentials($user_id, $login_name, $new_pass);
                if ($result === TRUE) {
                    $this->user_data['login_name'] = $login_name;
                    $this->session->set_userdata('login_data', $this->user_data);

                    $data['flag'] = 1;
                    $data['message'] = 'Personal credentials updated successfully.';
                    echo json_encode($data);
                } else {
                    $data['flag'] = 0;
                    $data['message'] = 'An error occured while updating personal credentials. Contact with administrator.';
                    echo json_encode($data);
                }
            } else {
                $data['flag'] = 0;
                $data['result'] = $validation_result;
                echo json_encode($data);
            }
        } else {
            show_error('Sorry, direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Validate user personal data
     * </p>
     * @access protected
     * @param int $user_id User id
     * @param array $user User login details
     * @param array $user_contact User contact details
     * @return string Returns empty string if validation succeed otherwise validation message 
     */
    protected function validate_personal_data($user_id = 0, $user = array(), $user_contact = array()) {
        if (trim($user['user_first_name']) == FALSE && trim($user['user_last_name']) == FALSE) {
            return 'Please provide user name.';
        } else if (trim($user_contact['address']) == FALSE) {
            return 'Please provide address.';
        } else if (trim($user_contact['phone']) == FALSE && trim($user_contact['mobile']) == FALSE) {
            return 'Please provide your contact no.';
        } else if (!filter_var($user_contact['email'], FILTER_VALIDATE_EMAIL)) {
            return 'Please provide valid email address.';
        } else if ($this->users->is_duplicate_user_contact($user_id, $user_contact['email']) == TRUE) {
            return 'Duplicate email address found. Please provide another email address.';
        } else {
            return '';
        }
    }

    /**
     * <p style="text-align:justify">
     * Validate user credential data
     * </p>
     * @access protected
     * @param int $user_id User id
     * @param string $login_name Login name
     * @param string $old_pass Old password
     * @param string $new_pass New password
     * @param string $re_pass Re typed password
     * @return string Returns empty string if validation succeed otherwise validation message 
     */
    protected function validate_credentials($user_id = 0, $login_name = '', $old_pass = '', $new_pass = '', $re_pass = '') {
        if ($login_name == '') {
            return 'Please provide the login name.';
        } else if (trim($old_pass) == TRUE) {
            if ($this->profile->is_valid_current_password($user_id, $old_pass) == FALSE) {
                return 'Given current password did not matched.';
            } else if (trim($new_pass) == FALSE) {
                return 'Please provide new password.';
            } else if ($new_pass != $re_pass) {
                return 'Both password did not matched.';
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

}

