<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function adicionar_retirada($desc,$valor,$data){
		$dados['dat_cont']=$data;
		$dados['des_cont']=$desc;
		$dados['val_cont']=$valor;
		$dados['tip_cont']='saida';
		return $this->db->insert('controle',$dados);
	}

	public function busca_rel_anual($data_inicio,$data_final){
		$this->db->from('controle');
		$this->db->where('status_lem = 1');
		$this->db->order_by('dat_lem','desc');
		return $this->db->get()->result();
	}	

	public function teste_controle($inicio,$final){
		$this->db->select('tip_cont,val_cont');
		$this->db->from('controle');
		$this->db->where('dat_cont >= ', $inicio);
		$this->db->where('dat_cont <= ', $final);
		$this->db->order_by('dat_cont','desc');
		return $this->db->get()->result();
	}	
	
	public function busca_rel_diario($inicio,$final){
		$this->db->from('controle');
		$this->db->where('dat_cont >= ', $inicio);
		$this->db->where('dat_cont <= ', $final);
		$this->db->order_by('ide_cont','desc');
		return $this->db->get()->result();
	}

}

/*

	public function listar_os(){
		$this->db->from('lembretes');
		$this->db->where('status_lem = 1');
		$this->db->order_by('dat_lem','desc');
		return $this->db->get()->result();
	}

	public function listar_os_arquivo(){
		$this->db->from('lembretes');
		$this->db->where('status_lem = 2');
		$this->db->order_by('dat_lem','desc');
		return $this->db->get()->result();
	}	


	public function busca_ordem($id){
		$this->db->from('lembretes');
		$this->db->where('md5(ide_lem)',$id);
		return $this->db->get()->result();
	}

	public function arquivar($id_arquiva){
		$dados['status_lem'] = 2 ;
		$this->db->where('ide_lem',$id_arquiva);
		return $this->db->update('lembretes',$dados);
	}	

	public function desarquivar($id_arquiva){
		$dados['status_lem'] = 1 ;
		$this->db->where('ide_lem',$id_arquiva);
		return $this->db->update('lembretes',$dados);
	}	

*/