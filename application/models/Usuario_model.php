<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

        public $codigo;
        public $login;
        public $senha;
        public $nome;
        public $sobrenome;
        public $email;
        public $data_criado;
        public $data_nascimento;
        public $arquivo_avatar;
        public $codigo_funcao;
        public $codigo_perfil;
        public $codigo_status;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function inserir($usuario)
        {
                // hack pra converter data do input html5 no formato mysql
                $ano = date("Y",strtotime($usuario['data_nascimento']));
                $mes = date("m",strtotime($usuario['data_nascimento']));
                $dia = date("d",strtotime($usuario['data_nascimento']));
                // instancia o objeto
                $this->codigo = NULL;
                $this->login = $usuario['login'];
                $this->senha = $usuario['senha'];
                $this->nome = $usuario['nome'];
                $this->sobrenome = $usuario['sobrenome'];
                $this->email = $usuario['email'];
                $this->data_nascimento = $ano . '-' . $mes . '-' . $dia;
                $this->arquivo_avatar = $usuario['arquivo_avatar'];
                $this->data_criado = date('Y-m-d', time());
                $this->codigo_funcao = (int) $usuario['codigo_funcao'];
                $this->codigo_perfil = (int) $usuario['codigo_perfil'];
                // usuário ativo
                $this->codigo_status = 1;
                // echo "<pre>";
                //   var_dump($this);
                // echo "</pre>";
                if ($this->db->insert('usuario', $this)) {
                  $inserido = $this->db->insert_id();
                  return true;//<br>Código: " . $inserido;
                } else {
                  return false;      
                }
        }

        public function alterar($codigo)
        {
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
        }

        public function excluir($codigo)
        {
                $this->db->where('codigo', $codigo);
                return $this->db->delete('tb_livro');
        }
        public function listar()
        {
                $this->db->select('*');
                $this->db->from('usuario');
                $this->db->join('usuario_funcao', 'usuario_funcao.codigo = usuario.codigo_funcao');
                $query = $this->db->get();
                return $query->result_array();
        }
        public function listarAux()
        {
                $this->db->select('codigo, nome, sobrenome, arquivo_avatar');
                $this->db->from('usuario');
                $query = $this->db->get();
                return $query->result_array();
        }
        public function listarPorUsuarioSenha($usuario,$senha)
        {
                $senha = MD5($senha);
                $this->db->where('login', $usuario);
                $this->db->where('senha', $senha);
                $query = $this->db->get('usuario');
                return $query->result_array();              
        }
        public function listarPorUsuario($usuario)
        {
                $this->db->where('login', $usuario);
                $query = $this->db->get('usuario');
                return $query->result_array();              
        }

}