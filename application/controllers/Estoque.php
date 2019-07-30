<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estoque extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('estoque_model');

		// verifica se esta autenticado
		if (!$_SESSION['autenticado']){
			redirect(base_url('/login'));
		}
	}

	public function index(){
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Estoque";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		//$this->load->view('frontend/estoque-menu');	
		$this->load->view('frontend/estoque');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');		
	}

	public function ficha($id){
		$id = str_replace('%20', '', $id);
		if(isset($id)){
			$id_md5 = md5($id);
			$dados['titulo'] = "Controle";
			$dados['subtitulo'] = "Editar Estoque";

			$dados['alterar'] = $this->estoque_model->busca_estoque($id_md5);
			//$this->load->view('frontend/template/html-header',$dados);
			//$this->load->view('frontend/template/header');
			//$this->load->view('frontend/estoque-menu');	
			$this->load->view('frontend/estoque-ficha',$dados);
			//$this->load->view('frontend/template/footer');
			//$this->load->view('frontend/template/html-footer');	

		}
	}

	public function tela_cadastro(){
		$this->load->view('frontend/estoque-cadastro');
	}	

	public function tela_emfalta(){
		$dados['produtos'] = $this->estoque_model->listar_produtos_emfalta();		
		$this->load->view('frontend/estoque-emfalta',$dados);
	}

	public function tela_lista(){
		$dados['lista'] = $this->estoque_model->listar_estoque();
		$this->load->view('frontend/estoque-lista',$dados);
	}

	public function busca(){
		
		if (!$this->input->post('txt-key')){
			$key = '';
		}else{
			$key = $this->input->post('txt-key');
		}

		$dados['busca'] = $this->estoque_model->busca_rapida($key);
		$this->load->view('frontend/estoque-busca',$dados);
	}

	public function salvar_alteracoes(){

		//print_r($this->input->post());

		$desc = $this->input->post('desc');
		$custo = dinheiro_sql($this->input->post('custo'));
		$lucro = dinheiro_sql($this->input->post('lucro'));
		$minima = $this->input->post('minima');
		$qtd = $this->input->post('qtd');
		$id = $this->input->post('id');
		if($this->estoque_model->salvar_alteracoes($desc,$custo,$lucro,$minima,$qtd,$id)){
			echo 'Atualizado com sucesso';
		}		
	}	

	public function produtos($id_md5=null,$tela=null){

		if(isset($id_md5) AND isset($tela)){
		$dados['alterar'] = $this->estoque_model->busca_estoque($id_md5);
		$dados['tela'] = $tela;
		}else{
		$dados['produtos'] = $this->estoque_model->listar_produtos();
		$dados['tela'] = null;	
		}

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Lista de Produtos";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-estoque');
		$this->load->view('frontend/produtos');
		//$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}	

	public function emfalta(){

		$dados['produtos'] = $this->estoque_model->listar_produtos_emfalta();

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Produtos em falta";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-estoque');
		$this->load->view('frontend/produtos-emfalta');
		//$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function servicos(){
		
		$dados['servicos'] = $this->estoque_model->listar_servicos();

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Lista de Serviços";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-servicos');
		$this->load->view('frontend/servicos');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');	
	}	

	public function novoproduto(){
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Adicionar Produto";
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-estoque');
		$this->load->view('frontend/adicionar-produto');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');	
	}	

	public function novoservico(){
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Adicionar Serviço";
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-servicos');
		$this->load->view('frontend/adicionar-servico');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');	
	}

	public function salvar(){

		$desc = $this->input->post('desc');
		if(!$this->estoque_model->verifica_desc($desc)){

			$tipo = $this->input->post('tipo');
			//1 produto 2 serviço
			if($tipo == 2){
				$lucro = 0;
				$minima = 0;
				$qtd = 1;
			}else{
				$lucro = dinheiro_sql($this->input->post('lucro'));
				$minima = $this->input->post('minima');
				$qtd = $this->input->post('qtd');			
			}

			$custo = dinheiro_sql($this->input->post('custo'));
			
			if($this->estoque_model->adicionar($desc,$custo,$lucro,$minima,$qtd)){
				echo 'Cadastrado com sucesso';
			}

		}//if valida desc
	}

	public function alterarproduto($id){
		if(!$id){
			redirect(base_url('estoque'));
		}

		$dados['alterar'] = $this->estoque_model->busca_estoque($id);
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Alterar Produto";		
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-estoque');
		$this->load->view('frontend/alterar-produto');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');	

	}	

	public function alterarservico($id){
		if(!$id){
			redirect(base_url('estoque'));
		}

		$dados['alterar'] = $this->estoque_model->busca_estoque($id);
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Alterar Serviço";		
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-estoque');
		$this->load->view('frontend/alterar-servico');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');	

	}

	

}
