<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarefa_model extends CI_Model {

        public $codigo;
        public $titulo;
        public $descricao;
        public $data_inicio;
        public $data_prazo;
        public $data_fim;
        public $criado_por;
        public $codigo_projeto;
        public $codigo_status;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }


        public function inserir($tarefa) {
                // hack pra converter data do input html5 no formato mysql
                $ano = date("Y",strtotime($tarefa['data_inicio']));
                $mes = date("m",strtotime($tarefa['data_inicio']));
                $dia = date("d",strtotime($tarefa['data_inicio']));

                $anop = date("Y",strtotime($tarefa['data_prazo']));
                $mesp = date("m",strtotime($tarefa['data_prazo']));
                $diap = date("d",strtotime($tarefa['data_prazo']));
                // instancia o objeto
                $this->codigo = NULL;
                $this->titulo = $tarefa['titulo'];
                $this->descricao = $tarefa['descricao'];
   
                $this->data_inicio = $ano . '-' . $mes . '-' . $dia;
                $this->data_prazo = $anop . '-' . $mesp . '-' . $diap;
                $this->data_fim = NULL;

                $this->criado_por = $this->session->userdata('codigo_usuario');
                $this->codigo_projeto = $tarefa['codigo_projeto'];
                // usuário ativo
                $this->codigo_status = 1;
                // echo "<pre>";
                //   var_dump($this);
                // echo "</pre>";
                if ($this->db->insert('tarefa', $this)) {
                  $inserido = $this->db->insert_id();
                  // atribuir usuários
                  $lider =  $this->input->post('lider');
                  $participantes = $this->input->post('participantes');
                  $obj = array(
                    "codigo_usuario" => $lider,
                    "codigo_tarefa" => $inserido,
                    "codigo_papel" => 1
                    );
                  //var_dump($inserido);
                  $this->db->insert('usuario_tarefa', $obj);

                  foreach($participantes as $p) {
                    $obj_p = array(
                    "codigo_usuario" => $p,
                    "codigo_tarefa" => $inserido,
                    "codigo_papel" => 2
                    );
                    if ($this->db->insert('usuario_tarefa', $obj_p)) {
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

        public function listarAux() {
                $this->db->select('codigo, nome, sobrenome, arquivo_avatar');
                $this->db->from('usuario');
                $query = $this->db->get();
                return $query->result_array();
        }
        public function jsonTarefasPorUsuario($codigo_projeto, $codigo_usuario) {
                //$res = array("response"=>"ok");
                $this->db->select('t.titulo, t.descricao, t.data_inicio, t.data_prazo, t.data_fim,  ut.codigo_usuario');
                $this->db->from('tarefa as t');
                $this->db->join('usuario_tarefa as ut', 't.codigo=ut.codigo_tarefa');
                // $this->db->join('projeto', 'tarefa.codigo_projeto=projeto.codigo');
                $this->db->where('t.codigo_projeto', $codigo_projeto);
                $this->db->where('ut.codigo_usuario', $codigo_usuario);
                $this->db->order_by('data_prazo', 'ASC');
                $query = $this->db->get();
                return $query->result_array();
        }
        public function listarPorCodigo($codigo_projeto) {
                // $this->db->select('codigo, nome, sobrenome, arquivo_avatar');
                $this->db->from('tarefa');
                // $this->db->join('usuario_projeto', 'projeto.codigo=usuario_projeto.codigo_projeto');
                // $this->db->join('projeto', 'tarefa.codigo_projeto=projeto.codigo');
                $this->db->where('codigo_projeto', $codigo_projeto);
                $this->db->order_by('data_prazo', 'ASC');
                $query = $this->db->get();
                return $query->result_array();
        }
        public function listarPorUsuario($codigo_usuario) {
                $this->db->select('count(t.codigo) as tarefa_total, ut.codigo_usuario as codigo_usuario, t.codigo_projeto as codigo_projeto');
                $this->db->from('tarefa as t');
                $this->db->join('usuario_tarefa as ut', 't.codigo=ut.codigo_tarefa');
                $this->db->where('ut.codigo_usuario', $codigo_usuario);
                $this->db->group_by('t.codigo_projeto');
                // $this->db->order_by('data_prazo', 'ASC');
                $query = $this->db->get();
                return $query->result_array();

                // SELECT  count(`t`.`codigo`) as total, `ut`.`codigo_usuario` as codigo_usuario, `t`.`codigo_projeto` as codigo_projeto
                // FROM  `tarefa` AS  `t` 
                // JOIN  `usuario_tarefa` AS  `ut` ON  `t`.`codigo` =  `ut`.`codigo_tarefa` 
                // JOIN  `usuario` AS  `u` ON  `ut`.`codigo_usuario` =  `u`.`codigo` 
                // WHERE  `ut`.`codigo_usuario` =  '5'
                // group by `t`.`codigo_projeto` 
                // ORDER BY  `t`.`data_prazo` ASC 


        }
}