<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for user
 * </p>
 * @package Core
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Model_users extends G_model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * <p style="text-align:justify">
     * Get user groups
     * </p>
     * @access public
     * @param type $limit Limit value
     * @param type $offset Offset value
     * @param type $sort_direction Sort direction
     * @param type $sort_field Sort field
     * @return array Returns user array
     */
    public function get_users($limit = 10, $offset = 0, $sort_direction = 'desc', $sort_field = 'user_id') {
        $data = array();

        $this->db->select('g_logins.id as user_id,
                           g_user_groups.group_name as group_name,
                           g_logins.user_first_name as first_name,
                           g_logins.user_last_name as last_name,
                           g_user_contacts.email as email,
                           g_user_contacts.phone as phone,
                           g_logins.is_active as active');
        $this->db->from('g_logins');

        $this->db->join('g_user_groups', 'g_logins.group_id = g_user_groups.id');
        $this->db->join('g_user_contacts', 'g_logins.id = g_user_contacts.login_id');

        $this->db->where('g_logins.group_id <>', 1);

        switch ($sort_field) {
            case 'group_name':
                $this->db->order_by('g_user_groups.group_name', $sort_direction);
                break;

            case 'first_name':
                $this->db->order_by('g_logins.user_first_name', $sort_direction);
                break;

            case 'last_name':
                $this->db->order_by('g_logins.user_last_name', $sort_direction);
                break;

            case 'email':
                $this->db->order_by('g_user_contacts.email', $sort_direction);
                break;

            case 'phone':
                $this->db->order_by('g_user_contacts.phone', $sort_direction);
                break;

            case 'active':
                $this->db->order_by('g_logins.is_active', $sort_direction);
                break;

            default:
                $this->db->order_by('g_logins.id', 'desc');
                break;
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['user_id'] = $this->encrypt->encode($row['user_id']);
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Count users
     * </p>
     * @access public
     * @return int Returns total users
     */
    public function count_users() {
        $this->db->join('g_user_groups', 'g_logins.group_id = g_user_groups.id');
        $this->db->join('g_user_contacts', 'g_logins.id = g_user_contacts.login_id');
        $this->db->where('g_logins.group_id <>', 1);
        return $this->db->count_all_results('g_logins');
    }

    /**
     * <p style="text-align:justify">
     * Get user details
     * </p>
     * @access public
     * @param int $user_id User id
     * @return array Returns user details array
     */
    public function get_user_details($user_id = 0) {
        $this->db->select('g_user_groups.group_name as group_name,
                           g_logins.login_name as login_name,
                           g_logins.login_pass as login_pass,
                           g_logins.user_first_name as first_name,
                           g_logins.user_last_name as last_name,
                           g_user_contacts.address as address,
                           g_user_contacts.city as city,
                           g_user_contacts.state as state,
                           g_user_contacts.zip as zip,
                           g_user_contacts.country as country,
                           g_user_contacts.email as email,
                           g_user_contacts.phone as phone,
                           g_user_contacts.mobile as mobile,
                           g_logins.is_active as active');
        $this->db->from('g_logins');

        $this->db->join('g_user_groups', 'g_logins.group_id = g_user_groups.id');
        $this->db->join('g_user_contacts', 'g_logins.id = g_user_contacts.login_id');

        $this->db->where('g_logins.ID', $user_id);

        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * <p style="text-align:justify">
     * Get user groups
     * </p>
     * @access public
     * @return array Returns user group details array
     */
    public function get_user_groups() {
        $data = array();
        $this->db->select('g_user_groups.id as group_id,
                           g_user_groups.group_name as group_name');
        $this->db->from('g_user_groups');
        $this->db->where('g_user_groups.is_active', 'yes');
        $this->db->where('g_user_groups.id <>', 1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['group_id'] = $this->encrypt->encode($row['group_id']);
                array_push($data, $row);
            }
        }

        return $data;
    }

    /**
     * <p style="text-align:justify">
     * Check validity of user id
     * </p>
     * @access public
     * @param int $user_id User id
     * @return boolean Returns TRUE if valid otherwise FALSE
     */
    public function is_valid_user_id($user_id = 0) {
        $this->db->where('g_logins.id', $user_id);
        $count = $this->db->count_all_results('g_logins');

        if ($count == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Check for duplicate user email
     * </p>
     * @access public
     * @param int $user_id User id
     * @param string $email User email
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function is_duplicate_user_contact($user_id = 0, $email = '') {
        if ($user_id != 0) {
            $this->db->where('g_user_contacts.login_id <>', $user_id);
        }
        $this->db->where('g_user_contacts.email', $email);
         
        $count = $this->db->count_all_results('g_user_contacts');

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Check for duplicate user login name
     * </p>
     * @access public
     * @param int $user_id User id
     * @param string $login_name User login name
     * @return boolean Returns TRUE if duplicate found otherwise FALSE
     */
    public function is_duplicate_login_name($user_id = 0, $login_name = '') {
        if ($user_id != 0) {
            $this->db->where('g_logins.id <>', $user_id);
        }
        $this->db->where('g_logins.login_name', $login_name);

        $count = $this->db->count_all_results('g_logins');

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * <p style="text-align:justify">
     * Update user
     * </p>
     * @access public
     * @param array $user_login User login details array
     * @param array $user_contact User contact details array
     * @param int $action Action must be either 1(for insert),-1(for delete) or 0(for update)
     * @param int $key User id
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function update_users($user_login = NULL, $user_contact = NULL, $action = 1, $key = 0) {
        if ($action == 1) {
            //insert
            $this->db->trans_start();

            $this->db->insert('g_logins', $user_login);
            $user_contact['login_id']= $this->db->insert_id();

            $this->db->insert('g_user_contacts', $user_contact);

            $this->db->trans_complete();

            return $this->db->trans_status();
        } else if ($action == 0) {
            //update
            $this->db->trans_start();

            $this->db->set('g_logins.group_id', $user_login['group_id']);
            $this->db->set('g_logins.user_first_name', $user_login['user_first_name']);
            $this->db->set('g_logins.user_last_name', $user_login['user_last_name']);
            $this->db->set('g_logins.is_active', $user_login['is_active']);
            
            $this->db->where('g_logins.id', $key);
            $this->db->update('g_logins');

            $this->db->set('g_user_contacts.address', $user_contact['address']);
            $this->db->set('g_user_contacts.city', $user_contact['city']);
            $this->db->set('g_user_contacts.state', $user_contact['state']);
            $this->db->set('g_user_contacts.zip', $user_contact['zip']);
            $this->db->set('g_user_contacts.country', $user_contact['country']);
            $this->db->set('g_user_contacts.email', $user_contact['email']);
            $this->db->set('g_user_contacts.phone', $user_contact['phone']);
            $this->db->set('g_user_contacts.mobile', $user_contact['mobile']);
            $this->db->where('g_user_contacts.login_id', $key);
            $this->db->update('g_user_contacts');

            $this->db->trans_complete();
            return $this->db->trans_status();
        } else if ($action == -1) {
            //delete
            $this->db->trans_start();

            $this->db->where('g_user_contacts.login_id', $key);
            $this->db->delete('g_user_contacts');

            $this->db->where('g_logins.id', $key);
            $this->db->delete('g_logins');

            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }

    /**
     * <p style="text-align:justify">
     * Reset user credential
     * </p>
     * @access public
     * @param int $user_id User id
     * @param string $new_pass New password
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    public function reset_credential($user_id = 0, $new_pass='') {
        $this->db->trans_start();

        $this->db->set('g_logins.login_pass', $new_pass);
        $this->db->where('g_logins.id', $user_id);
        $this->db->update('g_logins');

        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

}

