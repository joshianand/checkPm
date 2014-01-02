<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for user profile
 * </p>
 * @package Core
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Model_profile extends G_model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * <p style="text-align:justify">
     * Get personal information
     * </p>
     * @access public
     * @param int $user_id User id
     * @return array Returns user personal data array
     */
    public function get_personal_data($user_id=0){
        $this->db->select('g_user_contacts.address as address,
                           g_user_contacts.city as city,
                           g_user_contacts.state as state,
                           g_user_contacts.zip as zip,
                           g_user_contacts.country as country,
                           g_user_contacts.phone as phone,
                           g_user_contacts.mobile as mobile,
                           g_user_contacts.email as email');
        
        $this->db->from('g_user_contacts');
        
        $this->db->where('g_user_contacts.login_id',$user_id);
        $this->db->where('g_user_contacts.is_active','yes');
        
        $query = $this->db->get();
        return $query->row_array();
    }
    
    /**
     * <p style="text-align:justify">
     * Check validation of current password
     * </p>
     * @access public
     * @param int $user_id User id
     * @param string $password Password
     * @return boolean Returns TRUE if current password is valid otherwise FALSE
     */
    public function is_valid_current_password($user_id = 0, $password = ''){
        $this->db->select('g_logins.login_pass as login_pass');
        $this->db->from('g_logins');
        $this->db->where('g_logins.id',$user_id);
        
        $query = $this->db->get();
        $result = $query->row_array();
        
        if(count($result) > 0){
            list($stored_pw, $stored_salt) = explode('$', element('login_pass', $result));
            if ($stored_pw == sha1($password . $stored_salt)){
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Update personal data
     * </p>
     * @access public
     * @param int $key Login id
     * @param array $user User login data array
     * @param array $user_contact User contact data array
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function update_personal_data($key = 0, $user=array(), $user_contact=array()) {
        $this->db->trans_start();
        
        $this->db->set('g_logins.user_first_name',$user['user_first_name']);
        $this->db->set('g_logins.user_last_name',$user['user_last_name']);

        $this->db->where('g_logins.id',$key);
        $this->db->update('g_logins');
        
        $this->db->set('g_user_contacts.address',$user_contact['address']);
        $this->db->set('g_user_contacts.city',$user_contact['city']);
        $this->db->set('g_user_contacts.state',$user_contact['state']);
        $this->db->set('g_user_contacts.zip',$user_contact['zip']);
        $this->db->set('g_user_contacts.country',$user_contact['country']);
        $this->db->set('g_user_contacts.email',$user_contact['email']);
        $this->db->set('g_user_contacts.phone',$user_contact['phone']);
        $this->db->set('g_user_contacts.mobile',$user_contact['mobile']);
        
        $this->db->where('g_user_contacts.login_id',$key);
        $this->db->update('g_user_contacts');
        
        $this->db->trans_complete();

        return $this->db->trans_status();
    }
    
    /**
     * <p style="text-align:justify">
     * Update credentials
     * </p>
     * @access public
     * @param int $user_id User id
     * @param string $login_name Login name
     * @param string $login_pass Login password
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function update_credentials($user_id=0, $login_name='', $login_pass=''){
        $this->db->trans_start();
        
        $this->db->set('g_logins.login_name',$login_name);
        if($login_pass!=''){
            $this->db->set('g_logins.login_pass',$login_pass);
        }

        $this->db->where('g_logins.id',$user_id);
        $this->db->update('g_logins');
        
        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}

