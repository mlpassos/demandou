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

		$this->load->library('email', $this->config->load('email'));
    $this->ativo = $this->uri->segment(1);

    if ( (int) $this->session->userdata('codigo_perfil')==2 ) {
    	$this->header['menu'] = array(
        		array(
							"name" => "Projetos",
							"link" => base_url() . 'projetos',
							"class" => ""
						),
						array(
							"name" => "Tarefas",
							"link" => base_url() . 'tarefas',
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
							"class" => ""
						),
						array(
						"name" => "Tarefas",
						"link" => base_url() . 'tarefas',
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
			$this->load->model('tarefa_model');
      $conteudo['tarefas'] = $this->tarefa_model->listar();
        	// $conteudo['projetos_usuarios'] = $this->projeto_model->listarParticipantesGerais();
        	// $this->load->model('tarefa_model');
        	// envia tarefas por projeto, para os líderes, exibe todas as tarefas do usuário
        	// $conteudo['tarefas_projeto'] = $this->tarefa_model->listar();
    } 
		// META
		$this->header['meta'] = array(
			array(
			"name" => "title",
			"content" => "Tarefas"
			),
			array(
			"name" => "description",
			"content" => "Tarefas"
			),
			array(
			"name" => "keywords",
			"content" => "admin,demandou,demandas, html5, sistema"
			)
		);
		// CSS
		$this->header['css']=array(
			array('file' => 'estilos-principal.css'),
			array('file' => 'hover.css'),
			array('file' => 'animate.css'),
			// array('file' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'),
			array('file' => 'select2.min.css'),
			// array('file' => 'estilos-projetos.css')
			array('file' => 'estilos-tarefas.css')
		); 
		// JS
		$data_footer['js']=array(
			// array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js'), 
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js'),
			array('file' =>  base_url() . 'assets/js/isotopeSearchFilter.jquery.js'),
			array('file' => 'http://cdn.tinymce.com/4/tinymce.min.js'),
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
			// array('file' =>  base_url() . 'assets/js/jquery.mobile.custom.min.js'),
			// array('file' =>  base_url() . 'assets/js/jquery.ajaxfileupload.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/admin.js'),
			// array('file' =>  base_url() . 'assets/js/jquery-2.1.4.js'),
			array('file' =>  base_url() . 'assets/js/tarefas.js')
		);
		if (!$this->input->is_ajax_request()) {
		  	$this->load->view('header_view',$this->header);
			$this->load->view('admin/tarefas/content_view', $conteudo);
			$this->load->view('footer_view',$data_footer);	
		} else {
			$this->load->view('admin/tarefas/content_view', $conteudo);	
		}
		// $this->load->view('header_view',$this->header);
		// $this->load->view('admin/projetos/content_view', $conteudo);
		// $this->load->view('footer_view',$data_footer);	
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
  		if ($this->session->userdata('codigo_usuario') == $this->input->post('codigo_usuario')) {
  			// nao eh forçada
  			$usuario = $this->input->post('codigo_usuario');
    		if ($atrasado==1) {
    			// obs do tipo extensão de prazo, pois está atrasada
    			$codigo_tipo = 2;
    		} else {
    			// obs do tipo finalização normal
    			$codigo_tipo = 1;
    		}
  		} else {
  			// o líder não é o dono da tarefa - forcado
  			$usuario = $this->session->userdata('codigo_usuario');	
  			$codigo_tipo = 3;
  		}
  		
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
		if ($this->input->is_ajax_request()) {
			// ajax
			// $result = array("status" => "sucesso", "mensagem" => "Tarefa criada com sucesso");
			// echo json_encode($result);
			$this->load->helper('form');
			$this->load->library('form_validation');

			if ($this->form_validation->run() == FALSE) {
				$result = array("status" => "erro", "mensagem" => validation_errors());
				echo json_encode($result);
			} else {
				$tarefa = $this->input->post();
				$this->load->model('tarefa_model');
				if ($this->tarefa_model->inserir($tarefa)) {
					$result = array("status" => "sucesso", "mensagem" => "Tarefa criada com sucesso", "tarefa"=>$tarefa);
					// email líder tarefa atualizada
					$this->load->model('usuario_model');
					$this->load->model('projeto_model');
					$userInfo = $this->usuario_model->listarPorCodigo($tarefa['lider'][0]);
					$projectInfo = $this->projeto_model->verPorCodigo($tarefa['codigo_projeto']);
					$this->sendMail($tarefa, $userInfo, $projectInfo);
				} else {
					$result = array("status" => "erro", "mensagem" => "Deu bug", "tarefa"=>$tarefa);
				}
				echo json_encode($result);
			}
		} else {
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
					array('file' =>  'http://cdn.tinymce.com/4/tinymce.min.js'),
					array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
					array('file' =>  base_url() . 'assets/js/global.js'),
					array('file' =>  base_url() . 'assets/js/tarefas_adicionar.js')
				);
				$this->load->helper('form');
				$this->load->library('form_validation');

				$this->load->view('header_view',$this->header);
				
				if ($this->form_validation->run() == FALSE) {
						$this->load->view('admin/tarefas/content_adicionar_view', $data_content);
				} else {
					$tarefa = $this->input->post();
					// $tarefa['codigo_usuario']
					// echo "<pre>";
					// var_dump($tarefa);
					// echo "</pre>";
					// $this->output->enable_profiler(TRUE);
					// $this->config->load('email');
					$this->load->model('tarefa_model');
					// $this->load->model('usuario_model');
					// $userInfo = $this->usuario_model->listarPorCodigo($tarefa['lider']);
					// $projectInfo = $this->projeto_model->verPorCodigo($codigo_projeto);
					// echo "<pre>";
					// 	echo $projectInfo[0]['titulo'];
					// echo "</pre>";
					if ($this->tarefa_model->inserir($tarefa)) {
						$dadosenviar = array('codigo_projeto'=>$tarefa['codigo_projeto']);
						$this->session->set_flashdata('adicionar_ao_projeto',$dadosenviar);
						$this->load->model('usuario_model');
						$this->load->model('projeto_model');
						$userInfo = $this->usuario_model->listarPorCodigo($tarefa['lider']);
						$projectInfo = $this->projeto_model->verPorCodigo($codigo_projeto);
						$this->sendMail($tarefa, $userInfo, $projectInfo);
						redirect(base_url() . 'tarefa/adicionar');
					} else {
						echo "Oops, deu bug. Tente novamente? =]";
					}
				}
				$this->load->view('footer_view',$data_footer);	
		}
	}

	function sendMail($t, $u, $p) {
		$ano = date("Y",strtotime($t['data_inicio']));
    $mes = date("M",strtotime($t['data_inicio']));
    $dia = date("d",strtotime($t['data_inicio']));

    $anop = date("Y",strtotime($t['data_prazo']));
    $mesp = date("M",strtotime($t['data_prazo']));
    $diap = date("d",strtotime($t['data_prazo']));
    // instancia o objeto
    $data_inicio = $dia . ' de ' . $mes . ' de ' . $ano;
    $data_prazo = $diap . ' de ' . $mesp . ' de ' . $anop;

    switch ($t['prioridade']) {
    		case '3':
    			$prioridadesClass = '#ff4332';
    			break;
    		case '2':
    			$prioridadesClass = '#ffbe1c';
    			break;
    		case '1':
    			$prioridadesClass = '#77b50e';
    			break;
    		default:
    			$prioridadesClass = 'white';
    			break;
    	}
		// timespan($now, $timestamp);
    $this->load->helper('date');
    $timestamp = strtotime($t['data_prazo']);
    $now = time();
		$message = 'Olá ' . $u[0]['nome'] . ' ' . $u[0]['sobrenome'] . ','
				// . '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">'
				. '<div style="margin-top:10px;padding:5px;background-color:#ededed;">'
				. '<div style="background-color:#fff;">'
      	. '<h3 style="color:rgb(51,51,51);padding:5px;background-color:' . $prioridadesClass . ';">' . $p[0]['titulo'] . ': ' . $t['titulo'] . '</h3>'
      	. '<img style="float:right;width:38px;height:38px;border-radius:50%;" alt="imagem do usuário" src="http://secom.pa.gov.br/demandou/uploads/' . $u[0]['arquivo_avatar'] . '">'
      	. '<p style="color:rgb(51,51,51)">'
      	. $t['descricao'] 
      	. '</p>'
      	// . '<p style="color:rgb(51,51,51)">'
      	. '<p>'
      	. '<img style="margin-right:5px;margin-bottom:-3px;" src="http://darx.premiumcoding.com/bar/css/images/meta-date-icon.png" alt="icone data inicio">'
      	. '<span style="padding:5px;color:rgb(51,51,51);background-color:#d9edf7;border-radius:4px;">'
      	. $data_inicio
      	. '</span>'
      	// . '</p>'
      	// . '<p style="color:rgb(51,51,51)">'
      	. '<img style="margin-bottom:-3px;margin-left:5px;" src="http://www.coventry.ac.uk/Templates/PrimarySite/UI/img/ResearchSection/content-icon-event.png" alt="icon data prazo">'
      	. '<span style="padding:5px;color:rgb(240,240,240);margin-left:5px;background-color:#FF4332;border-radius:4px;">'
      	. $data_prazo . ' (' . timespan($now, $timestamp) . ')'
      	. '</span>'
      	. '</p>'
      	. '<p style="color:rgb(51,51,51)">'
      	. 'Adicionado por: <img style="width:38px;height:38px;border-radius:50%;" src="http://secom.pa.gov.br/demandou/uploads/' . $this->session->userdata('arquivo_avatar') . '"> '
      	. $this->session->userdata('nome')
      	. '</p>'
      	. '</div>'
      	. '</div>';

    $this->email->set_newline("\r\n");
    $this->email->from('marciopassosbel@gmail.com'); // change it to yours
    $this->email->to($u[0]['email']);// change it to yours
    $this->email->subject('Demandou: Nova tarefa');
    $this->email->message($message);
    if (!$this->email->send()) {
	    	// erro
	  };
	}	

	public function alterar() {
		$this->load->helper('form');
		$this->load->library('form_validation');

		if ($this->form_validation->run() == FALSE) {
			$result = array("status" => "erro", "mensagem" => validation_errors());
			echo json_encode($result);
		} else {
			$tarefa = $this->input->post();
			$this->load->model('tarefa_model');
			if ($this->tarefa_model->alterar($tarefa)) {
				$result = array("status" => "sucesso", "mensagem" => "Alterado com sucesso");
				// email líder tarefa atualizada
				$this->load->model('usuario_model');
				$this->load->model('projeto_model');
				$userInfo = $this->usuario_model->listarPorCodigo($tarefa['lider'][0]);
				$projectInfo = $this->projeto_model->verPorCodigo($tarefa['codigo_projeto']);
				$this->sendMail($tarefa, $userInfo, $projectInfo);
			} else {
				$result = array("status" => "erro", "mensagem" => "Deu bug");
			}
			echo json_encode($result);
		}
	}
	public function json_taskdelete() {
  	$codigo_tarefa = $this->input->post('codigo_tarefa');
  	$this->load->model('tarefa_model');
  	$data['resposta'] = $this->tarefa_model->excluirTarefa($codigo_tarefa);
  	if ($data['resposta']==true) {
  		echo json_encode(array("status"=>"sucesso", "mensagem"=>"Tarefa excluída com sucesso."));	
  	} else {
  		echo json_encode(array("status"=>"falha", "mensagem"=>"Deu bug, tentar novamente."));
  	}
  }
  public function json_taskend() {
  	$codigo_tarefa = $this->input->post('codigo_tarefa');
  	$this->load->model('tarefa_model');
  	$data['resposta'] = $this->tarefa_model->encerrarTarefa($codigo_tarefa);
  	if ($data['resposta']==true) {
  		echo json_encode(array("status"=>"sucesso", "mensagem"=>"Tarefa desativada com sucesso."));	
  	} else {
  		echo json_encode(array("status"=>"falha", "mensagem"=>"Deu bug, tentar novamente."));
  	}
  }
}
