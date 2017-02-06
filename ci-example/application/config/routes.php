<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['/clientes/lista/(:any)'] = '/clientes/lista/$1';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
