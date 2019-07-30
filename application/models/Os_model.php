<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os_model extends CI_Model {

	public $ide_lem;
	public $tel_lem;
	public $tex_lem;
	public $nom_lem;
	public $dat_lem;
	public $status_lem;

	public function __construct(){
		parent::__construct();
	}

	public function busca($key){
		$this->db->from('lembretes');
		$this->db->like('nom_lem',$key);
		$this->db->where('status_lem',1);
		$this->db->order_by('ide_lem','desc');
		return $this->db->get()->result();
	}	

	public function busca_arquivo($key){
		$this->db->from('lembretes');
		$this->db->like("nom_lem",$key);
		$this->db->where('status_lem',2);
		$this->db->order_by('ide_lem','desc');
		return $this->db->get()->result();
	}	

	public function busca_ordem($id){
		$this->db->from('lembretes');
		$this->db->where("ide_lem",$id);
		return $this->db->get()->result();
	}

	public function listar_os(){
		$this->db->from('lembretes');
		$this->db->where('status_lem = 1');
		$this->db->order_by('ide_lem','desc');
		return $this->db->get()->result();
	}

	public function listar_os_arquivo(){
		$this->db->from('lembretes');
		$this->db->where('status_lem = 2');
		$this->db->order_by('ide_lem','desc');
		return $this->db->get()->result();
	}	

	public function cadastro($nom_lem,$tel_lem,$tex_lem){
		$dados['nom_lem']=$nom_lem;
		$dados['tel_lem']=$tel_lem;
		$dados['tex_lem']=$tex_lem;
		$dados['status_lem'] = 1;
		$dados['dat_lem'] = data_usa();
		return $this->db->insert('lembretes',$dados);
	}	
	
	public function salvar_alteracoes($nom_lem,$tel_lem,$tex_lem,$id){
		$dados['nom_lem']=$nom_lem;
		$dados['tel_lem']=$tel_lem;
		$dados['tex_lem']=$tex_lem;
		$dados['status_lem'] = 1;
		$dados['dat_lem'] = data_form();
		$this->db->where('ide_lem',$id);
		return $this->db->update('lembretes',$dados);
	}

/*	public function busca_ordem($id){
		$this->db->from('lembretes');
		$this->db->where('md5(ide_lem)',$id);
		return $this->db->get()->result();
	}*/

	public function arquivar_ordem($id){
		$dados['status_lem'] = 2 ;
		$this->db->where('ide_lem',$id);
		return $this->db->update('lembretes',$dados);
	}	

	public function reativar_ordem($id){
		$dados['status_lem'] = 1 ;
		$this->db->where('ide_lem',$id);
		return $this->db->update('lembretes',$dados);
	}	

	public function desarquivar($id_arquiva){
		$dados['status_lem'] = 1 ;
		$this->db->where('ide_lem',$id_arquiva);
		return $this->db->update('lembretes',$dados);
	}

	public function busca_rapida($key){
		$this->db->select('ide_cli,nom_cli');
		$this->db->from('cliente');
		$this->db->like("nom_cli",$key);
		return $this->db->get()->result();
	}

}