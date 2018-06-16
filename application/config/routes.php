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
$route['prospectos']['GET']		        			=   'Prospectos_controller/obtenerTodos'; 
$route['prospectos/nuevo']['POST']		    		=   'Prospectos_controller/nuevo';
$route['prospectos/eliminar']['DELETE']	        	=   'Prospectos_controller/eliminarPorArray';
$route['prospectos/editar/(:any)']['PUT']	    	=   'Prospectos_controller/editar/idProspecto/$1';
$route['prospectos/eliminar/(:any)']['DELETE']		=   'Prospectos_controller/eliminarPorId/idProspecto/$1';
$route['prospectos/porVendedor/(:any)']['GET']		=   'Prospectos_controller/obtenerPorVendedor/idVendedor/$1';
$route['prospectos/(:any)']['GET']		        	=   'Prospectos_controller/obtenerPorId/idProspecto/$1';

$route['usuarios']['GET']		                	=   'Usuarios_controller/obtenerTodos'; 
$route['usuarios/nuevo']['POST']		        	=   'Usuarios_controller/nuevo';
$route['usuarios/eliminar']['DELETE']	        	=   'Usuarios_controller/eliminarPorArray';
$route['usuarios/editar/(:any)']['PUT']    			=   'Usuarios_controller/editar/idUsuario/$1';
$route['usuarios/eliminar/(:any)']['DELETE']		=   'Usuarios_controller/eliminarPorId/idUsuario/$1';
$route['usuarios/porSucursal/(:any)']['GET']		=   'Usuarios_controller/obtenerPorSucursal/idSucursal/$1';
$route['usuarios/(:any)']['GET']		        	=   'Usuarios_controller/obtenerPorId/idUsuario/$1';
$route['usuarios/login']['POST']		        	=   'Usuarios_controller/login';

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
$route['modelos/publico']['GET']	              	=   'Modelos_controller/publico';
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

$route['ventas']['GET']		            			=   'Ventas_controller/obtenerTodos';
$route['ventas/(:any)']['GET']		    			=   'Ventas_controller/obtenerPorId/idVenta/$1';
$route['ventas/nuevo']['POST']		    			=   'Ventas_controller/nuevo';
$route['ventas/editar/(:any)']['PUT']    			=   'Ventas_controller/editar/idVenta/$1';

$route['clientes']['GET']		        			=   'Clientes_controller/obtenerTodos'; 
$route['clientes/nuevo']['POST']		    		=   'Clientes_controller/nuevo';
$route['clientes/editar/(:any)']['PUT']	    	    =   'Clientes_controller/editar/idCliente/$1';
$route['clientes/porUsuarioCreador/(:any)']['GET']	=   'Clientes_controller/obtenerPorUsuarioCreador/idUsuarioCreador/$1';
$route['clientes/(:any)']['GET']		        	=   'Clientes_controller/obtenerPorId/idCliente/$1';

$route['seguimientos']['GET']		                =   'Seguimientos_controller/obtenerTodos'; 
$route['seguimientos/(:any)']['GET']		        =   'Seguimientos_controller/obtenerPorId/idSeguimiento/$1';
$route['seguimientos/nuevo']['POST']		        =   'Seguimientos_controller/nuevo';
$route['seguimientos/editar/(:any)']['PUT']    		=   'Seguimientos_controller/editar/idSeguimiento/$1';

$route['colores']['GET']		            		=   'Colores_controller/obtenerTodos'; 
$route['colores/(:any)']['GET']		        		=   'Colores_controller/obtenerPorId/idColor/$1';
$route['colores/nuevo']['POST']		        		=   'Colores_controller/nuevo';
$route['colores/editar/(:any)']['PUT']    			=   'Colores_controller/editar/idColor/$1';
$route['colores/nuevaRelacionModeloColor']['POST']	=   'Colores_controller/nuevaRelacionModeloColor';
$route['colores/porModelo/(:any)']['GET']		    =   'Colores_controller/obtenerPorModelo/idModeloVehiculo/$1';
$route['colores/eliminarPorModelo/(:any)/(:any)']['DELETE']=   'Colores_controller/eliminarPorModelo/idModeloVehiculo/$1/idColor/$2';

$route['imagen/nuevo']['POST']		        		=   'Imagen_controller/nuevo';
$route['imagen/editar']['POST']    					=   'Imagen_controller/editar';
$route['imagen/(:any)/(:any)']['GET']		    	=   'Imagen_controller/obtenerImagenes/idModeloVehiculo/$1/idColor/$2'; 
$route['imagen/eliminar/(:any)']['DELETE']			=   'Imagen_controller/eliminar/idImagen/$1';

$route['solicitud/nuevo']['POST']		        	=   'Solicitud_controller/nuevo';
$route['solicitud/editar/(:any)']['PUT']    		=   'Solicitud_controller/editar/idSolicitud/$1';
$route['solicitud/editarEstado/(:any)']['PUT']    	=   'Solicitud_controller/editarEstado/idSolicitud/$1';
$route['solicitud/porSucursalSolicitante/(:any)']['GET']	=   'Solicitud_controller/obtenerPorSucursalSolicitante/idSucursalSolicitante/$1';
$route['solicitud/porSucursalSolicitada/(:any)']['GET']		=   'Solicitud_controller/obtenerPorSucursalSolicitada/idSucursalSolicitada/$1';

$route['stock']['GET']		                	=   'Stock_controller/obtenerTodos'; 
$route['stock/(:any)']['GET']		        	=   'Stock_controller/obtenerPorId/idStock/$1';
$route['stock/porIdSucursal/(:any)/(:any)']['GET']		=   'Stock_controller/obtenerPorIdSucursal/idSucursal/$1/estado/$2';
$route['stock/nuevo']['POST']		        	=   'Stock_controller/nuevo';
$route['stock/editar/(:any)']['PUT']    		=   'Stock_controller/editar/idStock/$1';