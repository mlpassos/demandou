<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model {
    public $codigo;
    public $nome;

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
    		$this->db->order_by('nome', 'ASC');
            $query = $this->db->get('perfil');
            return $query->result_array();
    }
}