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


    public function json_tarefas() {
    	$this->load->model('tarefa_model');
    	$data['tarefas'] = $this->tarefa_model->listar();
    	echo json_encode($data['tarefas']);

    }

	public function json_projecttasks() {
    	$codigo_projeto = $this->input->post('codigo_projeto');
    	$this->load->model('tarefa_model');
    	$data['tarefas'] = $this->tarefa_model->jsonTarefasPorProjeto($codigo_projeto);
    	echo json_encode($data['tarefas']);

    }

    public function json_tasksobs() {
    	$codigo_tarefa = $this->input->post('codigo_tarefa');
    	$this->load->model('tarefa_model');
    	$data['observacoes'] = $this->tarefa_model->jsonTarefasObservacoes($codigo_tarefa);
    	echo json_encode($data['observacoes']);
    }

    public function json_tasksrespostas() {
    	$codigo_observacao = $this->input->post('codigo_observacao');
    	$this->load->model('tarefa_model');
    	$data['respostas'] = $this->tarefa_model->jsonTarefasRespostas($codigo_observacao);
    	echo json_encode($data['respostas']);
    }


    public function responder() {
    	$codigo_tarefa = $this->input->post('codigo_tarefa');
    	$codigo_observacao = $this->input->post('codigo_observacao');
    	$resposta = $this->input->post('resposta');
    	$lider = $this->input->post('lider');
    	$tipo = $this->input->post('tipo');
    	if ( ($tipo == 2 ) OR ($tipo == 1) ) {
    		$extender = $this->input->post('extender');
    	} else {
    		$extender = null;
    	}
    	// $usuario = $this->session->userdata('codigo_usuario');	
    	
    	$this->load->model('tarefa_model');
    	
    	if ($data['resposta'] = $this->tarefa_model->responder($codigo_tarefa, $codigo_observacao,$resposta, $lider, $tipo, $extender)) {
    		echo json_encode(
    			array(
    				'status' => 'sucesso',
    				'mensagem' => 'Observação respondida com sucesso.'
    				)
    		);	
    	} else {
    		echo json_encode(
    			array(
    				'status'=>'falha',
    				'mensagem' => 'Ooops, deu bug. De novo? =]'
    			)
    		);
    	}
    }
    public function finalizar() {
    	$codigo_tarefa = $this->input->post('codigo_tarefa');
    	$observacao = $this->input->post('observacao');
    	$lider = $this->input->post('lider');
    	$atrasado = $this->input->post('atrasado');
    	// $arquivo_obs = $_FILES['file-0'];
    	if ($lider == 1) {
    		// quem finaliza é o lider, tarefa forçada tipo 3
    		$usuario = $this->session->userdata('codigo_usuario');	
    		$codigo_tipo = 3;
    	} else {
				// se não é o líder, só pode ser o usuário dono da tarefa
    		$usuario = $this->input->post('codigo_usuario');
    		if ($atrasado==1) {
    			// obs do tipo extensão de prazo, pois está atrasada
    			$codigo_tipo = 2;
    		} else {
    			// obs do tipo finalização normal
    			$codigo_tipo = 1;
    		}
    	}

    	$this->load->model('tarefa_model');
    	
    	if ($data['fim'] = $this->tarefa_model->finalizar($codigo_tarefa,$observacao,$codigo_tipo, $usuario)) {
    		echo json_encode(
    			array(
    				'status' => 'sucesso',
    				'mensagem' => 'Tarefa finalizada com sucesso. Observação enviada.'
    				)
    		);	
    	} else {
    		echo json_encode(
    			array(
    				'status'=>'falha',
    				'mensagem' => 'Ooops, deu bug. De novo? =]'
    			)
    		);
    	}
    	
    }



	public function adicionar() {
		$cp = $this->uri->segment(3);
		// echo $codigo_projeto;
		if ($this->session->flashdata('adicionar_ao_projeto') === NULL) {
			// fechar essa session depois
			$dadosflash = $this->session->userdata('gerenciar_tarefas-' . $cp);	
		} else {
			$dadosflash = $this->session->flashdata('adicionar_ao_projeto');	
			$this->session->keep_flashdata('adicionar_ao_projeto');
		}

		$codigo_projeto = $dadosflash['codigo_projeto'];
		
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
				// $this->output->enable_profiler(TRUE);
				$this->load->view('admin/tarefas/content_adicionar_view', $data_content);
			// }
		} else {
			// echo "válido";
			$tarefa = $this->input->post();
			// $tarefa['codigo_usuario']
			// echo "<pre>";
			// var_dump($tarefa);
			// echo "</pre>";
			// $this->output->enable_profiler(TRUE);
			$this->load->model('tarefa_model');
			if ($this->tarefa_model->inserir($tarefa)) {
				$dadosenviar = array('codigo_projeto'=>$tarefa['codigo_projeto']);
				$this->session->set_flashdata('adicionar_ao_projeto',$dadosenviar);
				redirect(base_url() . 'tarefa/adicionar');
			} else {
				echo "Oops, deu bug. Tente novamente? =]";
			}
		}
		$this->load->view('footer_view',$data_footer);	
	}
}
