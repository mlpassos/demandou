<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_controller extends MY_Controller {

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
		if( $this->session->userdata('logado') ) {
			$this->load->model('usuario_model');
        	$conteudo['usuarios'] = $this->usuario_model->listar();
    	} 
	    // META
		$data_header['meta']=array(
			array(
			"name" => "title",
			"content" => "Administrar Usuários"
			),
			array(
			"name" => "description",
			"content" => "Sistema para gerenciamento de Demandas"
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
				"name" => "Usuários",
				"link" => base_url() . 'usuarios',
				"class" => "active"
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
			array('file' => 'estilos-usuarios.css')
		); 
		// JS
		$data_footer['js']=array(
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js'), 
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/admin.js'),
			array('file' =>  base_url() . 'assets/js/usuarios.js')
		);

		$this->load->view('header_view',$data_header);
		$this->load->view('admin/usuarios/content_view',$conteudo);
		$this->load->view('footer_view',$data_footer);		
	}

	public function adicionar() {
		// META
		$data_header['meta']=array(
			array(
			"name" => "title",
			"content" => "Adicionar Usuário"
			),
			array(
			"name" => "description",
			"content" => "Adicionar usuário..."
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
				"name" => "Usuários",
				"link" => base_url() . 'usuarios',
				"class" => "active"
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
			array('file' => 'estilos-usuarios-adicionar.css')
			); 
		// JS
		$data_footer['js']=array(
			array('file' =>  base_url() . 'assets/js/global.js'),
			array('file' =>  base_url() . 'assets/js/admin.js'),
			array('file' =>  base_url() . 'assets/js/usuarios_adicionar.js')
		);
		
		// load data for user form
		// if( $this->session->userdata('logado') ) {
		$this->load->helper('form');
		$this->load->library('form_validation');
			
        $this->load->model('funcao_model');
        $this->load->model('perfil_model');
        $auxiliar['funcao'] = $this->funcao_model->listar();
        $auxiliar['perfil'] = $this->perfil_model->listar();
    	// }
    	
		$this->load->view('header_view',$data_header);
		
		// if( $this->session->userdata('logado') ) {
		if ($this->form_validation->run() == FALSE) {
			// se não é válido o formulário, recarrega página com mensagens de erro.
			$this->load->view('admin/usuarios/adicionar_view', $auxiliar);
		}
		else {
			$usuario = $this->input->post();

			$up = $this->do_upload();
			$data['upload_data'] = $this->upload->data();
			$usuario['arquivo_avatar'] = $this->upload->data('file_name');

			// scale image to thumbnail size 120x120
			$config['image_library'] = 'gd2';
			$config['source_image']	= './uploads/' . $this->upload->data('file_name');
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	= 120;
			$config['height']	= 120;

			$this->load->library('image_lib', $config); 
			$this->image_lib->resize();

			// add user to database
			$this->load->model('usuario_model');
			if ($this->usuario_model->inserir($usuario)) {
				$data['nome'] = $usuario['nome'];
				$this->load->view('admin/usuarios/adicionar_sucesso_view.php', $data);
			} else {
				echo "Oops, deu bug. Tente novamente? =]";
			}
		}
		// } else {
			// não está logado
		// 	$this->load->view('admin/usuarios/adicionar_view');	
		// }
		$this->load->view('footer_view', $data_footer);	
	}
	function checar_login($login) {
		//$usuario = "mpassos";
		$this->load->model('usuario_model');
		$realuser = $this->usuario_model->listarPorUsuario($login);

		if (sizeof($realuser)==1)
		{
			$this->form_validation->set_message('checar_login', 'O %s já existe, escolha outro.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function check_default($element) {
		// foreach($array /as $element) {
		// echo $element;
	    	if($element == 'escolha') {   
	      		return FALSE;
	    	} else { return true;}
	  // 	}
	 	// return TRUE;
	}
	function do_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			return $error;
			// $this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $data;
			// $this->load->view('upload_success', $data);
		}
	}
}