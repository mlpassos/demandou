<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcao_model extends CI_Model {
    public $codigo;
    public $titulo;

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    public function inserir($usuario)
    {
          
    }

    public function alterar($codigo)
    {
           
    }

    public function excluir($codigo)
    {
           
    }
    public function listar()
    {
    		$this->db->order_by('titulo', 'ASC');
            $query = $this->db->get('usuario_funcao');
            return $query->result_array();
    }
}