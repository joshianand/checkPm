<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";

$route['profile'] = "core_controllers/profile/index";
$route['profile/UpdateCredential'] = "core_controllers/profile/UpdateCredential";
$route['profile/UpdatePersonalData'] = "core_controllers/profile/UpdatePersonalData";

$route['usergroups/index'] = "core_controllers/usergroups/index";
$route['usergroups/GetUserGroups'] = "core_controllers/usergroups/GetUserGroups";
$route['usergroups/add_new_group'] = "core_controllers/usergroups/add_new_group";
$route['usergroups/edit_group'] = "core_controllers/usergroups/edit_group";
$route['usergroups/SaveUserGroup'] = "core_controllers/usergroups/SaveUserGroup";
$route['usergroups/UpdateUserGroup'] = "core_controllers/usergroups/UpdateUserGroup";
$route['usergroups/DeleteUserGroup'] = "core_controllers/usergroups/DeleteUserGroup";

$route['users/index'] = "core_controllers/users/index";
$route['users/GetUsers'] = "core_controllers/users/GetUsers";
$route['users/add_new_user'] = "core_controllers/users/add_new_user";
$route['users/edit_user'] = "core_controllers/users/edit_user";
$route['users/SaveUser'] = "core_controllers/users/SaveUser";
$route['users/UpdateUser'] = "core_controllers/users/UpdateUser";
$route['users/DeleteUser'] = "core_controllers/users/DeleteUser";
$route['users/ResetCredentials'] = "core_controllers/users/ResetCredentials";

$route['modules/index'] = "core_controllers/modules/index";
$route['modules/GetModules'] = "core_controllers/modules/GetModules";
$route['modules/CreateModules'] = "core_controllers/modules/CreateModules";
$route['modules/UpdateModule'] = "core_controllers/modules/UpdateModule";
$route['modules/DeleteModule'] = "core_controllers/modules/DeleteModule";

$route['installer/index'] = "core_controllers/installer/index";
$route['installer/recurse_copy'] = "core_controllers/installer/recurse_copy";
$route['installer/CreateInstaller'] = "core_controllers/installer/CreateInstaller";


$route['widget/instances/create/(:any)'] = "widget/instance_create/$1";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */