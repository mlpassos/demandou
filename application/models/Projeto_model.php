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

        public function __construct() {
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
        public function listarPorUsuario($codigo_usuario) {
                // $this->output->enable_profiler(TRUE);
                $this->db->select("pa.nome as papel, p.codigo AS codigo,  p.titulo AS titulo,  p.descricao AS descricao,  p.data_inicio AS data_inicio,  p.data_prazo AS data_prazo,  p.prioridade AS prioridade");
                $this->db->from('projeto as p');
                $this->db->join('usuario_projeto as up', 'p.codigo=up.codigo_projeto');
                $this->db->join('papel as pa', 'up.codigo_papel=pa.codigo');
                $this->db->where('up.codigo_usuario', $codigo_usuario);
                $this->db->order_by('p.data_prazo', 'ASC');
                $query = $this->db->get();
                return $query->result_array();

                // SELECT  
                //     `pa`.`nome` AS  `papel` ,  `p`.`codigo` AS  `codigo_projeto` ,  `p`.`titulo` AS  `titulo` ,  `p`.`descricao` AS  `descricao` ,  `p`.`data_inicio` AS  `data_inicio` ,  
                //     `p`.`data_prazo` AS  `data_prazo` ,  `p`.`prioridade` AS `prioridade`,
                //     `t`.`codigo` AS  `codigo_tarefa` ,  `t`.`titulo` as tarefa_titulo ,  `t`.`descricao` as tarefa_descricao ,  `t`.`codigo_usuario` as codigo_usuario, `t`.`data_inicio` as tarefa_data_inicio ,  
                //     `t`.`data_prazo` as tarefa_data_prazo ,  `t`.`data_fim` as `tarefa_data_fim` 
                //     FROM  `projeto` AS  `p` 
                //     JOIN  `usuario_projeto` AS  `up` ON  `p`.`codigo` =  `up`.`codigo_projeto` 
                //     JOIN  `papel` AS  `pa` ON  `up`.`codigo_papel` =  `pa`.`codigo` 
                //     JOIN  `tarefa` AS  `t` ON  `p`.`codigo` =  `t`.`codigo_projeto` 
                //     WHERE  `up`.`codigo_usuario` =  '5'
                //     ORDER BY  `p`.`data_prazo` ASC 
                //     LIMIT 0 , 30

        }
        public function listarPorCodigo($codigo_projeto) {
                $this->db->from('projeto');
                $this->db->join('usuario_projeto', 'projeto.codigo=usuario_projeto.codigo_projeto');
                $this->db->join('usuario', 'usuario_projeto.codigo_usuario=usuario.codigo');
                $this->db->where('projeto.codigo', $codigo_projeto);
                $query = $this->db->get();
                return $query->result_array();
        }
        public function verPorCodigo($codigo_projeto) {
                $this->db->from('projeto');
                // $this->db->join('usuario_projeto', 'projeto.codigo=usuario_projeto.codigo_projeto');
                // $this->db->join('usuario', 'usuario_projeto.codigo_usuario=usuario.codigo');
                $this->db->where('projeto.codigo', $codigo_projeto);
                $query = $this->db->get();
                return $query->result_array();
        }
}