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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home_controller';
$route['off'] = 'home_controller/off';
$route['usuario/autenticar'] = 'auth_controller/autenticar';
$route['usuario/logout'] = 'auth_controller/logout';
$route['usuario/adicionar'] = 'usuario_controller/adicionar';
$route['projetos'] = 'projeto_controller';
$route['tarefas'] = 'tarefa_controller';
$route['projeto/jsonprojectusers'] = 'projeto_controller/json_projectusers';
$route['projeto/adicionar'] = 'projeto_controller/adicionar';
$route['projeto/alterar'] = 'projeto_controller/alterar';
$route['projeto/encerrar'] = 'projeto_controller/json_projectend';
$route['projeto/excluir'] = 'projeto_controller/json_projectdelete';
$route['projeto/alterar/(:num)'] = 'projeto_controller/alterar/$1';
$route['tarefa/adicionar'] = 'tarefa_controller/adicionar';
$route['tarefa/alterar'] = 'tarefa_controller/alterar';
$route['tarefa/excluir'] = 'tarefa_controller/json_taskdelete';
$route['tarefa/encerrar'] = 'tarefa_controller/json_taskend';
$route['tarefa/adicionar/(:num)'] = 'tarefa_controller/adicionar/$1';
$route['tarefa/jsonusertasks'] = 'tarefa_controller/json_usertasks';
$route['tarefa/jsonprojecttasks'] = 'tarefa_controller/json_projecttasks';
$route['tarefa/jsontasksuserinfo'] = 'tarefa_controller/json_tasksuserinfo';
$route['tarefa/jsontasksobs'] = 'tarefa_controller/json_tasksobs';
$route['tarefa/jsontasksrespostas'] = 'tarefa_controller/json_tasksrespostas';
$route['tarefa/jsontaskreply'] = 'tarefa_controller/json_taskobsreply';
$route['tarefa/jsontarefas'] = 'tarefa_controller/json_tarefas';
$route['tarefa/finalizar'] = 'tarefa_controller/finalizar';
$route['tarefa/responder'] = 'tarefa_controller/responder';
$route['usuarios'] = 'usuario_controller';
$route['admin'] = 'admin_controller';

// $route['adicionar'] = 'welcome/adicionar';
// $route['gravar'] = 'welcome/gravar';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
