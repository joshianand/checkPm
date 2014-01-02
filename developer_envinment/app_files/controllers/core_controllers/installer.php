<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for deployment bundle
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Installer extends G_controller {

    /**
     * Class constructor
     * @access public
     */
    public function __construct() {
        parent::__construct(get_class());

        $this->load->library('zip');

        $this->load->model('core_models/system_management/Model_installer', 'installer');
        $this->load->model('core_models/system_management/Model_users', 'users');
    }

    /**
     * <p style="text-align:justify">
     * Display installer page
     * </p>
     * @access public
     */
    public function index() {
        $page_data['token'] = $this->token;

        $page_data['modules'] = $this->installer->get_modules();
        $page_data['db_tables'] = $this->installer->list_tables();

        $this->construct_ui();
        $this->template->write_view('content', 'core_views/deployment_bundle/form_bundles', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing installer creation
     * </p>
     * @access public
     */
    public function CreateInstaller() {
        if (IS_AJAX) {
            $output_result = array();

            $enc_module_id = $this->input->post('ModuleSelection', TRUE);

            $module_id = $this->encrypt->decode($enc_module_id);
            $install_type = $this->input->post('InstallerTypeSelection', TRUE);

            $table_array = json_decode($this->input->post('tables', TRUE));
            $tables = array();
            foreach ($table_array as $value) {
                array_push($tables, $value);
            }

            $module_details = $this->installer->get_module_details($module_id);
            $folder_name = $module_details['module_folder'];

            $controllers = array();
            $module_childs = $module_details['module_childs'];

            foreach ($module_childs as $child) {
                if (in_array($child['controller_name'], $controllers) == FALSE) {
                    array_push($controllers, $child['controller_name']);
                }
            }

            $author_details = $this->users->get_user_details($this->user_data['user_id']);
            mkdir(FCPATH . "tmp/$folder_name");

            $manifest_path = FCPATH . "tmp/$folder_name/manifest.xml";

            $manifest_var = array(
                'module_name' => $module_details['module_name'],
                'module_folder' => $folder_name,
                'author_name' => $author_details['first_name'] . " " . $author_details['last_name'],
                'created_date' => date("F j,Y", strtotime('now')),
                'author_email' => $author_details['email'],
                'author_contact' => $author_details['phone']
            );


            $this->copy_files($module_details['module_folder'], $controllers);

            $this->backup_db($tables, FCPATH . "tmp/$folder_name");

            $this->create_manifest_file($manifest_path, $install_type, $manifest_var, $module_childs);

            $folder_in_zip = "/$folder_name/";
            $source_path = FCPATH . "tmp/$folder_name/";
            $destination_path = FCPATH . "installers/$folder_name.zip";

            $this->zip->get_files_from_folder($source_path, $folder_in_zip);
            $this->zip->archive($destination_path);

            recursive_remove_directory(FCPATH . "tmp/$folder_name", TRUE);
            rmdir(FCPATH . "tmp/$folder_name");
            $output_result['message'] = "Installer file $folder_name.zip is ready at your /installers directory. After copy please delete that file";

            echo json_encode($output_result);
        } else {
            show_error('Sorry direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Create installer manifest file
     * </p>
     * @access protected
     * @param string $file_path File path
     * @param string $method Installation method
     * @param array $manifest_var Manifest variables
     * @param array $module_childs Module childs
     */
    protected function create_manifest_file($file_path = '', $method = 'install', $manifest_var = array(), $module_childs = array()) {
        $writer = new XMLWriter();
        $writer->openURI($file_path);
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(4);

        $writer->startElement('install');
        $writer->writeAttribute('method', $method);
        $writer->writeAttribute('version', '1.0.0');

        $writer->writeElement('moduleName', $manifest_var['module_name']);
        $writer->writeElement('moduleFolderName', $manifest_var['module_folder']);
        $writer->writeElement('author', $manifest_var['author_name']);
        $writer->writeElement('creationDate', $manifest_var['created_date']);
        $writer->writeElement('authorEmail', $manifest_var['author_email']);
        $writer->writeElement('authorContact', $manifest_var['author_contact']);
        $writer->writeElement('copyright', "Copyright Software Development Pro(C) 2013");
        $writer->writeElement('license', "Software Development Pro");

        $writer->startElement('module');
        $writer->writeAttribute('name', $manifest_var['module_name']);

        foreach ($module_childs as $child) {
            $writer->startElement('sub');
            $writer->writeAttribute('name', $child['module_name']);
            $writer->writeAttribute('controller', $child['controller_name']);
            $writer->writeAttribute('function', $child['function_name']);
            $writer->endElement();
        }
        $writer->endElement();


        $writer->endElement();
        $writer->endDocument();
        $writer->flush();
    }

    /**
     * <p style="text-align:justify">
     * Create database back up
     * </p>
     * @access protected
     * @param array $tables Table names
     * @param string $backup_path Back up path
     */
    protected function backup_db($tables = array(), $backup_path = '') {
        if (count($tables) > 0) {
            $this->load->dbutil();

            $prefs = array(
                'tables' => $tables,
                'ignore' => array('g_countries', 'g_currencies', 'g_group_tasks', 'g_logins', 'g_security_questions', 'g_sessions', 'g_system_tasks', 'g_user_contacts', 'g_user_groups', 'g_cities'),
                'format' => 'txt',
                'add_drop' => TRUE,
                'add_insert' => TRUE,
                'newline' => "\n"
            );
            $backup = & $this->dbutil->backup($prefs);
            $this->load->helper('file');
            write_file($backup_path . '/install.sql', $backup);
        }
    }

    /**
     * <p style="text-align:justify">
     * Copy files
     * </p>
     * @access protected
     * @param string $folder_name Folder name
     * @param array $controllers Controller files
     */
    protected function copy_files($folder_name = '', $controllers = array()) {
        $temp_path = FCPATH . "tmp/$folder_name/";

        $dest_controller_path = $temp_path . 'controllers';
        $dest_model_path = $temp_path . 'models';
        $dest_view_path = $temp_path . 'views';
        $dest_helper_path = $temp_path . 'helpers';
        $dest_library_path = $temp_path . 'libraries';
        $dest_script_path = $temp_path . 'scripts';
        $dest_style_path = $temp_path . 'styles';
        $dest_img_path = $temp_path . 'images';
        $dest_file_path = $temp_path . 'upload_files';
        
        $src_controller_dir = APPPATH . "controllers/";
        $src_model_dir = APPPATH . "models/module_models/$folder_name/";
        $src_view_dir = APPPATH . "views/module_views/$folder_name/";
        $src_controller_dir = APPPATH . "controllers/";
        $src_helper_dir = APPPATH . "helpers/modules/$folder_name/";
        $src_library_dir = APPPATH . "libraries/module_libraries/$folder_name/";
        $src_script_dir = FCPATH . "scripts/module_scripts/$folder_name/";
        $src_style_dir = FCPATH . "styles/module_styles/$folder_name/";
        $src_img_dir = FCPATH . "images/module_images/$folder_name/";
        $src_file_dir = FCPATH . "public_uploads/module_files/$folder_name/";

        mkdir($dest_controller_path);
        mkdir($dest_model_path);
        mkdir($dest_view_path);
        mkdir($dest_helper_path);
        mkdir($dest_library_path);
        mkdir($dest_script_path);
        mkdir($dest_style_path);
        mkdir($dest_img_path);
        mkdir($dest_file_path);
         
        foreach ($controllers as $file) {
            copy($src_controller_dir . $file . ".php", $dest_controller_path . DIRECTORY_SEPARATOR . $file . ".php");
        }

        $model_files = $this->get_files('model', $folder_name);
        foreach ($model_files as $file) {
            copy($src_model_dir . $file, $dest_model_path . DIRECTORY_SEPARATOR . $file);
        }

        $this->recurse_copy($src_view_dir, $dest_view_path);
//        $view_files = $this->get_files('view', $folder_name);
//        foreach ($view_files as $file) {
//            copy($src_view_dir . $file, $dest_view_path . DIRECTORY_SEPARATOR . $file);
//        }
        $this->recurse_copy($src_view_dir, $dest_view_path);
//        $helper_files = $this->get_files('helper', $folder_name);
//        foreach ($helper_files as $file) {
//            copy($src_helper_dir . $file, $dest_helper_path . DIRECTORY_SEPARATOR . $file);
//        }
        $this->recurse_copy($src_library_dir, $dest_library_path);
//        $lib_files = $this->get_files('library', $folder_name);
//        foreach ($lib_files as $file) {
//            copy($src_library_dir . $file, $dest_library_path . DIRECTORY_SEPARATOR . $file);
//        }
        $this->recurse_copy($src_script_dir, $dest_script_path);
//        $script_files = $this->get_files('script', $folder_name);
//        foreach ($script_files as $file) {
//            copy($src_script_dir . $file, $dest_script_path . DIRECTORY_SEPARATOR . $file);
//        }
        $this->recurse_copy($src_style_dir, $dest_style_path);
//        $style_files = $this->get_files('style', $folder_name);
//        foreach ($style_files as $file) {
//            copy($src_style_dir . $file, $dest_style_path . DIRECTORY_SEPARATOR . $file);
//        }
        $this->recurse_copy($src_img_dir, $dest_img_path);
//        $image_files = $this->get_files('image', $folder_name);
//        foreach ($image_files as $file) {
//            copy($src_img_dir . $file, $dest_img_path . DIRECTORY_SEPARATOR . $file);
//        }
        $this->recurse_copy($src_file_dir, $dest_file_path);
//        $uploaded_files = $this->get_files('file', $folder_name);
//        foreach ($uploaded_files as $file) {
//            copy($src_file_dir . $file, $dest_file_path . DIRECTORY_SEPARATOR . $file);
//        }
    }

    /**
     * <p style="text-align:justify">
     * Get file list
     * </p>
     * @access protected
     * @param string $type File type either <b>model</b> or <b>view</b> or <b>helper</b> or <b>library</b> or <b>script</b> or <b>style</b>
     * @param string $folder_name Folder name
     * @return array Return file list array
     */
    protected function get_files($type = 'model', $folder_name = '') {
        $file_names = array();

        if ($type == 'model') {
            $dir = APPPATH . "models/module_models/$folder_name";
            $files = scandir($dir, 1);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'index.html') {
                    continue;
                }

                array_push($file_names, $file);
            }
        } else if ($type == 'view') {
            $dir = APPPATH . "views/module_views/$folder_name";
            $files = scandir($dir, 1);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'index.html') {
                    continue;
                }

                array_push($file_names, $file);
            }
        } else if ($type == 'helper') {
            $dir = APPPATH . "helpers/modules/$folder_name";
            $files = scandir($dir, 1);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'index.html') {
                    continue;
                }

                array_push($file_names, $file);
            }
        } else if ($type == 'library') {
            $dir = APPPATH . "libraries/module_libraries/$folder_name";
            $files = scandir($dir, 1);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'index.html') {
                    continue;
                }

                array_push($file_names, $file);
            }
        } else if ($type == 'script') {
            $dir = FCPATH . "scripts/module_scripts/$folder_name";
            $files = scandir($dir, 1);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'index.html') {
                    continue;
                }

                array_push($file_names, $file);
            }
        } else if ($type == 'style') {
            $dir = FCPATH . "styles/module_styles/$folder_name";
            $files = scandir($dir, 1);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'index.html') {
                    continue;
                }

                array_push($file_names, $file);
            }
        } else if ($type == 'image') {
            $dir = FCPATH . "images/module_images/$folder_name";
            $files = scandir($dir, 1);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'index.html') {
                    continue;
                }

                array_push($file_names, $file);
            }
        } else if ($type == 'file') {
            $dir = FCPATH . "public_uploads/module_files/$folder_name";
            $files = scandir($dir, 1);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'index.html') {
                    continue;
                }

                array_push($file_names, $file);
            }
        }

        return $file_names;
    }
    
    protected function recurse_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }


}

