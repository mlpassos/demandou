<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarefa_model extends CI_Model {

        public $codigo;
        public $titulo;
        public $descricao;
        public $prioridade;
        public $data_inicio;
        public $data_prazo;
        public $data_fim;
        public $criado_por;
        public $codigo_projeto;
        public $codigo_usuario;
        public $codigo_status;

        public function __construct() {
                parent::__construct();
        }

        public function inserir($tarefa) {
                $this->load->helper('string');
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
                $this->descricao = quotes_to_entities($tarefa['descricao']);
                $this->prioridade = $tarefa['prioridade'];
   
                $this->data_inicio = $ano . '-' . $mes . '-' . $dia;
                $this->data_prazo = $anop . '-' . $mesp . '-' . $diap;
                $this->data_fim = NULL;

                $this->criado_por = $tarefa['criado_por'];
                $this->codigo_projeto = $tarefa['codigo_projeto'];
                $this->codigo_usuario = $tarefa['lider'][0];
                // usuário ativo
                $this->codigo_status = $tarefa['codigo_status'];
                // echo "<pre>";
                //   var_dump($this);
                // echo "</pre>";
                if ($this->db->insert('tarefa', $this)) {
                  $inserido = $this->db->insert_id();
                  return true;//<br>Código: " . $inserido;
                } else {
                  return false;      
                }
        }
        public function alterar($tarefa) {
                $ano = date("Y",strtotime($tarefa['data_inicio']));
                $mes = date("m",strtotime($tarefa['data_inicio']));
                $dia = date("d",strtotime($tarefa['data_inicio']));

                $anop = date("Y",strtotime($tarefa['data_prazo']));
                $mesp = date("m",strtotime($tarefa['data_prazo']));
                $diap = date("d",strtotime($tarefa['data_prazo']));
                // instancia o objeto
                $this->codigo = $tarefa['codigo_tarefa'];
                $this->titulo = $tarefa['titulo'];
                $this->descricao = $tarefa['descricao'];
                $this->prioridade = $tarefa['prioridade'];
   
                $this->data_inicio = $ano . '-' . $mes . '-' . $dia;
                $this->data_prazo = $anop . '-' . $mesp . '-' . $diap;
                // $this->data_fim = NULL;

                // $this->criado_por = $this->session->userdata('codigo_usuario');
                $this->codigo_projeto = $tarefa['codigo_projeto'];
                $this->codigo_usuario = $tarefa['lider'][0];
                           
                // usuário ativo
                $this->codigo_status = $tarefa['codigo_status'];
                // return $this;
                // echo "<pre>";
                //   var_dump($this);
                // echo "</pre>";
                $this->db->where('codigo', $this->codigo);
                if ( $this->db->update('tarefa', $this) ) {
                    return true;
                } else {
                    return false;      
                }
        }

        public function responder($codigo_tarefa, $codigo_observacao, $resposta, $lider, $tipo, $extender) {
            // pega usuário atual q responder, líder ou admin
            $usuario = $this->session->userdata('codigo_usuario');
            $dados['resposta'] = array(
                    "codigo_observacao" => $codigo_observacao,
                    "resposta" => $resposta,
                    "data_resposta" => date("Y-m-d"),
                    "inserido_por" =>  $usuario
                );
            if ($tipo == 2) {
                if ($extender == "true") {
                    $dados['observacao'] = array(
                        // aceita
                        "codigo_status_obs" => 2
                    );
                } else {
                    $dados['observacao'] = array(
                        // nao aceita
                        "codigo_status_obs" => 3
                    );
                }
                // extensão, grava resposta e redefine data_fim em tarefa
                if ( $this->db->insert('observacoes_resposta', $dados['resposta']) ) {
                    if ($extender == "true") {
                        $dados['tarefa'] = array(
                        "data_prazo" => date('Y-m-d', strtotime("+7 days")),
                        "data_fim" => null
                        );
                        $this->db->where('codigo', $codigo_tarefa);
                        if ( $this->db->update('tarefa', $dados['tarefa']) ) {
                            $this->db->where('codigo', $codigo_observacao);
                            if ($this->db->update('tarefa_observacoes', $dados['observacao'])) {
                                return true;
                            } else {
                                return false;
                            }
                            // manda email pra avisar da extensao? =) e retorna true
                        } else {
                            return false;
                        }    
                    } else {
                        // faz nada, foi negada a extensão. aliás, encerra tarefa? zera data_fim
                        $dados['tarefa'] = array(
                            "data_fim" => null,
                            "encerrada" => 1,
                            "encerrada_por" => $usuario,
                        );
                        $this->db->where('codigo', $codigo_tarefa);
                        if ( $this->db->update('tarefa', $dados['tarefa']) ) {
                            $this->db->where('codigo', $codigo_observacao);
                            if ($this->db->update('tarefa_observacoes', $dados['observacao'])) {
                                return true;
                            } else {
                                return false;
                            }
                            // manda email pra avisar da extensao? =) e retorna true
                        } else {
                            return false;
                        }    
                    }
                    
                }
            }
            if ($tipo == 1) {
                // finalizou normal, grava resposta e tarefa redefinir  encerrada e encerrada_por em tarefa
                if ( $this->db->insert('observacoes_resposta', $dados['resposta']) ) {
                    if ($extender == "true") {
                        $dados['observacao'] = array(
                            // aceita
                            "codigo_status_obs" => 2
                        );
                        $dados['tarefa'] = array(
                            "encerrada" => 1,
                            "encerrada_por" => $usuario
                        );

                    } else {
                        $dados['observacao'] = array(
                            // nao aceita
                            "codigo_status_obs" => 3
                        );
                        $dados['tarefa'] = array(
                            "data_fim" => null
                        );
                    }

                    $this->db->where('codigo', $codigo_tarefa);
                    if ( $this->db->update('tarefa', $dados['tarefa']) ) {
                        $this->db->where('codigo', $codigo_observacao);
                        if ($this->db->update('tarefa_observacoes', $dados['observacao'])) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
            // não existe com código 3
            // if ($tipo == 3) {
            //     // forçada,  redefinir apenas tarefa data_fim para null e encerrada = 1 e encerrada_por session->userdata() em tarefa
            //     $dados['tarefa'] = array(
            //             "data_fim" => null,
            //             "encerrada" => 1,
            //             "encerrada_por" => $usuario,
            //     );
            //     $this->db->where('codigo', $codigo_tarefa);
            //     if ( $this->db->update('tarefa', $dados['tarefa']) ) {
            //         return true;
            //     } else {
            //         return false;
            //     }
            // }
        }

        public function finalizar($codigo_tarefa,$observacao,$codigo_tipo, $codigo_usuario) {
            
            if ($codigo_tipo == 3) {  
                // encerra tarefa de uma vez, forçada          
                $dados['tarefa'] = array(
                    "data_fim" => null,
                    "encerrada" => 1,
                    "encerrada_por" => $codigo_usuario,
                    "codigo_status" => 0
                );
                $dados['observacao'] = array(
                    "codigo_tarefa" => $codigo_tarefa,
                    "observacao" => $observacao,
                    "data_criada" => date("Y-m-d"),
                    "codigo_tipo" => $codigo_tipo,
                    // 4 - Forçada
                    "codigo_status_obs" => 4,
                    "inserido_por" =>  $codigo_usuario
                );
            } else {
                // finalização normal ou extensão de prazo
                 $dados['tarefa'] = array(
                    "data_fim" => date("Y-m-d"),
                );
                $dados['observacao'] = array(
                    "codigo_tarefa" => $codigo_tarefa,
                    "observacao" => $observacao,
                    "data_criada" => date("Y-m-d"),
                    "codigo_tipo" => $codigo_tipo,
                    // 1 - Em andamento
                    "codigo_status_obs" => 1,
                    "inserido_por" =>  $codigo_usuario
                );
            }
            // onde colocar o fim
            $this->db->where('codigo', $codigo_tarefa);
            // se finalizar tarefa corretamente
            if ( $this->db->update('tarefa', $dados['tarefa']) ) {
                // insere observação
                if ( $this->db->insert('tarefa_observacoes', $dados['observacao']) ) {
                    // caso seja forçada, encerrar também a tarefa
                    // insere resposta em branco
                    // $dados["resposta"] = array(
                    //     "codigo_observacao" => $this->db->insert_id()
                    //     );
                    // $this->db->insert('observacoes_resposta', $dados["resposta"]);
                    return true;
                } else {
                    return false;
                    //array("status"=>"falha");
                }
            } else {
                return false;
            }
        }

        public function excluirTarefa($codigo_tarefa) {
            $excluir = array("codigo_status"=>0);
            $this->db->where('codigo', $codigo_tarefa);
            if ( $this->db->update('tarefa', $excluir) ) {
                return true;
            } else {
                return false;
            }
        }

        public function encerrarTarefa($codigo_tarefa) {
            $encerrar = array("codigo_status"=>2);
            $this->db->where('codigo', $codigo_tarefa);
            if ( $this->db->update('tarefa', $encerrar) ) {
                return true;    
            } else {
                return false;      
            }
        }


       public function listar() {
                // $this->output->enable_profiler(TRUE);
                // SELECT  `t`.`codigo` AS  `codigo_tarefa` ,  `t`.`codigo_projeto` ,  `t`.`titulo` ,  `t`.`descricao` ,  `t`.`data_inicio` ,  `t`.`data_prazo` ,  `t`.`data_fim` ,  `t`.`encerrada` ,  `t`.`encerrada_por` ,  `t`.`codigo_usuario` AS `codigo_usuario`,
                // u.nome as nome, u.sobrenome as sobrenome
                // FROM  `tarefa` AS  `t` 
                // join usuario as u on t.codigo_usuario = u.codigo
                // ORDER BY  `t`.`codigo` ASC 
                // $this->output->enable_profiler(TRUE);
                $this->db->select('p.titulo as projeto_titulo, t.prioridade, t.codigo_status as codigo_status, t.codigo as codigo_tarefa, t.codigo_projeto, t.titulo, t.descricao, t.data_inicio, t.data_prazo, t.data_fim,  t.encerrada, t.encerrada_por, t.codigo_usuario as codigo_usuario, u.nome as nome, u.sobrenome as sobrenome, u.arquivo_avatar as arquivo_avatar');
                $this->db->from('tarefa as t');
                $this->db->join('usuario as u', 't.codigo_usuario = u.codigo');
                $this->db->join('projeto as p', 't.codigo_projeto = p.codigo');
                $this->db->where('t.codigo_status', 1);
                $this->db->order_by('t.codigo', 'ASC');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function listarAux() {
                $this->db->select('codigo, nome, sobrenome, arquivo_avatar');
                $this->db->from('usuario');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function jsonTarefasObservacoes($codigo_tarefa) {
                //$res = array("response"=>"ok");
                // $this->output->enable_profiler(TRUE);
                $this->db->select('obs.codigo_status_obs, ot.codigo as codigo_tipo, ot.tipo, obs.inserido_por, u.nome, u.sobrenome, u.arquivo_avatar, obs.codigo as codigo_observacao, obs.observacao, obs.data_criada as obs_data_criada, t.codigo as codigo_tarefa, t.codigo_usuario');
                $this->db->from('tarefa as t');
                $this->db->join('tarefa_observacoes as obs', 't.codigo = obs.codigo_tarefa');
                // $this->db->join('observacoes_resposta as res', 'res.codigo_observacao = obs.codigo');
                $this->db->join('observacoes_tipo as ot', 'obs.codigo_tipo = ot.codigo');
                // $this->db->join('observacoes_resposta as res', 'obs.codigo = res.codigo_observacao');
                $this->db->join('usuario as u', 'obs.inserido_por = u.codigo');
                $this->db->where('t.codigo', $codigo_tarefa);
                $this->db->order_by('obs.codigo', 'DESC');
                // $this->db->limit(1);
                $query = $this->db->get();
                return $query->result_array();
        }

         public function jsonTarefasRespostas($codigo_observacao) {
                //$res = array("response"=>"ok");
                // $this->output->enable_profiler(TRUE);
                $this->db->select('res.resposta, res.data_resposta, res.inserido_por, u.nome, u.sobrenome, u.arquivo_avatar, obs.data_criada, ot.tipo as tipo');
                $this->db->from('observacoes_resposta as res');
                $this->db->join('tarefa_observacoes as obs', 'res.codigo_observacao = obs.codigo');
                $this->db->join('observacoes_tipo as ot', 'obs.codigo_tipo = ot.codigo');
                // $this->db->join('observacoes_resposta as res', 'obs.codigo = res.codigo_observacao');
                $this->db->join('usuario as u', 'res.inserido_por = u.codigo');
                $this->db->where('res.codigo_observacao', $codigo_observacao);
                $this->db->order_by('obs.codigo', 'DESC');
                // $this->db->limit(1);
                $query = $this->db->get();
                return $query->result_array();
        }



        public function jsonTarefasPorUsuario($codigo_projeto, $codigo_usuario) {
                //$res = array("response"=>"ok");
                // $this->output->enable_profiler(TRUE);
                $this->db->select('t.codigo as codigo_tarefa, t.titulo, t.descricao, t.data_inicio, t.data_prazo, t.data_fim,  t.codigo_usuario');
                $this->db->from('tarefa as t');
                $this->db->where('t.codigo_projeto', $codigo_projeto);
                $this->db->where('t.codigo_usuario', $codigo_usuario);
                $this->db->order_by('t.codigo', 'ASC');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function jsonTarefasPorProjeto($codigo_projeto) {
                $this->db->select('t.codigo_status, t.encerrada, t.encerrada_por, t.prioridade, u.nome, u.sobrenome, u.arquivo_avatar, uf.titulo as usuario_funcao, (SELECT COUNT( * ) FROM tarefa WHERE codigo_projeto =' . $codigo_projeto . ') AS total, (SELECT COUNT( * ) FROM tarefa WHERE codigo_projeto = ' . $codigo_projeto . ' AND data_fim IS NOT NULL ) AS completas, t.codigo_usuario, t.codigo as codigo_tarefa, t.titulo, t.descricao, t.data_inicio, t.data_prazo, t.data_fim');
                $this->db->from('tarefa as t');
                $this->db->join('usuario as u', 't.codigo_usuario=u.codigo');
                $this->db->join('usuario_funcao as uf', 'u.codigo_funcao=uf.codigo');
                // $this->db->where('t.codigo_status', 1);
                $this->db->where('t.codigo_projeto', $codigo_projeto);
                $this->db->order_by('t.data_fim', 'DESC');
                $query = $this->db->get();
                return $query->result_array();
        }

        // public function jsonTarefasUserInfo($codigo_tarefa) {
        //         $this->db->select('t.codigo as codigo_tarefa, pa.nome as papel, ut.codigo_usuario as codigo_usuario');
        //         $this->db->from('tarefa as t');
        //         $this->db->join('usuario_tarefa as ut', 't.codigo=ut.codigo_tarefa');
        //         $this->db->join('papel as pa', 'ut.codigo_papel=pa.codigo');
        //         $this->db->where('t.codigo', $codigo_tarefa);
        //         $this->db->group_by('ut.codigo_usuario');
        //         $this->db->order_by('data_prazo', 'ASC');
        //         $query = $this->db->get();
        //         return $query->result_array();
        // }

        public function listarTotalAtivo() {
            $this->db->select('count(*) as total');
            $this->db->from('tarefa');
            $this->db->where('codigo_status', 1);
            $query = $this->db->get();
            return $query->result_array();   
        }
        public function listarTotalEncerrado() {
            $this->db->select('count(*) as total');
            $this->db->from('tarefa');
            $this->db->where('codigo_status', 2);
            $query = $this->db->get();
            return $query->result_array();   
        }
        public function listarTotalEntregue() {
            // $this->output->enable_profiler(TRUE);
            $this->db->select('count(*) as total');
            $this->db->from('tarefa');
            $this->db->where('data_fim is not null');
            $this->db->where('encerrada is not null');
            $this->db->where('codigo_status', 1);
            $query = $this->db->get();
            return $query->result_array();   
        }
        public function listarTotalAguardando() {
            // $this->output->enable_profiler(TRUE);
            $this->db->select('count(*) as total');
            $this->db->from('tarefa as t');
            $this->db->join('tarefa_observacoes as tob', 't.codigo = tob.codigo_tarefa');
            $this->db->where('t.data_fim is not null');
            $this->db->where('t.encerrada is null');
            $this->db->where('t.codigo_status', 1);
            $this->db->where('tob.codigo_tipo', 1);
            $this->db->where('tob.codigo_status_obs is null');
            $query = $this->db->get();
            return $query->result_array();   
        }

        
        public function listarPorCodigo($codigo_projeto) {
                // $this->output->enable_profiler(TRUE);
                // $this->db->select('codigo, nome, sobrenome, arquivo_avatar');
                $this->db->from('tarefa as t');
                $this->db->join('usuario as u', 't.codigo_usuario=u.codigo');
                $this->db->where('t.codigo_projeto', $codigo_projeto);
                $this->db->order_by('t.data_prazo', 'ASC');
                $query = $this->db->get();
                return $query->result_array();
        }
        // envia total de tarefas por usuário
        public function listarPorUsuario($codigo_usuario) {
                $this->db->select('count(t.codigo) as tarefa_total, t.codigo_usuario as codigo_usuario, t.codigo_projeto as codigo_projeto');
                $this->db->from('tarefa as t');
                $this->db->where('t.codigo_usuario', $codigo_usuario);
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