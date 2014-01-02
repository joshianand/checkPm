<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * <p style="text-align:justify">
 * Controller for task modules
 * </p>
 * @package Core
 * @subpackage Controller
 * @category Controller
 * @property CI_Session $session CI session library
 * @property CI_Input $input Input object
 * @author Pronab Saha (pranab.su@gmail.com)
 */
class Installer extends G_controller {

    public function __construct() {
        parent::__construct(get_class());

        $this->load->library('unzip');

        $this->load->model('core_models/system_management/Model_installer', 'installer');
    }

    /**
     * <p style="text-align:justify">
     * Display list page
     * </p>
     * @access public
     */
    public function index() {
        $page_data['token'] = $this->token;
        $this->construct_ui();
        $this->template->write_view('content', 'core_views/system_management/comp_installer', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing installed module list making
     * </p>
     * @access public
     */
    public function GetInstalledModules() {
        if (IS_AJAX) {
            $limit = $this->input->get('take', TRUE);
            $offset = $this->input->get('skip', TRUE);

            $sort_data = $this->input->get('sort', TRUE);

            $sort_direction = ( $sort_data[0]['dir'] == '') ? 'desc' : $sort_data[0]['dir'];
            $sort_field = ( $sort_data[0]['field'] == '') ? 'module_id' : $sort_data[0]['field'];

            $data['modules'] = $this->installer->get_modules($limit, $offset, $sort_direction, $sort_field);
            $data['count'] = $this->installer->count_modules();

            echo json_encode($data);
        } else {
            show_error('Sorry, direct access is not allowed.');
        }
    }

    /**
     * <p style="text-align:justify">
     * Display new module installation page
     * </p>
     * @access public
     */
    public function install_new_module() {
        $this->construct_ui();
        $page_data['token'] = $this->token;
        $page_data['tid'] = $this->user_data['tid'];

        $this->template->write_view('content', 'core_views/system_management/form_module_installation', $page_data);
        $this->template->render();
    }

    /**
     * <p style="text-align:justify">
     * Processing module save
     * </p>
     * @access public
     */
    public function SaveModule() {
        if (IS_AJAX) {
            $output_result = array();
            $file_name = $this->input->post('uploadedFileName', TRUE);

            if (trim($file_name) == FALSE) {
                $output_result['flag'] = 0;
                $output_result['message'] = 'No file found. Please upload file again';
            } else {
                set_time_limit(0);
                $file_name = pathinfo($file_name, PATHINFO_FILENAME);
                $extension = '.zip';

                $installation_result = $this->InstallModule($file_name, $extension);
                if ($installation_result == '') {
                    recursive_remove_directory(INSTALLER_PROCESS_URL . DIRECTORY_SEPARATOR . $file_name, TRUE);
                    recursive_remove_directory(INSTALLER_UPLOAD_URL . DIRECTORY_SEPARATOR . $file_name . $extension, TRUE);
                    rmdir(INSTALLER_PROCESS_URL . DIRECTORY_SEPARATOR . $file_name);
                    $output_result['flag'] = 1;
                    $output_result['message'] = 'Uploaded module installed successfully';
                } else {
                    $output_result['flag'] = 0;
                    $output_result['message'] = $installation_result;
                }
            }
            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing module update
     * </p>
     * @access public
     */
    public function UpdateModule() {
        if (IS_AJAX) {
            $enc_task_id = $this->input->post('task_id', TRUE);
            $task_id = $this->encrypt->decode($enc_task_id);
            $is_active = $this->input->post('is_active', TRUE) == 'true' ? 'yes' : 'no';

            if ($this->installer->update_task($task_id, $is_active) === TRUE) {
                echo "1*Module updated successfully";
            } else {
                echo "0*An error occur while updating module. Please contact with administrator";
            }
        } else {
            show_error('Sorry direct access is not allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing uninstall module
     * </p>
     * @access public
     */
    public function UninstallModule() {
        if (IS_AJAX) {
            $output_result = array();
            $output_result['flag'] = 1;

            $enc_task_id = $this->input->post('task_id', TRUE);
            $enc_module_id = $this->input->post('module_id', TRUE);

            $module_id = $this->encrypt->decode($enc_module_id);
            $task_id = $this->encrypt->decode($enc_task_id);

            $module_folder_name = $this->installer->get_module_folder_name($module_id);

            if ($this->installer->update_module(NULL, NULL, NULL, -1, $module_id, $task_id)) {
                $this->RemoveCodeFiles($module_folder_name);
                $output_result['message'] = 'Module uninstalled successfully. Plese refresh the page to get effect';
            } else {
                $output_result['message'] = 'An error occur while uninstalling. Please contact with administrator';
            }

            echo json_encode($output_result);
        } else {
            show_error('Sorry, direct access isnt allowed');
        }
    }

    /**
     * <p style="text-align:justify">
     * Processing remove code files
     * </p>
     * @access protected
     * @param string $folder_name Folder name
     */
    protected function RemoveCodeFiles($folder_name = '') {
        recursive_remove_directory(APPPATH . "models/module_models/$folder_name", TRUE);
        recursive_remove_directory(APPPATH . "views/module_views/$folder_name", TRUE);
        recursive_remove_directory(APPPATH . "helpers/modules/$folder_name", TRUE);
        recursive_remove_directory(APPPATH . "libraries/module_libraries/$folder_name", TRUE);
        recursive_remove_directory(FCPATH . "scripts/module_scripts/$folder_name", TRUE);
        recursive_remove_directory(FCPATH . "styles/module_styles/$folder_name", TRUE);
        recursive_remove_directory(FCPATH . "images/module_images/$folder_name", TRUE);
        recursive_remove_directory(FCPATH . "public_uploads/module_files/$folder_name", TRUE);

        rmdir(APPPATH . "models/module_models/$folder_name");
        rmdir(APPPATH . "views/module_views/$folder_name");
        rmdir(APPPATH . "helpers/modules/$folder_name");
        rmdir(APPPATH . "libraries/module_libraries/$folder_name");
        rmdir(FCPATH . "scripts/module_scripts/$folder_name");
        rmdir(FCPATH . "styles/module_styles/$folder_name");
        rmdir(FCPATH . "images/module_images/$folder_name");
        rmdir(FCPATH . "public_uploads/module_files/$folder_name");
    }

    /**
     * <p style="text-align:justify">
     * Processing module installation
     * </p>
     * @access protected
     * @param string $file_name File name
     * @param string $extension Extension name
     * @return string Returns empty string if installed successfully otherwise error message
     */
    protected function InstallModule($file_name = '', $extension = '.zip') {
        $src_path = INSTALLER_UPLOAD_URL . DIRECTORY_SEPARATOR . "$file_name$extension";
        $dst_path = INSTALLER_PROCESS_URL . DIRECTORY_SEPARATOR . "$file_name";

        //extract files
        if (file_exists($src_path)) {
            mkdir($dst_path);
            $this->unzip->extract($src_path, $dst_path);

            $files = $this->get_files($dst_path);
            $file_root = $files[0];

            $dst_path .= DIRECTORY_SEPARATOR . $file_root;
        } else {
            return 'No file found to process. Please upload file again';
        }

        //check manifest file
        if (file_exists($dst_path . DIRECTORY_SEPARATOR . "manifest.xml") == FALSE) {
            return 'No manifest file found, Cant continue installation process';
        }

        $manifest_details = $this->GetManifestDetails($dst_path);
        $module_name = $manifest_details['module_name'];
        $module_title = $manifest_details['module_title'];
        $installation_method = $manifest_details['install_method'];
        $module_folder_name = $manifest_details['module_folder_name'];

        if ($this->installer->is_duplicate_module_folder_name($module_folder_name) && $installation_method == 'install') {
            return "Installation method is found install type but $module_name already installed. Try upgrade method when packing installer file";
        } else if ($installation_method == 'upgrade') {
            $module_task_id = $this->installer->get_module_and_task_id($module_name);
            if (count($module_task_id) > 0) {
                $module_id = $module_task_id[''];
                $task_id = $module_task_id[''];
            } else {
                return "Installation method is found upgrade type but no module found as $module_name. Try check module name when packing installer file";
            }
        }

        $sql_file = $dst_path . DIRECTORY_SEPARATOR . "install.sql";
        if (file_exists($sql_file)) {
            if (filesize($sql_file) > 0) {
                $import_errors = '';
                $this->ImportSQL($sql_file, ";", $import_errors);

                if ($import_errors) {
                    return $import_errors;
                }
            }
        }
        $copy_result = $this->CopyCodeFiles($dst_path, $installation_method, $module_folder_name);
        if ($copy_result != '') {
            return $copy_result;
        }

        $module_data = array(
            'module_name' => $module_name,
            'module_folder_name' => $module_folder_name,
            'developer_name' => $manifest_details['author_name'],
            'installed_date' => strtotime('now'),
            'developed_date' => $manifest_details['created_date'],
            'developer_email' => $manifest_details['author_email'],
            'developer_contact' => $manifest_details['author_contact'],
            'version' => $manifest_details['version']
        );

        $module_details = $manifest_details['sub_modules'];

        if ($installation_method == 'install') {
            $this->installer->update_module($module_data, $module_details, $module_name);
        } else {
            $installed_sub_modules = $this->installer->get_sub_modules($task_id);
            $target_modules = array();

            foreach ($module_details as $module) {
                if (in_array($module['name'], $installed_sub_modules) == FALSE) {
                    array_push($target_modules, $module);
                }
            }

            $this->installer->update_module($module_data, $target_modules, $module_title, $module_id, $task_id);
        }

        return '';
    }

    /**
     * <p style="text-align:justify">
     * Processing copying code files
     * </p>
     * @access protected
     * @param string $src_path Source path
     * @param string $installation_method Installation method
     * @param string $module_folder_name Module folder name
     */
    protected function CopyCodeFiles($src_path = '', $installation_method = 'install', $module_folder_name = '') {
        $src_model_path = $src_path . DIRECTORY_SEPARATOR . "models";
        $src_view_path = $src_path . DIRECTORY_SEPARATOR . "views";
        $src_controller_path = $src_path . DIRECTORY_SEPARATOR . "controllers";
        $src_helper_path = $src_path . DIRECTORY_SEPARATOR . "helpers";
        $src_lib_path = $src_path . DIRECTORY_SEPARATOR . "libraries";
        $src_script_path = $src_path . DIRECTORY_SEPARATOR . "scripts";
        $src_style_path = $src_path . DIRECTORY_SEPARATOR . "styles";
        $src_img_path = $src_path . DIRECTORY_SEPARATOR . "images";
        $src_file_path = $src_path . DIRECTORY_SEPARATOR . "uploaded_files";

        $dest_model_path = APPPATH . "models/module_models/$module_folder_name";
        $dest_view_path = APPPATH . "views/module_views/$module_folder_name";
        $dest_controller_path = APPPATH . "controllers";
        $dest_helper_path = APPPATH . "helpers/modules/$module_folder_name";
        $dest_library_path = APPPATH . "libraries/module_libraries/$module_folder_name";
        $dest_script_path = FCPATH . "scripts/module_scripts/$module_folder_name";
        $dest_style_path = FCPATH . "styles/module_styles/$module_folder_name";
        $dest_image_path = FCPATH . "images/module_images/$module_folder_name";
        $dest_file_path = FCPATH . "public_uploads/module_files/$module_folder_name";

        if ($installation_method == 'install') {
            if (mkdir($dest_model_path) == FALSE) {
                $dest_model_path = APPPATH . "models/module_models";
                return "Model directory failed to create. Please check write permission on $dest_model_path";
            }

            if (mkdir($dest_view_path) == FALSE) {
                $dest_view_path = APPPATH . "views/module_views";
                return "View directory failed to create. Please check write permission on $dest_view_path";
            }

            if (mkdir($dest_helper_path) == FALSE) {
                $dest_helper_path = APPPATH . "helpers/modules";
                return "Helper directory failed to create. Please check write permission on $dest_helper_path";
            }

            if (mkdir($dest_library_path) == FALSE) {
                $dest_library_path = APPPATH . "libraries/module_libraries";
                return "Library directory failed to create. Please check write permission on $dest_library_path";
            }

            if (mkdir($dest_script_path) == FALSE) {
                $dest_script_path = FCPATH . "scripts/module_scripts";
                return "Script directory failed to create. Please check write permission on $dest_script_path";
            }

            if (mkdir($dest_style_path) == FALSE) {
                $dest_style_path = FCPATH . "styles/module_styles";
                return "Style directory failed to create. Please check write permission on $dest_style_path";
            }

            if (mkdir($dest_image_path) == FALSE) {
                $dest_image_path = FCPATH . "images/module_images";
                return "Image directory failed to create. Please check write permission on $dest_image_path";
            }

            if (mkdir($dest_file_path) == FALSE) {
                $dest_file_path = FCPATH . "public_uploads/module_files";
                return "Upload file directory failed to create. Please check write permission on $dest_file_path";
            }

            if (is_dir($src_model_path)) {
                if($this->recurse_copy($src_model_path, $dest_model_path) == FALSE){
                    return "Copy failed for model files";
                }
//                $files = $this->get_files($src_model_path);
//                foreach ($files as $file) {
//                    if(copy($src_model_path . DIRECTORY_SEPARATOR . $file, $dest_model_path . DIRECTORY_SEPARATOR . $file) == FALSE){
//                        return "Copy failed for model files";
//                    }
//                }
            }

            if (is_dir($src_view_path)) {
                if($this->recurse_copy($src_view_path, $dest_view_path) == FALSE){
                    return "Copy failed for view files";
                }
//                $files = $this->get_files($src_view_path);
//                foreach ($files as $file) {
//                    if(copy($src_view_path . DIRECTORY_SEPARATOR . $file, $dest_view_path . DIRECTORY_SEPARATOR . $file) == FALSE){
//                        return "Copy failed for view files";
//                    }
//                }
            }

            if (is_dir($src_controller_path)) {
                if($this->recurse_copy($src_controller_path, $dest_controller_path) == FALSE){
                    return "Copy failed for controller files";
                }
//                $files = $this->get_files($src_controller_path);
//                foreach ($files as $file) {
//                    if(copy($src_controller_path . DIRECTORY_SEPARATOR . $file, $dest_controller_path . DIRECTORY_SEPARATOR . $file) == FALSE){
//                        return "Copy failed for controller files";
//                    }
//                }
            }

            if (is_dir($src_helper_path)) {
                if($this->recurse_copy($src_helper_path, $dest_helper_path) == FALSE){
                    return "Copy failed for helper files";
                }
//                $files = $this->get_files($src_helper_path);
//                foreach ($files as $file) {
//                    if(copy($src_helper_path . DIRECTORY_SEPARATOR . $file, $dest_helper_path . DIRECTORY_SEPARATOR . $file) == FALSE){
//                        return "Copy failed for helper files";
//                    }
//                }
            }

            if (is_dir($src_lib_path)) {
                if($this->recurse_copy($src_lib_path, $dest_library_path) == FALSE){
                    return "Copy failed for library files";
                }
//                $files = $this->get_files($src_lib_path);
//                foreach ($files as $file) {
//                    if(copy($src_lib_path . DIRECTORY_SEPARATOR . $file, $dest_library_path . DIRECTORY_SEPARATOR . $file) == FALSE){
//                        return "Copy failed for library files";
//                    }
//                }
            }

            if (is_dir($src_script_path)) {
                if($this->recurse_copy($src_script_path, $dest_script_path) == FALSE){
                    return "Copy failed for script files";
                }
//                $files = $this->get_files($src_script_path);
//                foreach ($files as $file) {
//                    if(copy($src_script_path . DIRECTORY_SEPARATOR . $file, $dest_script_path . DIRECTORY_SEPARATOR . $file) == FALSE){
//                        return "Copy failed for script files";
//                    }
//                }
            }

            if (is_dir($src_style_path)) {
                if($this->recurse_copy($src_style_path, $dest_style_path) == FALSE){
                    return "Copy failed for style files";
                }
//                $files = $this->get_files($src_style_path);
//                foreach ($files as $file) {
//                    if(copy($src_style_path . DIRECTORY_SEPARATOR . $file, $dest_style_path . DIRECTORY_SEPARATOR . $file) == FALSE){
//                        return "Copy failed for style files";
//                    }
//                }
            }

            if (is_dir($src_img_path)) {
                if($this->recurse_copy($src_img_path, $dest_image_path) == FALSE){
                    return "Copy failed for image files";
                }
//                $files = $this->get_files($src_img_path);
//                foreach ($files as $file) {
//                    if(copy($src_img_path . DIRECTORY_SEPARATOR . $file, $dest_image_path . DIRECTORY_SEPARATOR . $file) == FALSE){
//                        return "Copy failed for image files";
//                    }
//                }
            }

            if (is_dir($src_file_path)) {
                if($this->recurse_copy($src_file_path, $dest_file_path) == FALSE){
                    return "Copy failed for uploaded files";
                }
//                $files = $this->get_files($src_file_path);
//                foreach ($files as $file) {
//                    if(copy($src_file_path . DIRECTORY_SEPARATOR . $file, $dest_file_path . DIRECTORY_SEPARATOR . $file)){
//                        return "Copy failed for uploaded files";
//                    }
//                }
            }
        } else if ($installation_method == 'upgrade') {
            if (is_dir($src_model_path)) {
                $files = $this->get_files($src_model_path);
                foreach ($files as $file) {
                    if(copy($src_model_path . DIRECTORY_SEPARATOR . $file, $dest_model_path . DIRECTORY_SEPARATOR . $file) == FALSE){
                        return "Copy failed for model files";
                    }
                }
            }

            if (is_dir($src_view_path)) {
                $files = $this->get_files($src_view_path);
                foreach ($files as $file) {
                    if(copy($src_view_path . DIRECTORY_SEPARATOR . $file, $dest_view_path . DIRECTORY_SEPARATOR . $file) == FALSE){
                        return "Copy failed for view files";
                    }
                }
            }

            if (is_dir($src_controller_path)) {
                $files = $this->get_files($src_controller_path);
                foreach ($files as $file) {
                    if(copy($src_controller_path . DIRECTORY_SEPARATOR . $file, $dest_controller_path . DIRECTORY_SEPARATOR . $file) == FALSE){
                        return "Copy failed for controller files";
                    }
                }
            }

            if (is_dir($src_helper_path)) {
                $files = $this->get_files($src_helper_path);
                foreach ($files as $file) {
                    if(copy($src_helper_path . DIRECTORY_SEPARATOR . $file, $dest_helper_path . DIRECTORY_SEPARATOR . $file) == FALSE){
                        return "Copy failed for helper files";
                    }
                }
            }

            if (is_dir($src_lib_path)) {
                $files = $this->get_files($src_lib_path);
                foreach ($files as $file) {
                    if(copy($src_lib_path . DIRECTORY_SEPARATOR . $file, $dest_library_path . DIRECTORY_SEPARATOR . $file) == FALSE){
                        return "Copy failed for library files";
                    }
                }
            }

            if (is_dir($src_script_path)) {
                $files = $this->get_files($src_script_path);
                foreach ($files as $file) {
                    if(copy($src_script_path . DIRECTORY_SEPARATOR . $file, $dest_script_path . DIRECTORY_SEPARATOR . $file) == FALSE){
                        return "Copy failed for script files";
                    }
                }
            }

            if (is_dir($src_style_path)) {
                $files = $this->get_files($src_style_path);
                foreach ($files as $file) {
                    if(copy($src_style_path . DIRECTORY_SEPARATOR . $file, $dest_style_path . DIRECTORY_SEPARATOR . $file) == FALSE){
                        return "Copy failed for style files";
                    }
                }
            }

            if (is_dir($src_img_path)) {
                $files = $this->get_files($src_img_path);
                foreach ($files as $file) {
                    if(copy($src_img_path . DIRECTORY_SEPARATOR . $file, $dest_image_path . DIRECTORY_SEPARATOR . $file) == FALSE){
                        return "Copy failed for image files";
                    }
                }
            }

            if (is_dir($src_file_path)) {
                $files = $this->get_files($src_file_path);
                foreach ($files as $file) {
                    if(copy($src_file_path . DIRECTORY_SEPARATOR . $file, $dest_file_path . DIRECTORY_SEPARATOR . $file)){
                        return "Copy failed for uploaded files";
                    }
                }
            }
        }
        
        return '';
    }

    /**
     * <p style="text-align:justify">
     * Get file list
     * </p>
     * @access protected
     * @param string $dir Directory path
     * @return array Return file list array
     */
    protected function get_files($dir = '') {
        $file_names = array();

        $files = scandir($dir, 1);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..' || $file === 'index.html') {
                continue;
            }

            array_push($file_names, $file);
        }

        return $file_names;
    }

    /**
     * <p style="text-align:justify">
     * Processing sql file import
     * </p>
     * @access protected
     * @param string $file File name
     * @param string $delimiter Delimeter token
     * @param string $import_errors Import error
     * @return boolean Returns TRUE if succeed otherwise FALSE
     */
    protected function ImportSQL($file = '', $delimiter = ';', &$import_errors = '') {
        set_time_limit(0);

        if (is_file($file) === true) {
            $file = fopen($file, 'r');

            if (is_resource($file) === true) {
                $query = array();

                while (feof($file) === false) {
                    $query[] = fgets($file);

                    if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1) {
                        $query = trim(implode('', $query));

                        if ($this->installer->run_sql_file($query) === FALSE) {
                            $import_errors .= $query . ";";
                        }

                        flush();
                    }

                    if (is_string($query) === true) {
                        $query = array();
                    }
                }

                return fclose($file);
            }
        }

        return false;
    }

    /**
     * <p style="text-align:justify">
     * Processing manifest file details
     * </p>
     * @access protected
     * @param string $path Path
     * @return array Returns manifest details
     */
    protected function GetManifestDetails($path = '') {
        $details = array();

        $path .= DIRECTORY_SEPARATOR . "manifest.xml";
        $xml = simplexml_load_file($path);

        $attributes = $xml->attributes();

        $details['install_method'] = "" . $attributes['method'][0];
        $details['version'] = "" . $attributes['version'][0];

        $details['module_name'] = "" . $xml->moduleName;
        $details['module_folder_name'] = "" . $xml->moduleFolderName;
        $details['author_name'] = "" . $xml->author;
        $details['created_date'] = "" . $xml->creationDate;
        $details['author_email'] = "" . $xml->authorEmail;
        $details['author_contact'] = "" . $xml->authorContact;
        $details['copyright'] = "" . $xml->copyright;
        $details['license'] = "" . $xml->license;

        $module_node = $xml->module[0];
        $module_node_attributes = $module_node->attributes();
        $details['module_title'] = "" . $module_node_attributes['name'][0];
        $details['sub_modules'] = array();

        foreach ($module_node->sub as $sub_module) {
            $attributes = $sub_module->attributes();
            $data = array(
                'name' => "" . $attributes['name'][0],
                'controller' => "" . $attributes['controller'][0],
                'function' => "" . $attributes['function'][0]
            );

            array_push($details['sub_modules'], $data);
        }

        return $details;
    }

    /**
     * <p style="text-align:justify">
     * Processing upload file
     * </p>
     * @access public
     */
    public function UploadFile() {
        $fileType = $_FILES['installerFile']['type'];
        $fileSize = $_FILES['installerFile']['size'];
        $tempFile = $_FILES['installerFile']['tmp_name'];
        $targetPath = INSTALLER_UPLOAD_URL . '/';
        
        if ($fileType == 'application/octet-stream') {
            $fileid = uniqid();
            $fileParts = explode('.', $_FILES['installerFile']['name']);

            $targetFile = str_replace('//', '/', $targetPath) . $fileid . '.' . $fileParts[count($fileParts) - 1];

            move_uploaded_file($tempFile, $targetFile);
            $result = array(
                'status' => 'ok',
                'fileName' => $fileid . '.' . $fileParts[count($fileParts) - 1],
                'message' => ''
            );
            echo json_encode($result);
        } else {
            $result = array(
                'status' => 'failed',
                'fileName' => '',
                'message' => 'Sorry upload failed due to given file extension is not supported.'
            );

            echo json_encode($result);
        }
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
        return TRUE;
    }

}

