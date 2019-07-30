<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function get_ordem_servico(){
		$this->db->select('ide_lem,nom_lem');
		$this->db->from('lembretes');
		$this->db->order_by('ide_lem','desc');
		$this->db->limit(5);
		return $this->db->get()->result();
	}	

	public function get_caixa(){
		$this->db->select('dat_cont,des_cont');
		$this->db->from('controle');
		$this->db->where('tip_cont','entrada');
		$this->db->order_by('ide_cont','desc');
		$this->db->limit(5);
		return $this->db->get()->result();
	}
}