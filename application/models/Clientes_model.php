<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function busca_debitos(){
		
		$this->db->distinct('c.nom_cli');
		$this->db->select('c.ide_cli,c.nom_cli,c.tel_cli');
		$this->db->from('cliente as c');
		$this->db->join('ficha','ficha.ide_cli = c.ide_cli');
		$this->db->where('ficha.val_pro > ', '0');
		$this->db->order_by('c.nom_cli','asc');

		return $this->db->get()->result();
	}

	public function busca_debito_cliente($id){
		$this->db->select('dat_pro');
		$this->db->select(' (select SUM(val_pro) FROM ficha WHERE ide_cli = '.$id.' )as debito ');
		$this->db->from('ficha');
		$this->db->where('val_pro > ', '0');
		$this->db->where('ide_cli',$id);
		$this->db->order_by('dat_pro','asc');
		$this->db->limit(1);
		return $this->db->get()->result();
	}	

	public function listar_clientes(){
		$this->db->from('cliente');
		$this->db->order_by('ide_cli','desc');
		return $this->db->get()->result();
	}

	public function busca_ficha_cliente($id_md5){
		$this->db->from('cliente');
		$this->db->where('md5(ide_cli)',$id_md5);
		return $this->db->get()->result();
	}	

	public function busca_debito_ficha($id_md5){
		$this->db->from('ficha');
		$this->db->where('md5(ide_cli)',$id_md5);
		$this->db->where('val_pro >','0');
		return $this->db->get()->result();
	}

	public function valor_debito($id_md5){
		$this->db->select('SUM(val_pro) as total');
		//$this->db->select('val_pro');
		$this->db->from('ficha');
		$this->db->where('md5(ide_cli)',$id_md5);
		$this->db->where('val_pro >',0);
		return $this->db->get()->result();
	}

	public function busca_detalhes_ficha($id){
		$this->db->from('ficha');
		$this->db->where('ide_pro',$id);
		//$this->db->where('val_pro >','0');
		return $this->db->get()->result();
	}

	public function busca_cliente($id_md5){
		$this->db->from('cliente');
		$this->db->where('md5(ide_cli)',$id_md5);
		return $this->db->get()->result();
	}

	public function verifica_nome($nome){
		$this->db->where('nom_cli',$nome);
		return $this->db->get('cliente')->row_array();
	}

	public function adicionar_pessoa($dados){
		return $this->db->insert('cliente',$dados);
	}	

	public function salvar_alteracoes($nome,$end,$tel,$i1,$i2,$tipo,$id_md5){
		$dados['nom_cli']=$nome;
		$dados['tel_cli']=$tel;
		$dados['end_cli']=$end;
		$dados['tip_cli']=$tipo;
		$dados['item1']=$i1;
		$dados['item2']=$i2;
		$this->db->where('md5(ide_cli)',$id_md5);
		return $this->db->update('cliente',$dados);
	}

	public function busca_rapida($key){
		$this->db->select('ide_cli,nom_cli,tel_cli,end_cli,tip_cli');
		$this->db->from('cliente');
		$this->db->like("nom_cli",$key);
		return $this->db->get()->result();
	}

	public function busca_historico_compra($id_md5){
		$this->db->select('dat_pro,des_pro,obs_pro');
		$this->db->from('ficha');
		$this->db->where('md5(ide_cli)',$id_md5);
		$this->db->order_by('ide_pro','desc');
		$this->db->limit('10');
		return $this->db->get()->result();
	}	

	public function busca_historico_pagamento($id_md5){
		$this->db->select('dat_recebe,val_recebe');
		$this->db->from('receber');
		$this->db->where('md5(ide_cli)',$id_md5);
		$this->db->order_by('ide_recebe','desc');
		$this->db->limit('10');
		return $this->db->get()->result();
	}

}