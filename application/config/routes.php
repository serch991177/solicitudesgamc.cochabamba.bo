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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['iniciar-sesion']            =     'general/login/iniciar_sesion';
$route['cerrar-sesion']             =     'general/login/logout';
$route['registro']                  =     'general/login/registro';
$route['bienvenido']                =     'welcome';

/* MENU FUNCION */
$route['funciones']                 =     'admin/funcion';
$route['registrar-funcion']         =     'admin/funcion/registrar';
$route['guardar-funcion']           =     'admin/funcion/guardar';
$route['editar-funcion']            =     'admin/funcion/editar';
$route['actualizar-funcion']        =     'admin/funcion/actualizar';


/* MENU USUARIOS */
$route['usuarios']                  =     'admin/usuario';
$route['funciones-usuario/(:num)']  =     'admin/usuario/funciones/$1';
$route['cambiar-estado-funcion-usuario'] ='admin/usuario/cambiar_estado';

/* MENU FUNCIONES POR DEFECTO */
$route['por-defecto']                =     'admin/defecto';
$route['cambiar-estado-por-defecto'] =     'admin/defecto/cambiar';
$route['registrar-por-defecto']      =     'admin/defecto/registrar';
$route['guardar-funcion-defecto']    = 'admin/defecto/guardar';

/* MENU USUARIOS DESIGNADOS */
$route['dnis']                       = 'admin/especial/index';
$route['cambiar-estado-dni']         = 'admin/especial/cambiar';
$route['registrar-dni']              = 'admin/especial/registrar';
$route['guardar-dni']                = 'admin/especial/guardar';

/* MENU GESTION */
$route['gestiones']                  = 'admin/gestion/index';
$route['cambiar-estado-gestion']     = 'admin/gestion/cambiar';
$route['registrar-gestion']          = 'admin/gestion/registrar';
$route['guardar-gestion']            = 'admin/gestion/guardar';

/* MENU ROL */
$route['roles']                      = 'admin/rol/index';
$route['cambiar-estado-rol']         = 'admin/rol/cambiar';
$route['registrar-rol']              = 'admin/rol/registrar';
$route['guardar-rol']                = 'admin/rol/guardar';

/* MENU PERFIL */
$route['informacion']                = 'general/perfil/informacion';
$route['mis-datos']                  = 'general/perfil/index';
$route['pagina-principal']           = 'general/perfil/inicio';
$route['cambiar-contrasenia']                   = 'general/perfil/contrasenia';
$route['registrar-cambiar-contrasenia']         = 'general/perfil/registrarCambioContrasenia';

/* ITEM */
$route['ver-items']                  = 'normal/item/index';
$route['registro-item']              = 'normal/item/registro';
$route['editar-item']                = 'normal/item/editar';
$route['modificar-item']             = 'normal/item/modificar';
$route['propuestas']                 = 'normal/item/propuesta';

/* GRUPO */
$route['registro-grupo']             = 'normal/grupo/registro';
$route['ver-grupos']                 = 'normal/grupo/index';

/* PROVEEDORES */
$route['ver-proveedores']            = 'normal/proveedor/listado';
$route['notificar-proveedores']      = 'normal/proveedor/notificacion';
$route['info-personal']              = 'normal/proveedor/personal';


/*REPORTES MULTIPLES*/
$route['print-propuestas']           = 'normal/reporte/propuestas';
$route['propuesta-proveedor']        = 'normal/reporte/proveedor';

$route['filtros']                    = 'normal/reporte/filtros';
$route['reporte-general']            = 'normal/reporte/general';
$route['imprimir-general']           = 'normal/reporte/imprimir_general';

/* SOLO REGISTRO */ 
$route['requerimientos-gamc']                = 'registrador/requerimiento/index';
$route['agregar-requerimiento']              = 'registrador/requerimiento/agregar';
$route['editar-requerimiento']               = 'registrador/requerimiento/editar';
$route['modificar-requerimiento']            = 'registrador/requerimiento/modificar';

/*CARACTERISTICAS DETALLADAS */
$route['ver-necesidades']                    = 'version2/necesidad/index';
$route['agregar-item']                       = 'version2/necesidad/agregar';
$route['new-registro']                       = 'version2/necesidad/new_registro';

$route['mod-item']                           = 'version2/necesidad/editar';
$route['actualizar-item']                    = 'version2/necesidad/modificar';

$route['detalle-item']                       = 'version2/propuesta/index';
$route['ver-propuesta']                      = 'version2/propuesta/propuesta';

$route['adjudicar-propuesta']                = 'version2/propuesta/adjudicar';

$route['imprimir-propuestas']                = 'version2/impreso/propuestas';
$route['imprimir-proveedor']                 = 'version2/impreso/proveedor';

$route['adjuntar-adjudicacion']              = 'version2/propuesta/adjudicacion_adjuntos';




