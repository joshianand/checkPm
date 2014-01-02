<?php

class Widgets {

    private $_widget = null;
    private $_rendered_areas = array();
    private $_widget_locations = array();
    private $CI = null;

    public function __construct() {
        $CI = &get_instance();
        $CI->load->model('module_models/project_management/Model_widget', 'widget_model');
        
        $widgets = glob(FCPATH."app_files/views/module_views/project_management/widgets/*", GLOB_ONLYDIR);
        foreach ($widgets as $widget_path)
        {
            $slug = basename($widget_path);

            // Set this so we know where it is later
            $this->_widget_locations[$slug] = $widget_path . '/';
        }
    }

    public function list_areas() {
        $CI = &get_instance();
        return $CI->widget_model->get_areas();
    }

	public function list_area_instances($slug)
	{
        $CI = &get_instance();
		return is_array($slug) ? $CI->widget_model->get_by_areas($slug) : $CI->widget_model->get_by_area($slug);
	}

	public function get_area($id)
	{
		return is_numeric($id) ? $CI->widget_model->get_area_by('id', $id) : $CI->widget_model->get_area_by('slug', $id);
	}
    
    public function get_widget($id)
	{
        $CI = &get_instance();
		return is_numeric($id) ? $CI->widget_model->get_widget_by('id', $id) : $CI->widget_model->get_widget_by('slug', $id);
	}
    
    public function render_backend($name, $saved_data = array())
	{
        $CI = &get_instance();
		$this->_spawn_widget($name);
        
		// No fields, no backend, no rendering
		if (empty($this->_widget->fields))
		{
			return '';
		}

		$options = array();
		$_arrays = array();

		foreach ($this->_widget->fields as $field)
		{
			$field_name = &$field['field'];
			if (($pos = strpos($field_name, '[')) !== false)
			{
				$key = substr($field_name, 0, $pos);

				if ( ! in_array($key, $_arrays))
				{
					$options[$key] = $this->input->post($key);
					$_arrays[] = $key;
				}
			}
			$options[$field_name] = isset($saved_data[$field_name]) ? $saved_data[$field_name] : '';
			unset($saved_data[$field_name]);
		}

		// Any extra data? Merge it in, but options wins!
		if ( ! empty($saved_data))
		{
			$options = array_merge($saved_data, $options);
		}
        
		// Check for default data if there is any
		$data = method_exists($this->_widget, 'form') ? call_user_func(array(&$this->_widget, 'form'), $options) : array();

		// Options we'rent changed, lets use the defaults
		isset($data['options']) OR $data['options'] = $options;
        
        //$this->template->write_view('content', 'module_views/project_management/widgets/'.$name.'/form', $page_data);
        return $CI->load->view('module_views/project_management/widgets/'.$name.'/views/form', $data);
		//return true; //$this->load_view('form', $data);
	}
    
    private function _spawn_widget($name)
	{
		$widget_path = $this->_widget_locations[$name];
		$widget_file = $widget_path . $name . ".php";
        
		if (file_exists($widget_file))
		{
			require_once $widget_file;
			$class_name = 'Widget_' . ucfirst($name);

			$this->_widget = new $class_name;
			$this->_widget->path = $widget_path;

			return;
		}

		$this->_widget = null;
	}
}

?>
