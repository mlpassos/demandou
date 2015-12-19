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
			"content" => "Demandou - User List"
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
		// CSS
		$data_header['css']=array(array('file' => 'estilos-principal.css')); 
		// JS
		$data_footer['js']=array(
			array('file' => 'http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js'), 
			array('file' =>  base_url() . '/assets/js/admin.js'),
			array('file' =>  base_url() . '/assets/js/usuarios.js')
		);

		$this->load->view('admin/usuarios/header_view',$data_header);
		$this->load->view('admin/usuarios/content_view',$conteudo);
		$this->load->view('admin/usuarios/footer_view',$data_footer);		
	}


	function do_upload()
	{
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

	public function adicionar() {
		$data['css']= "estilos-principal.css";
		
		if( $this->session->userdata('logado') ) {
        	$data['usuario'] = $this->session->userdata();
        	$this->load->model('funcao_model');
        	$this->load->model('perfil_model');
        	$auxiliar['funcao'] = $this->funcao_model->listar();
        	$auxiliar['perfil'] = $this->perfil_model->listar();
        	// pegar demandas de acordo com código do usuário
    	} else {
	         $data['usuario'] = array('logado'=>false);
	    }
		
		$this->load->view('admin/usuarios/header_view',$data);
		
		if (isset($auxiliar['funcao'])) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			if ($this->form_validation->run() == FALSE)
			{
				// se não é válido o formulário, recarrega página com mensagens de erro.
				$this->load->view('admin/usuarios/adicionar_view', $auxiliar);
			}
			else
			{
				$usuario = $this->input->post();
				// $foto = $this->do_upload();
				// echo "<pre>a";
				//  var_dump($foto);
				// echo "</pre>";
				$up = $this->do_upload();
				$data['upload_data'] = $this->upload->data();
				$usuario['arquivo_avatar'] = $this->upload->data('file_name');

				$config['image_library'] = 'gd2';
				$config['source_image']	= './uploads/' . $this->upload->data('file_name');
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width']	= 120;
				$config['height']	= 120;

				$this->load->library('image_lib', $config); 

				$this->image_lib->resize();
				// echo "<pre>";
				//   var_dump($usuario);
				// echo "</pre>";

				$this->load->model('usuario_model');
				// $this->usuario_model->inserir($usuario);
				if ($this->usuario_model->inserir($usuario)) {
					$data['nome'] = $usuario['nome'];
					$this->load->view('admin/usuarios/adicionar_sucesso_view.php', $data);
				} else {
					echo "Oops, deu bug. Tente novamente? =]";
				}
				// sucesso, cria usuário
				//$this->load->view('formsuccess');
			}
		} else {
			$this->load->view('admin/usuarios/adicionar_view');	
		}
		$this->load->view('admin/usuarios/footer_view');	
	}
	public function checar_login($login) {
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
	public function check_default($element) {
		// foreach($array /as $element) {
		// echo $element;
	    	if($element == 'escolha') {   
	      		return FALSE;
	    	} else { return true;}
	  // 	}
	 	// return TRUE;
	}
	public function autenticar() {
		$usuario = $this->input->post('usuario');
		$senha = $this->input->post('senha');
		// autenticar
		$this->load->model('usuario_model');
		if ($data['usuario'] = $this->usuario_model->listarPorUsuarioSenha($usuario,$senha)) {
				$res = array();
				$resultado = array();
				foreach($data['usuario'] as $usuario) :
					$resultado['login'] = $usuario['login'];
					$resultado['nome'] = $usuario['nome'];
					$resultado['sobrenome'] = $usuario['sobrenome'];
					$resultado['codigo_perfil'] = $usuario['codigo_perfil'];
					$resultado['codigo_status'] = $usuario['codigo_status'];
					array_push($res, $resultado);
				endforeach;
				// loga, cria session
				$this->session->set_userdata( array(
		            'login'=> $resultado['login'],
		            'nome'=> $resultado['nome'],
		            'sobrenome'=>$resultado['sobrenome'],
		            'codigo_perfil'=>$resultado['codigo_perfil'],
		            'codigo_status'=>$resultado['codigo_status'],
		            'logado' => true
		        ));

		        echo json_encode($resultado);
		        // echo json_encode('ok');

		} else {
			$this->session->set_userdata( array('logado' => false) );
			echo json_encode(array("status"=>"falha"));
		}

       // var_dump($resultado);
        // echo 'logado ' .  $this->session->userdata('usuario');
        //echo json_encode($this->session->userdata());
        //redirect('/welcome');
	}
	public function logout() {
		$usuario = $this->input->post('usuario');
		// destroi session
		$this->session->sess_destroy();
		echo "saiu";
		
	}
}
