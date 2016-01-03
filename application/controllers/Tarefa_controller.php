<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarefa_controller extends MY_Controller {

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

	public $header;
	public $ativo;


	public function __construct() {
        parent::__construct();
    
        $this->ativo = $this->uri->segment(1);

        if ( (int) $this->session->userdata('codigo_perfil')==2 ) {
        	$this->header['menu'] = array(
        		array(
				"name" => "Projetos",
				"link" => base_url() . 'projetos',
				"class" => "active"
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
        } else {
	        $this->header['menu'] = array(
					array(
					"name" => "Projetos",
					"link" => base_url() . 'projetos',
					"class" => "active"
					),
					array(
					"name" => "Relatórios",
					"link" => base_url() . 'relatorios',
					"class" => ""
					)
			);
		}
    }

	// public function index()	{
	// 	// META
	// 	$this->header['meta'] = array(
	// 		array(
	// 		"name" => "title",
	// 		"content" => "Página do Administrador - Adicionar Tarefa a Projeto"
	// 		),
	// 		array(
	// 		"name" => "description",
	// 		"content" => "Tarefas"
	// 		),
	// 		array(
	// 		"name" => "keywords",
	// 		"content" => "admin,demandou,demandas, html5, sistema"
	// 		)
	// 	);

	// 	// CSS
	// 	$this->header['css']=array(
	// 		array('file' => 'estilos-principal.css'),
	// 		array('file' => 'estilos-projetos-tarefas.css')
	// 	); 
	// 	// JS
	// 	$data_footer['js']=array(
	// 		// array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js'), 
	// 		array('file' =>  base_url() . 'assets/js/global.js'),
	// 		array('file' =>  base_url() . 'assets/js/admin.js'),
	// 		array('file' =>  base_url() . 'assets/js/tarefas-adicionar.js')
	// 	);

	// 	$this->load->view('header_view',$this->header);
	// 	$this->load->view('admin/projetos/content_view');
	// 	$this->load->view('footer_view',$data_footer);	
	// }

    public function json_usertasks() {
    	$codigo_projeto = $this->input->post('codigo_projeto');
    	$codigo_usuario = $this->session->userdata('codigo_usuario');
    	$this->load->model('tarefa_model');
    	$data['tarefas'] = $this->tarefa_model->jsonTarefasPorUsuario($codigo_projeto, $codigo_usuario);
    	echo json_encode($data['tarefas']);

    }

	public function json_projecttasks() {
    	$codigo_projeto = $this->input->post('codigo_projeto');
    	$this->load->model('tarefa_model');
    	$data['tarefas'] = $this->tarefa_model->jsonTarefasPorProjeto($codigo_projeto);
    	echo json_encode($data['tarefas']);

    }

    // public function json_tasksuserinfo() {
    // 	$codigo_tarefa = $this->input->post('codigo_tarefa');
    // 	$this->load->model('tarefa_model');
    // 	$data['tarefas_userinfo'] = $this->tarefa_model->jsonTarefasUserInfo($codigo_tarefa);
    // 	echo json_encode($data['tarefas_userinfo']);

    // }

	public function adicionar() {
		// echo $this->uri->segment(3);
		// echo $codigo_projeto;
		$dadosflash = $this->session->flashdata('adicionar_ao_projeto');
		$codigo_projeto = $dadosflash['codigo_projeto'];
		$this->session->keep_flashdata('adicionar_ao_projeto');
		// META
		$this->header['meta'] = array(
			array(
			"name" => "title",
			"content" => "Adicionar Tarefa"
			),
			array(
			"name" => "description",
			"content" => "Adicionar Tarefa"
			),
			array(
			"name" => "keywords",
			"content" => "admin,demandou,demandas, html5, sistema"
			)
		);
		// CSS
		$this->header['css']=array(
			array('file' => 'estilos-principal.css'),
			array('file' => 'estilos-tarefas-adicionar.css'),
			array('file' => 'select2.min.css')
			); 
		// CONTEUDO
		$this->load->model('projeto_model');
		$data_content['usuarios'] = $this->projeto_model->listarPorCodigo($codigo_projeto);
		$data_content['codigo_projeto'] = $codigo_projeto;
		$this->load->model('tarefa_model');
		$data_content['tarefas'] = $this->tarefa_model->listarPorCodigo($codigo_projeto);

		// JS
		$data_footer['js']=array(
			//array('file' => 'http://code.jquery.com/ui/1.11.4/jquery-ui.js'), 
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/tarefas_adicionar.js')
		);
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->view('header_view',$this->header);
		
		if ($this->form_validation->run() == FALSE) {
			//echo "inválido";
				$this->load->view('admin/tarefas/content_adicionar_view', $data_content);
			// }
		} else {
			// echo "válido";
			$tarefa = $this->input->post();
			// echo "<pre>";
			// var_dump($tarefa);
			// echo "</pre>";
			$this->load->model('tarefa_model');
			if ($this->tarefa_model->inserir($tarefa)) {
				// $data['tarefa'] = $tarefa;
				// $this->load->view('admin/tarefas/adicionar_sucesso_view.php', $data);
				// $this->load->view('admin/tarefas/content_adicionar_view', $data_content);
				$dadosenviar = array('codigo_projeto'=>$tarefa['codigo_projeto']);
				$this->session->set_flashdata('adicionar_ao_projeto',$dadosenviar);
				//var_dump($this->session->flashdata('adicionar_ao_projeto'));
				redirect(base_url() . 'tarefa/adicionar');

			} else {
				echo "Oops, deu bug. Tente novamente? =]";
			}
		}
		$this->load->view('footer_view',$data_footer);	
	}
}
