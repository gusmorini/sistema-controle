<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estoque_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function listar_estoque(){
		$this->db->from('estoque');
		$this->db->order_by('des_pec','asc');
		return $this->db->get()->result();
	}		

	public function listar_produtos(){
		$this->db->from('estoque');
		$this->db->where('lucro > 0');
		$this->db->order_by('ide_pec','desc');
		return $this->db->get()->result();
	}

	public function listar_produtos_emfalta(){
		$this->db->from('estoque');
		$this->db->where('qtd_pec <= min_pec');
		$this->db->order_by('des_pec','asc');
		return $this->db->get()->result();
	}

	public function busca_rapida($key){
		$this->db->from('estoque');
		$this->db->like("des_pec",$key);
		return $this->db->get()->result();
	}	

	public function listar_servicos(){
		$this->db->from('estoque');
		$this->db->where('lucro = 0');
		$this->db->order_by('des_pec','asc');
		return $this->db->get()->result();
	}

	public function verifica_desc($desc){
		$this->db->where('des_pec',$desc);
		return $this->db->get('estoque')->row_array();
	}

	public function adicionar($desc,$custo,$lucro,$minima,$qtd){
		$dados['des_pec']=$desc;
		$dados['min_pec']=$minima;
		$dados['qtd_pec']=$qtd;
		$dados['val_pec']=$custo;
		$dados['lucro']=$lucro;
		return $this->db->insert('estoque',$dados);
	}

	public function busca_estoque($id){
		$this->db->from('estoque');
		$this->db->where('md5(ide_pec)',$id);
		return $this->db->get()->result();
	}

	public function salvar_alteracoes($desc,$custo,$lucro,$minima,$qtd,$id){
		$dados['des_pec']=$desc;
		$dados['min_pec']=$minima;
		$dados['qtd_pec']=$qtd;
		$dados['val_pec']=$custo;
		$dados['lucro']=$lucro;
		$this->db->where('ide_pec',$id);
		return $this->db->update('estoque',$dados);
	}	

	public function busca_item($id){
		$this->db->select('des_pec,val_pec,lucro,qtd_pec');
		$this->db->from('estoque');
		$this->db->where('md5(ide_pec)',$id);
		return $this->db->get()->result();
	}

	public function busca_aprazo($key){
		$this->db->select('ide_cli,nom_cli');
		$this->db->from('cliente');
		$this->db->like("nom_cli",$key);
		$this->db->limit(5);
		return $this->db->get()->result();
	}	

	public function atualiza_valor($id,$v_recebido){

		$this->db->select('val_pro,ide_pro');
		$this->db->from('ficha');
		$this->db->where('ide_cli',$id);
		$this->db->where('val_pro >','0');
		$this->db->order_by('dat_pro','asc');
		$res = $this->db->get()->result();
		$tmp = $v_recebido;
		foreach($res as $row):

			$ide_pro = $row->ide_pro;
			$val_pro = $row->val_pro;

			if($tmp <= $val_pro){
				$valor_atual = $val_pro - $tmp;

				$dados['val_pro']=$valor_atual;
				$this->db->where('ide_pro',$ide_pro);
				$this->db->update('ficha',$dados);				
				break;
			}else{
				$valor_atual = 0;
				$tmp = $tmp - $val_pro;

				$dados['val_pro']=$valor_atual;
				$this->db->where('ide_pro',$ide_pro);
				$this->db->update('ficha',$dados);				
			}
		endforeach;
		return true;
	}

	public function insere_receber($id,$data,$v_recebido){
		$dados['dat_recebe']=$data;
		$dados['val_recebe']=$v_recebido;
		$dados['ide_cli']=$id;
		$this->db->insert('receber',$dados);
		return true;
	}

	public function insere_controle($data,$nome,$v_recebido){
		$dados['dat_cont']=$data;
		$dados['des_cont']= "$nome (promissória) ";
		$dados['val_cont']=$v_recebido;
		$dados['tip_cont']='entrada';
		$this->db->insert('controle',$dados);
		return true;
	}

	public function receber_unica($ide_pro,$ide_cli,$nome,$v_recebido,$data,$val_pro){

		echo "$v_recebido - $val_pro";

		$valor_atual = $val_pro - $v_recebido;
		$dados1['val_pro']=$valor_atual;
		$this->db->where('ide_pro',$ide_pro);
		$this->db->update('ficha',$dados1);

		print_r($dados1);

		$dados2['dat_recebe']=$data;
		$dados2['val_recebe']=$v_recebido;
		$dados2['ide_cli']=$ide_cli;
		$this->db->insert('receber',$dados2);

		$dados3['dat_cont']=$data;
		$dados3['des_cont']= "$nome (promissória) ";
		$dados3['val_cont']=$v_recebido;
		$dados3['tip_cont']='entrada';
		$this->db->insert('controle',$dados3);

		return true;

	}

	public function salvar_promissoria($id,$desc,$obs,$valor){
		$dados['des_pro']=$desc;
		$dados['val_pro']=$valor;
		$dados['obs_pro']=$obs;
		$this->db->where('ide_pro',$id);
		return $this->db->update('ficha',$dados);
	}

	public function venda_avista($data,$valor){
		
		$desc_final = '';

		foreach($_SESSION['caixa'] as $caixa){
		    $id_md5 = $caixa['id'];
            $qtd_item = $caixa['qtd'];
            $valor_item = $caixa['valor'];
            $estoque = $caixa['estoque'];
            $desc = $caixa['desc'];
            $desc_final.= $qtd_item.':'.$desc.' ... ';
            //echo "$id_md5, $qtd_item, $valor_item, $desc <br>";
		    
		    $dados['qtd_pec'] = $estoque - $qtd_item;
			$this->db->where('md5(ide_pec)',$id_md5);
			$this->db->where('lucro >',0);
			$this->db->update('estoque',$dados);
		}

		echo $desc_final;

		$dados3['dat_cont']=$data;
		$dados3['des_cont']= $desc_final;
		$dados3['val_cont']=$valor;
		$dados3['tip_cont']='entrada';
		$this->db->insert('controle',$dados3);

		return true;

	}	

	public function venda_aprazo($id,$data,$valor,$obs){
		
		$desc_final = '';

		foreach($_SESSION['caixa'] as $caixa){
		    
		    $id_md5 = $caixa['id'];
            $qtd_item = $caixa['qtd'];
            $valor_item = $caixa['valor'];
            $estoque = $caixa['estoque'];
            $desc = $caixa['desc'];
            $desc_final.= $qtd_item.':'.$desc.' ... ';
            //echo "$id_md5, $qtd_item, $valor_item, $desc <br>";
		    
		    $dados['qtd_pec'] = $estoque - $qtd_item;
			$this->db->where('md5(ide_pec)',$id_md5);
			$this->db->where('lucro >',0);
			$this->db->update('estoque',$dados);
		}

		echo $desc_final;

		$dados1['ide_cli']=$id;
		$dados1['dat_pro']=$data;
		$dados1['des_pro']= $desc_final;
		$dados1['val_pro']=$valor;
		$dados1['obs_pro']=$obs;

		$this->db->insert('ficha',$dados1);

		return true;

	}

}