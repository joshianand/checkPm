<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Model for ....
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Model
 * @category Model
 * @property CI_DB_active_record $db Database object
 * @property CI_Encrypt $encrypt Encryption object
 * @author Pronab Saha (pranab.su@gmail.com)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */
class Model_widget extends G_model{
    /**
     * Class constructor
     * @access public
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * <p style="text-align:justify">
     * Get city name
     * </p>
     * @access public
     * @author Pronab saha<pranab.su@gmail.com>
     * @param -
     * @return array Returns default widget
     */
	public function get_all()
	{
		$result = $this->db->get('g_widgets')->result();
        if ($result)
		{
			array_map(array($this, 'unserialize_fields'), $result);
		}
		return $result;
	}

	public function unserialize_fields($obj)
	{
		foreach (array('title', 'description') as $field)
		{
			if (isset($obj->{$field}))
			{

				$_field = @unserialize($obj->{$field});

				if ($_field === false)
				{
					isset($obj->slug) && $this->widgets->reload_widget($obj->slug);
				}

				else
				{
					$obj->{$field} = is_array($_field)
						? isset($_field['en'])
							? $_field['en'] : $_field['en']
						: $_field;
				}
			}
		}

		return $obj;
	}

	public function get_areas()
	{
		return $this->db->get('g_widget_areas')->result();
	}

	public function get_by_areas($slug = array())
	{
		if ( ! (is_array($slug) && $slug))
		{
			return array();
		}

		$this->db
			->select('wi.id, w.slug, wi.id as instance_id, wi.title as instance_title, w.title, wi.widget_area_id, wa.slug as widget_area_slug, wi.options')
			->from('g_widget_areas wa')
			->join('g_widget_instances wi', 'wa.id = wi.widget_area_id')
			->join('g_widgets w', 'wi.widget_id = w.id')
			->where_in('wa.slug', $slug)
			->order_by('wi.order');

		$result = $this->db->get()->result();

		if ($result)
		{
			array_map(array($this, 'unserialize_fields'), $result);
		}

		return $result;
	}

	public function get_widget_by($field, $id)
	{
		$result = $this->db->get_where('g_widgets', array($field => $id))->row();

		if ($result)
		{
			$this->unserialize_fields($result);
		}

		return $result;
	}

	public function get_area_by($field, $id)
	{
		return $this->db->get_where('g_widget_areas', array($field => $id))->row();
	}
    
    function add_instance($title, $widget_id, $widget_area_id, $input){
        $data = array(
            "title" => $title,
            "widget_id" => $widget_id,
            "widget_area_id" => $widget_area_id,
            "options" => $input,
            "created_on" => time()
        );
        
        $this->db->insert('g_widget_instances', $data);
        
        return array(
            "stutus" => "success"
        );
    }
    
}

?>
