<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for widget generator
 * </p>
 * @package Computer_Programming_Services
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author YOUR NAME (YOUR EMAIL ADDRESS)
 * @license http://www.softwaredeveloperpro.com Software developer pro
 * @copyright (c) 2012, Software developer pro
 * @link http://www.softwaredeveloperpro.com
 */
class Widget extends G_controller {
    public function __construct(){
        parent::__construct(get_class());
        $this->load->library('module_libraries/project_management/Widgets');
        $this->load->model('module_models/project_management/Model_widget','widget_model');
    }
    
    /**
	 * Index method, lists all active widgets
	 * 
	 * @return void
	 */
    public function index(){
        $page_data = array();

		// Get Widgets
		$this->db->where('enabled', 1)->order_by('order');
		$page_data['available_widgets'] = $this->widget_model->get_all();

		// Get Areas
		$this->db->order_by('`title`');

		$page_data['widget_areas'] = $this->widgets->list_areas();
        // Go through all widget areas
		$slugs = array();

		foreach ($page_data['widget_areas'] as $key => $area)
		{
			$slugs[$area->id] = $area->slug;

			$page_data['widget_areas'][$key]->widgets = array();
		}

		if ($page_data['widget_areas'])
		{
			$page_data['widget_areas'] = array_combine(array_keys($slugs), $page_data['widget_areas']);
		}

		$instances = $this->widgets->list_area_instances($slugs);

		foreach ($instances as $instance)
		{
			$page_data['widget_areas'][$instance->widget_area_id]->widgets[$instance->id] = $instance;
		}
        
        $page_data['token'] = $this->token;
        $this->construct_ui();
        $this->template->write_view('content', 'module_views/project_management/index', $page_data);
        $this->template->render();
    }
    
    public function instance_create($slug = '')
	{
		if ( ! ($slug && $widget = $this->widgets->get_widget($slug)))
		{
			// @todo: set error
			return false;
		}
        
		$data = array();

		if ($input = $this->input->post())
		{print_r($input);exit;
			$title 			= $input['title'];
			$widget_id 		= $input['widget_id'];
			$widget_area_id = isset($input['widget_area_id'])? $input['widget_area_id'] : 1;

			//unset($input['title'], $input['widget_id'], $input['widget_area_id']);

			$result = $this->widget_model->add_instance($title, $widget_id, $widget_area_id, $input);

			if ($result['status'] === 'success')
			{				
				$status		= 'success';

				$area = $this->widgets->get_area($widget_area_id);
			}
			else
			{
				$status		= 'error';
			}

			if ($status === 'success')
			{
				redirect('widget');
				return;
			}

			$data['messages'][$status] = "";
		}

		$data['widget']	= $widget;
		$data['form']	= $this->widgets->render_backend($widget->slug, isset($widget->options) ? $widget->options : array());
        
        $this->template->write_view('content', 'module_views/project_management/instances/form', $data);
        $this->template->render();
	}
}

?>
