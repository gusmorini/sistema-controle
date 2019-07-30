<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca_model extends CI_Model {

	public $id;
	public $titulo;

	public function __construct(){
		parent::__construct();
	}

	public function fazer_busca($key){
		$this->db->select('postagens.id,postagens.titulo,usuario.nome as autor,usuario.id as idautor');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id = postagens.user');
		$this->db->like("titulo",$key);
		return $this->db->get()->result();
	}

}