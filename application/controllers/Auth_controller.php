<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_controller extends MY_Controller {

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

	public function index()	{
		
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
					$resultado['codigo_usuario'] = $usuario['codigo'];
					$resultado['login'] = $usuario['login'];
					$resultado['nome'] = $usuario['nome'];
					$resultado['sobrenome'] = $usuario['sobrenome'];
					$resultado['codigo_perfil'] = $usuario['codigo_perfil'];
					$resultado['codigo_status'] = $usuario['codigo_status'];
					$resultado['arquivo_avatar'] = $usuario['arquivo_avatar'];
					array_push($res, $resultado);
				endforeach;
				// loga, cria session
				$this->session->set_userdata( array(
					'codigo_usuario'=> $resultado['codigo_usuario'],
		            'login'=> $resultado['login'],
		            'nome'=> $resultado['nome'],
		            'sobrenome'=>$resultado['sobrenome'],
		            'codigo_perfil'=>$resultado['codigo_perfil'],
		            'codigo_status'=>$resultado['codigo_status'],
		            'arquivo_avatar'=>$resultado['arquivo_avatar'],
		            'logado' => true
		        ));
				// $this->load->library('ci_pusher');
				$pusher = $this->ci_pusher->get_pusher();
				$pusher->trigger('geral', 'login', $resultado);
        echo json_encode($resultado);
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