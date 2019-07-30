<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('clientes_model');
		$this->load->library('table');

		// verifica se esta autenticado
		if (!$_SESSION['autenticado']){
			redirect(base_url('/login'));
		}
		
	}

	public function index(){
		
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Clientes";
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		//$this->load->view('frontend/clientes-menu');
		$this->load->view('frontend/clientes');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	
	}

	public function ficha($id_md5){

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Ficha";
		$dados['ficha'] = $this->clientes_model->busca_ficha_cliente($id_md5);
		$dados['clientes'] = $this->clientes_model->busca_cliente($id_md5);
		$dados['ficha_debito'] = $this->clientes_model->busca_debito_ficha($id_md5);
		
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		//$this->load->view('frontend/clientes-menu');
		$this->load->view('frontend/ficha-aside');
		$this->load->view('frontend/ficha');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function tela_ficha_mais($id){
		$dados['ficha_detalhes'] = $this->clientes_model->busca_detalhes_ficha($id);
		$this->load->view('frontend/ficha-alterar-promissoria',$dados);
	}	

	public function tela_ficha_debitos($id){
		$id_md5 = md5($id);
		$dados['ficha_debito'] = $this->clientes_model->busca_debito_ficha($id_md5);
		$this->load->view('frontend/ficha-debitos',$dados);
	}	

	public function tela_ficha_historico($id){
		$id_md5 = md5($id);
		$dados['his_compra'] = $this->clientes_model->busca_historico_compra($id_md5);
		$dados['his_pag'] = $this->clientes_model->busca_historico_pagamento($id_md5);
		$this->load->view('frontend/ficha-historico',$dados);
	}

	public function tela_ficha_alterar_pessoa($id){
		$dados['clientes'] = $this->clientes_model->busca_cliente($id);
		$this->load->view('frontend/alterar-pessoa',$dados);
	}

	public function busca(){
		$key = $this->input->post('txt-key');
		$dados['busca'] = $this->clientes_model->busca_rapida($key);
		$this->load->view('frontend/cliente-busca',$dados);
	}

	public function tela_cadastro(){
		$this->load->view('frontend/cliente-cadastro');
	}

	public function tela_lista(){
		$dados['clientes'] = $this->clientes_model->listar_clientes();
		$this->load->view('frontend/clientes-lista',$dados);	
	}

	public function tela_debitos(){
		$dados['debitos'] = $this->clientes_model->busca_debitos();
		$this->load->view('frontend/debitos',$dados);
	}

	public function adicionar_pessoa(){

		$nome = $this->input->post('nome');
		if(!$this->clientes_model->verifica_nome($nome)){
			
			$end = $this->input->post('end');
			$tel = $this->input->post('tel');
			$tipo = $this->input->post('tipo');
			
			if($tipo == 2){
				$i1 = $this->input->post('cnpj');
				$i2 = $this->input->post('ie');
			}else{
				$i1 = $this->input->post('rg');
				$i2 = $this->input->post('cpf');	
			}

			$dados['nom_cli']=$nome;
			$dados['tel_cli']=$tel;
			$dados['end_cli']=$end;
			$dados['tip_cli']=$tipo;
			$dados['item1']=$i1;
			$dados['item2']=$i2;

			if($this->clientes_model->adicionar_pessoa($dados)){
				echo 'Cadastrado com sucesso';
			}		
		}
	}

	public function alterar($id){
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Alterar Pessoa/Empresa";
		$dados['clientes'] = $this->clientes_model->busca_cliente($id);

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-clientes');		
		$this->load->view('frontend/alterar-pessoa');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function salvar_alteracoes(){
		
		$nome = $this->input->post('nome');
		$end = $this->input->post('end');
		$tel = $this->input->post('tel');
		//$i1 = $this->input->post('i1');
		//$i2 = $this->input->post('i2');
		$tipo = $this->input->post('tipo');

		if($tipo == 1){
			$i1 = $this->input->post('rg');
			$i2 = $this->input->post('cpf');
		}else{
			$i1 = $this->input->post('cnpj');
			$i2 = $this->input->post('ie');
		}

		$id = $this->input->post('id');
		$id_md5 = md5($id);

		if($this->clientes_model->salvar_alteracoes($nome,$end,$tel,$i1,$i2,$tipo,$id_md5)){
			
		}		
	}

}
