<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// Default configuration
$route['default_controller']            			=   'welcome';
$route['404_override']                  			=   '';
$route['translate_uri_dashes']          			=   FALSE;

// API routes
$route['clientes']['GET']		        			=   'Clientes_controller/obtenerTodos'; 
$route['clientes/nuevo']['POST']		    		=   'Clientes_controller/nuevo';
$route['clientes/eliminar']['DELETE']	        	=   'Clientes_controller/eliminarPorArray';
$route['clientes/editar/(:any)']['PUT']	    		=   'Clientes_controller/editar/idCliente/$1';
$route['clientes/eliminar/(:any)']['DELETE']		=   'Clientes_controller/eliminarPorId/idCliente/$1';
$route['clientes/porVendedor/(:any)']['GET']		=   'Clientes_controller/obtenerPorVendedor/idVendedor/$1';
$route['clientes/(:any)']['GET']		        	=   'Clientes_controller/obtenerPorId/idCliente/$1';

$route['usuarios']['GET']		                	=   'Usuarios_controller/obtenerTodos'; 
$route['usuarios/nuevo']['POST']		        	=   'Usuarios_controller/nuevo';
$route['usuarios/eliminar']['DELETE']	        	=   'Usuarios_controller/eliminarPorArray';
$route['usuarios/editar/(:any)']['PUT']    			=   'Usuarios_controller/editar/idUsuario/$1';
$route['usuarios/eliminar/(:any)']['DELETE']		=   'Usuarios_controller/eliminarPorId/idUsuario/$1';
$route['usuarios/porSucursal/(:any)']['GET']		=   'Usuarios_controller/obtenerPorSucursal/idSucursal/$1';
$route['usuarios/(:any)']['GET']		        	=   'Usuarios_controller/obtenerPorId/idUsuario/$1';

$route['sucursales']['GET']		            		=   'Sucursales_controller/obtenerTodos'; 
$route['sucursales/nuevo']['POST']		        	=   'Sucursales_controller/nuevo';
$route['sucursales/eliminar']['DELETE']	        	=   'Sucursales_controller/eliminarPorArray';
$route['sucursales/editar/(:any)']['PUT']    		=   'Sucursales_controller/editar/idSucursal/$1';
$route['sucursales/eliminar/(:any)']['DELETE']		=   'Sucursales_controller/eliminarPorId/idSucursal/$1';
$route['sucursales/porCiudad/(:any)']['GET']		=   'Sucursales_controller/obtenerPorCiudad/ciudad/$1';
$route['sucursales/porEstado/(:any)']['GET']		=   'Sucursales_controller/obtenerPorEstado/estado/$1';
$route['sucursales/(:any)']['GET']		        	=   'Sucursales_controller/obtenerPorId/idSucursal/$1';

$route['roles']['GET']		                    	=   'Roles_controller/obtenerTodos'; 
$route['roles/nuevo']['POST']		            	=   'Roles_controller/nuevo';
$route['roles/eliminar']['DELETE']	            	=   'Roles_controller/eliminarPorArray';
$route['roles/editar/(:any)']['PUT']        		=   'Roles_controller/editar/idRol/$1';
$route['roles/eliminar/(:any)']['DELETE']	    	=   'Roles_controller/eliminarPorId/idRol/$1';
$route['roles/porNombre/(:any)']['GET']	    		=   'Roles_controller/obtenerPorNombre/rol/$1';
$route['roles/(:any)']['GET']		            	=   'Roles_controller/obtenerPorId/idRol/$1';

$route['modelos']['GET']		                	=   'Modelos_controller/obtenerTodos'; 
$route['modelos/porCategoria/(:any)']['GET']		=   'Modelos_controller/obtenerPorCategoria/categoria/$1';
$route['modelos/(:any)']['GET']		        		=   'Modelos_controller/obtenerPorId/idModeloVehiculo/$1';
$route['modelos/nuevo']['POST']		        		=   'Modelos_controller/nuevo';
$route['modelos/editar/(:any)']['PUT']    			=   'Modelos_controller/editar/idModeloVehiculo/$1';

$route['recordatorios']['GET']		            	=   'Recordatorios_controller/obtenerTodos';
$route['recordatorios/(:any)']['GET']		    	=   'Recordatorios_controller/obtenerPorId/idRecordatorio/$1';
$route['recordatorios/nuevo']['POST']		    	=   'Recordatorios_controller/nuevo';
$route['recordatorios/editar/(:any)']['PUT']    	=   'Recordatorios_controller/editar/idRecordatorio/$1';
$route['recordatorios/eliminar/(:any)']['DELETE']	=   'Recordatorios_controller/eliminarPorId/idRecordatorio/$1';

$route['envios']['GET']		            			=   'Envios_controller/obtenerTodos';
$route['envios/(:any)']['GET']		    			=   'Envios_controller/obtenerPorId/idEnvio/$1';
$route['envios/nuevo']['POST']		    			=   'Envios_controller/nuevo';
$route['envios/editar/(:any)']['PUT']    			=   'Envios_controller/editar/idEnvio/$1';







