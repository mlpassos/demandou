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

    $this->load->library('email', $this->config->load('email'));

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

  function sendMail($projectInfo, $lideresInfo, $participantesInfo) {
		$ano = date("Y",strtotime($projectInfo[0]['data_inicio']));
    $mes = date("M",strtotime($projectInfo[0]['data_inicio']));
    $dia = date("d",strtotime($projectInfo[0]['data_inicio']));

    $anop = date("Y",strtotime($projectInfo[0]['data_prazo']));
    $mesp = date("M",strtotime($projectInfo[0]['data_prazo']));
    $diap = date("d",strtotime($projectInfo[0]['data_prazo']));
    // instancia o objeto
    $data_inicio = $dia . ' de ' . $mes . ' de ' . $ano;
    $data_prazo = $diap . ' de ' . $mesp . ' de ' . $anop;

    switch ($projectInfo[0]['prioridade']) {
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
    $timestamp = strtotime($projectInfo[0]['data_prazo']);
    $now = time();
    
   //  foreach($lideresInfo as $l) {
			// $messageLider = 'Olá ' . $l['nome'] . ' ' . $l['sobrenome'] . ','
			// 		// . '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">'
			// 		. '<div style="margin-top:10px;padding:5px;background-color:#ededed;">'
			// 		. '<div style="background-color:#fff;">'
	  //     	. '<h3 style="color:rgb(51,51,51);padding:5px;background-color:' . $prioridadesClass . ';">' . $projectInfo[0]['titulo'] . '</h3>'
	  //     	. '<img style="float:right;width:38px;height:38px;border-radius:50%;" alt="imagem do usuário" src="http://secom.pa.gov.br/demandou/uploads/' . $l['arquivo_avatar'] . '">'
	  //     	. '<p style="color:rgb(51,51,51)">'
	  //     	. $projectInfo[0]['descricao'] 
	  //     	. '</p>'
	  //     	// . '<p style="color:rgb(51,51,51)">'
	  //     	. '<p>'
	  //     	. '<img style="margin-right:5px;margin-bottom:-3px;" src="http://darx.premiumcoding.com/bar/css/images/meta-date-icon.png" alt="icone data inicio">'
	  //     	. '<span style="padding:5px;color:rgb(51,51,51);background-color:#d9edf7;border-radius:4px;">'
	  //     	. $data_inicio
	  //     	. '</span>'
	  //     	// . '</p>'
	  //     	// . '<p style="color:rgb(51,51,51)">'
	  //     	. '<img style="margin-bottom:-3px;margin-left:5px;" src="http://www.coventry.ac.uk/Templates/PrimarySite/UI/img/ResearchSection/content-icon-event.png" alt="icon data prazo">'
	  //     	. '<span style="padding:5px;color:rgb(240,240,240);margin-left:5px;background-color:#FF4332;border-radius:4px;">'
	  //     	. $data_prazo . ' (' . timespan($now, $timestamp) . ')'
	  //     	. '</span>'
	  //     	. '</p>'
	  //     	. '<p style="color:rgb(51,51,51)">'
	  //     	. 'Adicionado por: <img style="width:38px;height:38px;border-radius:50%;" src="http://secom.pa.gov.br/demandou/uploads/' . $this->session->userdata('arquivo_avatar') . '"> '
	  //     	. $this->session->userdata('nome')
	  //     	. '</p>'
	  //     	. '</div>'
	  //     	. '</div>';
		 //  $this->email->set_newline("\r\n");
	  //   $this->email->from('marciopassosbel@gmail.com'); // change it to yours
	  //   $this->email->to($l['email']);// change it to yours
	  //   $this->email->subject('Demandou: Novo Projeto');
	  //   $this->email->message($messageLider);
	  //   $this->email->send(); 
	  // }
	  //foreach($participantesInfo as $p) {
			// $messageParticipantes = 'Olá, '// . $p['nome'] . ' ' . $p['sobrenome'] . ','
					// . '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">'
			$messageParticipantes = '<div style="margin-top:10px;padding:5px;background-color:#ededed;">'
					. '<div style="background-color:#fff;">'
	      	. '<h3 style="color:rgb(51,51,51);padding:5px;background-color:' . $prioridadesClass . ';">' . $projectInfo[0]['titulo'] . '</h3>';
			$resParticipantes = array();	
	    foreach($participantesInfo as $p) {
	    	$messageParticipantes .= '<img style="margin-right:5px;float:right;width:38px;height:38px;border-radius:50%;" alt="imagem do usuário" src="http://secom.pa.gov.br/demandou/uploads/' . $p['arquivo_avatar'] . '">';
	    	array_push($resParticipantes, $p['email']);
	    }
	    // var_dump($lideresInfo);
	    foreach($lideresInfo as $l) {
	    	$messageParticipantes .= '<img style="margin-right:5px;border:2px solid #FFD700;float:right;width:38px;height:38px;border-radius:50%;" alt="imagem do usuário" src="http://secom.pa.gov.br/demandou/uploads/' . $l['arquivo_avatar'] . '">';
	    	// se líder diferente do usuário atual, guarda email para enviar notificação
	    	// echo 'c: ' . $l['codigo'] . '<br>';
	    	// echo 'cc: ' .$this->session->userdata('codigo_usuario');
	    	if ( (int)$l['codigo'] == (int)$this->session->userdata('codigo_usuario') ) {
	    		// faz nada
	    	} else {
	    		array_push($resParticipantes, $l['email']);
	    	}
	    	// echo $this->session->userdata('codigo_usuario');
	    }  	
	    $messageParticipantes .= '<p style="padding:5px;color:rgb(51,51,51);">'
	      	. $projectInfo[0]['descricao'] 
	      	. '</p>'
	      	// . '<p style="color:rgb(51,51,51)">'
	      	. '<p style="padding:5px;">'
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
	      	. '<p style="padding:5px;color:rgb(51,51,51)">'
	      	. 'Adicionado por: <img style="width:38px;height:38px;border-radius:50%;" src="http://secom.pa.gov.br/demandou/uploads/' . $this->session->userdata('arquivo_avatar') . '"> '
	      	. $this->session->userdata('nome')
	      	. '</p>'
	      	. '</div>'
	      	. '</div>';
		 	$this->email->set_newline("\r\n");
	    $this->email->from('marciopassosbel@gmail.com', 'Demandou'); // change it to yours
	    $this->email->to($resParticipantes);// change it to yours
	    $this->email->subject('Demandou: Novo Projeto');
	    $this->email->message($messageParticipantes);
	    $this->email->send(); 
	    // var_dump($resParticipantes);
	}	

	public function index()	{
		if( $this->session->userdata('logado') ) {
			$this->load->model('projeto_model');
        	$conteudo['projetos'] = $this->projeto_model->listarPorUsuario($this->session->userdata('codigo_usuario'));
        	$conteudo['projetos_usuarios'] = $this->projeto_model->listarParticipantesGerais();
        	$this->load->model('tarefa_model');
        	// envia tarefas por projeto, para os líderes, exibe todas as tarefas do usuário
        	$conteudo['tarefas_projeto'] = $this->tarefa_model->listar();
    	} 
		// META
		$this->header['meta'] = array(
			array(
			"name" => "title",
			"content" => "Projetos"
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
			array('file' => 'hover.css'),
			array('file' => 'animate.css'),
			// array('file' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'),
			array('file' => 'select2.min.css'),
			array('file' => 'estilos-projetos.css')
		); 
		// JS
		$data_footer['js']=array(
			// array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js'), 
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js'),
			array('file' => 'http://cdn.tinymce.com/4/tinymce.min.js'),
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
			// array('file' =>  base_url() . 'assets/js/jquery.mobile.custom.min.js'),
			// array('file' =>  base_url() . 'assets/js/jquery.ajaxfileupload.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/admin.js'),
			// array('file' =>  base_url() . 'assets/js/jquery-2.1.4.js'),
			array('file' =>  base_url() . 'assets/js/projetos.js')
		);
		if (!$this->input->is_ajax_request()) {
		  	$this->load->view('header_view',$this->header);
			$this->load->view('admin/projetos/content_view', $conteudo);
			$this->load->view('footer_view',$data_footer);	
		} else {
			$this->load->view('admin/projetos/content_view', $conteudo);	
		}
		// $this->load->view('header_view',$this->header);
		// $this->load->view('admin/projetos/content_view', $conteudo);
		// $this->load->view('footer_view',$data_footer);	
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
		// excluir líderes do projeto deste query
		$data_content['usuarios'] = $this->usuario_model->listarAux();

		// JS
		$data_footer['js']=array(
			//array('file' => 'http://code.jquery.com/ui/1.11.4/jquery-ui.js'), 
			array('file' => 'http://cdn.tinymce.com/4/tinymce.min.js'),
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/projetos_adicionar.js')
		);

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->view('header_view',$this->header);
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/projetos/content_adicionar_view', $data_content);
		} else {
			$projeto = $this->input->post();
			
			// $this->load->model('usuario_model');
			// $participantesInfo = $this->usuario_model->listarPorCodigos($projeto['participantes']);
			// $lideresInfo = $this->usuario_model->listarPorCodigos($projeto['lider']);
			// $projectInfo = $projeto;

			// echo "<pre>";
			// 	var_dump($participantesInfo);
			// echo "</pre>";
			// echo "<pre>";
			// 	var_dump($lideresInfo);
			// echo "</pre>";
			// echo "<pre>";
			// 	var_dump($projectInfo);
			// echo "</pre>";

			$this->load->model('projeto_model');
			$codigo_projeto = $this->projeto_model->inserir($projeto);
			if ($codigo_projeto!==false) {
				$this->load->model('usuario_model');
				$participantesInfo = $this->usuario_model->listarPorCodigos($projeto['participantes']);
				$lideresInfo = $this->usuario_model->listarPorCodigo($projeto['lider']);
				$projectInfo = $this->projeto_model->verPorCodigo($codigo_projeto);
				$data['projeto'] = $projectInfo;
				$this->sendMail($projectInfo,$lideresInfo,$participantesInfo);
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
			"content" => "Alterar Projeto"
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
		// if ($this->uri->segment(3,$this->input->post('codigo'))) {
		// 	$cp = $this->uri->segment(3);
		// } else {
		// 	$cp = $this->input->post('codigo');
		// }
		$cp = $this->uri->segment(3,$this->input->post('codigo'));
		// echo 'cp: ' . $cp;

		$this->load->model('usuario_model');
		$this->load->model('projeto_model');
		$data_content['usuarios'] = $this->usuario_model->listarAux();
		$data_content['lider'] = $this->projeto_model->listarLider($cp);
		$data_content['participantes'] = $this->projeto_model->listarParticipantes($cp);
		$data_content['projeto'] = $this->projeto_model->verPorCodigo($cp);

		// JS
		$data_footer['js']=array(
			//array('file' => 'http://code.jquery.com/ui/1.11.4/jquery-ui.js'), 
			array('file' =>  'http://cdn.tinymce.com/4/tinymce.min.js'),
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js'),
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/projetos_alterar.js')
		);

		$this->load->helper('form');
		$this->load->library('form_validation');

		// $this->load->view('header_view',$this->header);
		
		if ($this->form_validation->run() == FALSE) {
			//echo "inválido";
			$this->load->view('header_view',$this->header);
			$this->load->view('admin/projetos/content_edit_view', $data_content);
			$this->load->view('footer_view',$data_footer);	
		} else {
			// echo "válido";
			$projeto = $this->input->post();
			
			//var_dump($projeto);
			
			$this->load->model('projeto_model');

			if ($this->projeto_model->alterar($projeto)) {
				// $data['projeto'] = $projeto;
				// $this->load->view('admin/projetos/alterar_sucesso_view.php', $data);
				redirect(base_url('/projetos'),'refresh');

			} else {
				echo "Oops, deu bug. Tente novamente? =]";
			}
		}
		// $this->load->view('footer_view',$data_footer);	
	}

	public function json_projectusers() {
  	$codigo_projeto = $this->input->post('codigo_projeto');
  	$this->load->model('projeto_model');
  	$data['participantes'] = $this->projeto_model->listarTodosParticipantes($codigo_projeto);
  	echo json_encode($data['participantes']);
  }

  public function json_projectend() {
  	$codigo_projeto = $this->input->post('codigo_projeto');
  	$this->load->model('projeto_model');
  	$data['resposta'] = $this->projeto_model->encerrarProjeto($codigo_projeto);
  	if ($data['resposta']==true) {
  		echo json_encode(array("status"=>"sucesso", "mensagem"=>"Projeto encerrado com sucesso."));	
  	} else {
  		echo json_encode(array("status"=>"falha", "mensagem"=>"Deu bug, tentar novamente."));
  	}
  }

}
