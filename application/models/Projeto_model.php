<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto_model extends CI_Model {

        public $codigo;
        public $titulo;
        public $descricao;
        public $prioridade;
        public $data_inicio;
        public $data_prazo;
        public $data_fim;
        public $criado_por;
        public $codigo_status;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function inserir($projeto) {
                // hack pra converter data do input html5 no formato mysql
                $ano = date("Y",strtotime($projeto['data_inicio']));
                $mes = date("m",strtotime($projeto['data_inicio']));
                $dia = date("d",strtotime($projeto['data_inicio']));

                $anop = date("Y",strtotime($projeto['data_prazo']));
                $mesp = date("m",strtotime($projeto['data_prazo']));
                $diap = date("d",strtotime($projeto['data_prazo']));
                // instancia o objeto
                $this->codigo = NULL;
                $this->titulo = $projeto['titulo'];
                $this->descricao = $projeto['descricao'];
                $this->prioridade = $projeto['prioridade'];
   
                $this->data_inicio = $ano . '-' . $mes . '-' . $dia;
                $this->data_prazo = $anop . '-' . $mesp . '-' . $diap;
                $this->data_fim = NULL;

                $this->criado_por = $this->session->userdata('codigo_usuario');

                // usuário ativo
                $this->codigo_status = 1;
                // echo "<pre>";
                //   var_dump($this);
                // echo "</pre>";
                if ($this->db->insert('projeto', $this)) {
                  $inserido = $this->db->insert_id();
                  // atribuir usuários
                  $lider =  $this->input->post('lider');
                  $participantes = $this->input->post('participantes');
                  $obj = array(
                    "codigo_usuario" => $lider,
                    "codigo_projeto" => $inserido,
                    "codigo_papel" => 1
                    );
                  //var_dump($inserido);
                  $this->db->insert('usuario_projeto', $obj);

                  foreach($participantes as $p) {
                    $obj_p = array(
                    "codigo_usuario" => $p,
                    "codigo_projeto" => $inserido,
                    "codigo_papel" => 2
                    );
                    if ($this->db->insert('usuario_projeto', $obj_p)) {
                        //echo "Inserido: " . $obj_p['codigo_usuario'] . "<br>";
                    }
                  }
                  return $inserido;//<br>Código: " . $inserido;
                } else {
                  return false;      
                }
        }

        public function alterar($codigo) {
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
        }

        public function excluir($codigo) {
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
        public function listarPorUsuario($codigo_usuario)
        {
                // $this->db->select('codigo, nome, sobrenome, arquivo_avatar');
<<<<<<< HEAD
                // $this->output->enable_profiler(TRUE);
                $this->db->from('projeto');
                $this->db->join('usuario_projeto', 'projeto.codigo=usuario_projeto.codigo_projeto');
                $this->db->join('usuario', 'usuario_projeto.codigo_usuario=usuario.codigo');
                $this->db->where('usuario_projeto.codigo_usuario', $codigo_usuario);
                $this->db->order_by('projeto.data_inicio', 'DESC');
=======
                $this->db->from('projeto');
                $this->db->join('usuario_projeto', 'projeto.codigo=usuario_projeto.codigo_projeto');
                $this->db->join('usuario', 'usuario_projeto.codigo_usuario=usuario.codigo');
                $this->db->where('usuario.codigo', $codigo_usuario);
>>>>>>> origin/master
                $query = $this->db->get();
                return $query->result_array();
        }
        public function listarPorCodigo($codigo_projeto)
        {
                // $this->db->select('codigo, nome, sobrenome, arquivo_avatar');
                $this->db->from('projeto');
                $this->db->join('usuario_projeto', 'projeto.codigo=usuario_projeto.codigo_projeto');
                $this->db->join('usuario', 'usuario_projeto.codigo_usuario=usuario.codigo');
                $this->db->where('projeto.codigo', $codigo_projeto);
<<<<<<< HEAD

=======
>>>>>>> origin/master
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
}