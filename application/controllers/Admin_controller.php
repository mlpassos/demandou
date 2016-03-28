<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        if ((int) $this->session->userdata('codigo_perfil')!==2) {
        	redirect(base_url());
        }
    }

	public function index()	{
		// META
		$data_header['meta']=array(
			array(
			"name" => "title",
			"content" => "Página do Administrador"
			),
			array(
			"name" => "description",
			"content" => "Página do Administrador"
			),
			array(
			"name" => "keywords",
			"content" => "admin,demandou,demandas, html5, sistema"
			)
		);
		// MENU
		$data_header['menu']=array(
			array(
				"name" => "Projetos",
				"link" => base_url() . 'projetos',
				"class" => ""
				),
				array(
				"name" => "Tarefas",
				"link" => base_url() . 'tarefas',
				"class" => ""
				),
				array(
				"name" => "Usuários",
				"link" => base_url() . 'usuarios',
				"class" => ""
				),
				array(
				"name" => "Relatórios",
				"link" => base_url() . 'relatorios',
				"class" => ""
			)
		);
		// CSS
		$data_header['css']=array(
			array('file' => 'estilos-principal.css'),
			array('file' => 'estilos-admin.css')
			); 
		// JS
		$data_footer['js']=array(
			// array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js'), 
			// array('file' => 'http://js.pusher.com/3.0/pusher.min.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/admin.js')
		);

		$this->load->model('projeto_model');
		$this->load->model('tarefa_model');
		$data['projetos'] = $this->projeto_model->listarTotalAtivo();
		$data['projetos_encerrados'] = $this->projeto_model->listarTotalEncerrado();
		$data['tarefas'] = $this->tarefa_model->listarTotalAtivo();
		$data['tarefas_encerradas'] = $this->tarefa_model->listarTotalEncerrado();
		$data['tarefas_entregues'] = $this->tarefa_model->listarTotalEntregue();
		$data['tarefas_aguardando'] = $this->tarefa_model->listarTotalAguardando();
		$data['tarefas_semana'] = $this->tarefa_model->listarVencimentoSemana();
		$data['tarefas_vencidas'] = $this->tarefa_model->listarVencidas();

		$this->load->view('header_view',$data_header);
		$this->load->view('admin/content_view', $data);
		$this->load->view('footer_view',$data_footer);		
	}

}
