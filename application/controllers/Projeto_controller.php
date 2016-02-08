<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto_controller extends MY_Controller {

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

	public function index()	{
		if( $this->session->userdata('logado') ) {
			$this->load->model('projeto_model');
        	$conteudo['projetos'] = $this->projeto_model->listarPorUsuario($this->session->userdata('codigo_usuario'));
        	$this->load->model('tarefa_model');
        	// envia tarefas por projeto, para os líderes, exibe todas as tarefas do usuário
        	$conteudo['tarefas_projeto'] = $this->tarefa_model->listar();
    	} 
		// META
		$this->header['meta'] = array(
			array(
			"name" => "title",
			"content" => "Página do Administrador - PROJETOS"
			),
			array(
			"name" => "description",
			"content" => "Projetos"
			),
			array(
			"name" => "keywords",
			"content" => "admin,demandou,demandas, html5, sistema"
			)
		);
		// CSS
		$this->header['css']=array(
			array('file' => 'estilos-principal.css'),
			// array('file' => 'iphone-style.css'),
			array('file' => 'animate.css'),
			// array('file' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'),
			array('file' => 'select2.min.css'),
			array('file' => 'estilos-projetos.css')
		); 
		// JS
		$data_footer['js']=array(
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js'), 
			// array('file' =>  base_url() . 'assets/js/jquery.mobile.custom.min.js'),
			array('file' =>  base_url() . 'assets/js/jquery.ajaxfileupload.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/admin.js'),
			// array('file' =>  base_url() . 'assets/js/jquery-2.1.4.js'),
			array('file' =>  base_url() . 'assets/js/projetos.js')
		);
		$this->load->view('header_view',$this->header);
		$this->load->view('admin/projetos/content_view', $conteudo);
		$this->load->view('footer_view',$data_footer);	
	}
	
	public function adicionar() {
		// META
		$this->header['meta'] = array(
			array(
			"name" => "title",
			"content" => "Adicionar Projeto"
			),
			array(
			"name" => "description",
			"content" => "Adicionar Projeto"
			),
			array(
			"name" => "keywords",
			"content" => "admin,demandou,demandas, html5, sistema"
			)
		);

		// CSS
		$this->header['css']=array(
			array('file' => 'estilos-principal.css'),
			array('file' => 'estilos-projetos-adicionar.css'),
			array('file' => 'select2.min.css')
			); 
		
		// CONTEUDO
		$this->load->model('usuario_model');
		$data_content['usuarios'] = $this->usuario_model->listarAux();

		// JS
		$data_footer['js']=array(
			//array('file' => 'http://code.jquery.com/ui/1.11.4/jquery-ui.js'), 
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/projetos_adicionar.js')
		);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->view('header_view',$this->header);
		
		if ($this->form_validation->run() == FALSE) {
			//echo "inválido";
			$this->load->view('admin/projetos/content_adicionar_view', $data_content);
		} else {
			// echo "válido";
			$projeto = $this->input->post();
			// echo "<pre>";
			// var_dump($projeto);
			// echo "</pre>";
			$this->load->model('projeto_model');
			$data['codigo_projeto'] = $this->projeto_model->inserir($projeto);
			if ($data['codigo_projeto']!==false) {
				$data['projeto'] = $projeto;
				$this->load->view('admin/projetos/adicionar_sucesso_view.php', $data);
			} else {
				echo "Oops, deu bug. Tente novamente? =]";
			}
		}
		$this->load->view('footer_view',$data_footer);	
	}

	public function alterar() {
		// META
		$this->header['meta'] = array(
			array(
			"name" => "title",
			"content" => "Adicionar Projeto"
			),
			array(
			"name" => "description",
			"content" => "Adicionar Projeto"
			),
			array(
			"name" => "keywords",
			"content" => "admin,demandou,demandas, html5, sistema"
			)
		);

		// CSS
		$this->header['css']=array(
			array('file' => 'estilos-principal.css'),
			array('file' => 'estilos-projetos-adicionar.css'),
			array('file' => 'select2.min.css')
			); 
		
		// CONTEUDO
		// codigo projeto
		$cp = $this->uri->segment(3);
		$this->load->model('usuario_model');
		$this->load->model('projeto_model');
		$data_content['usuarios'] = $this->usuario_model->listarAux();
		$data_content['lider'] = $this->projeto_model->listarLider($cp);
		$data_content['participantes'] = $this->projeto_model->listarParticipantes($cp);
		$data_content['projeto'] = $this->projeto_model->verPorCodigo($cp);

		// JS
		$data_footer['js']=array(
			//array('file' => 'http://code.jquery.com/ui/1.11.4/jquery-ui.js'), 
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/projetos_alterar.js')
		);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->view('header_view',$this->header);
		
		if ($this->form_validation->run() == FALSE) {
			//echo "inválido";
			$this->load->view('admin/projetos/content_edit_view', $data_content);
		} else {
			// echo "válido";
			$projeto = $this->input->post();
			// echo "<pre>";
			// var_dump($projeto);
			// echo "</pre>";
			$this->load->model('projeto_model');
			// $data['codigo_projeto'] = $this->projeto_model->inserir($projeto);
			if ($this->projeto_model->alterar($projeto)) {
				$data['projeto'] = $projeto;
				$this->load->view('admin/projetos/alterar_sucesso_view.php', $data);
			} else {
				echo "Oops, deu bug. Tente novamente? =]";
			}
		}
		$this->load->view('footer_view',$data_footer);	
	}

	public function json_projectusers() {
  	$codigo_projeto = $this->input->post('codigo_projeto');
  	$this->load->model('projeto_model');
  	$data['participantes'] = $this->projeto_model->listarTodosParticipantes($codigo_projeto);
  	echo json_encode($data['participantes']);
  }

}
