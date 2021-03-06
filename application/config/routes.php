<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'Dashboard';
$route['relatorio'] = 'Relatorio';
$route['relatorio/(:num)'] = 'Relatorio/relatorio_id/$1';
$route['transfer'] = 'Transfer';

$route['fazer_transfer'] = 'Transfer/fazer_transfer';


$route['login'] = 'Login';
$route['Login/log'] = 'Login/log';
$route['Logout'] = 'Login/logout';
$route['cadastrar'] = 'Login/cadastrar';
$route['Login/cadastrar_novo'] = 'Login/cadastrar_novo';

$route['categorias'] = 'Categorias';
$route['update_categoria'] = 'Categorias/update_categoria';
$route['carregar_tabela'] = 'Categorias/carregar_tabela';
$route['nova_categoria'] = 'Categorias/nova_categoria';
$route['delete_categoria'] = 'Categorias/delete_categoria';


$route['entradas'] = 'Entradas';
$route['update_entrada'] = 'Entradas/update_entrada';
$route['nova_entrada'] = 'Entradas/nova_entrada';
$route['delete_entradas'] = 'Entradas/delete_entradas';

$route['saidas'] = 'Saidas';
$route['update_saida'] = 'Saidas/update_saida';
$route['nova_saida'] = 'Saidas/nova_saida';
$route['delete_saida'] = 'Saidas/delete_saida';
$route['pagar'] = 'Saidas/pagar';
$route['despagar'] = 'Saidas/despagar';

$route['saidas_v'] = 'Saidas_v';
$route['update_saida_v'] = 'Saidas_v/update_saida_v';
$route['nova_saida_v'] = 'Saidas_v/nova_saida_v';
$route['delete_saida_v'] = 'Saidas_v/delete_saida_v';
$route['saidas_v_conta'] = 'Saidas_v/get_saidas_v_by_conta';
$route['saidas_v_'] = 'Saidas_v/get_saidas_v_';


$route['dividas'] = 'Dividas';
$route['nova_divida'] = 'Dividas/nova_divida';
$route['delete_dividas'] = 'Dividas/delete_dividas';
$route['valor_divida_pagar'] = 'Dividas/valor_divida_pagar';

$route['contas'] = 'Contas';
$route['contas/(:num)'] = 'Contas/Contas_id/$1';
$route['contas/novo_cartao'] = 'Contas/novo_cartao';
$route['pagar_cartao'] = 'Contas/pagar_cartao';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
