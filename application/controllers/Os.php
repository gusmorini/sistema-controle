<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('os_model');
		
		// verifica se esta autenticado
		if (!$_SESSION['autenticado']){
			redirect(base_url('/login'));
		}		
	
	}
	

	public function index(){
		$this->load->library('table');
		$dados['os'] = $this->os_model->listar_os();

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Ordem de Serviço";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');	
		$this->load->view('frontend/os');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function busca(){

		//se não existir o campo ele define a busca em branco para retornar a lista completa
		if(!$this->input->post('txt-key')){
			$key='';
		}else{
			$key = $this->input->post('txt-key');
		}

		$dados['busca'] = $this->os_model->busca($key);
		$this->load->view('frontend/os-busca',$dados);

	}

	public function busca_arquivo(){
		$key = '';
		$dados['arquivo'] = $this->os_model->busca_arquivo($key);
		$this->load->view('frontend/os-arquivo',$dados);
	}	

	public function busca_ordem($id){
		$id = str_replace('%20', '', $id);
		$dados['busca_ordem'] = $this->os_model->busca_ordem($id);
		$this->load->view('frontend/os-vermais',$dados);
	}	

	public function busca_ordem_arquivo($id){
		$id = str_replace('%20', '', $id);
		$dados['arquivo'] = $this->os_model->busca_ordem($id);
		$this->load->view('frontend/os-vermais-arquivo',$dados);
	}	

	public function arquivar_ordem($id){
		$id = str_replace('%20', '', $id);
		$this->os_model->arquivar_ordem($id);
	}	

	public function reativar_ordem($id){
		$id = str_replace('%20', '', $id);
		$this->os_model->reativar_ordem($id);
	}

	public function cadastro(){
		
		$nom_lem = $this->input->post('nome');
		$tel_lem = $this->input->post('telefone');
		$tex_lem = $this->input->post('desc');

		print_r($this->input->post());

		$this->os_model->cadastro($nom_lem,$tel_lem,$tex_lem);

/*		if($this->os_model->salvar_alteracoes($nom_lem,$tel_lem,$tex_lem,$id)){
			echo 'ok';
		}*/
	}	

	public function salvar_alteracoes(){
		
		$nom_lem = $this->input->post('nome');
		$tel_lem = $this->input->post('telefone');
		$tex_lem = $this->input->post('desc');
		$id = $this->input->post('id');
		$this->os_model->salvar_alteracoes($nom_lem,$tel_lem,$tex_lem,$id);
	
	}	

	public function arquivo(){
		$this->load->library('table');
		$dados['os'] = $this->os_model->listar_os_arquivo();

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Arquivo de Ordem de Serviço";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-admin');		
		$this->load->view('frontend/os-arquivo');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}	

	public function inserir(){
		$nom_lem = $this->input->post('nom_lem');
		$tel_lem = $this->input->post('tel1').' : '.$this->input->post('tel2');
		$tex_lem = $this->input->post('tex_lem');
		if($this->os_model->adicionar($nom_lem,$tel_lem,$tex_lem)){
			redirect(base_url('os'));
		}else{
			echo "Houve um erro no sistema!";
		}
	}	


	public function add(){
		
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Nova Ordem de Serviço";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-servicos');		
		$this->load->view('frontend/adicionar-os');
		//$this->load->view('frontend/home-aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function vermais($id){
		if(!$id){
			redirect(base_url('estoque/servicos'));
		}
		$dados['alterar'] = $this->os_model->busca_ordem($id);
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Detalhes Ordem de Serviço";
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-servicos');
		$this->load->view('frontend/vermais-os');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');	

	}		

	public function alterarordem($id){
		if(!$id){
			redirect(base_url('estoque/servicos'));
		}
		$dados['alterar'] = $this->os_model->busca_ordem($id);
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Alterar Ordem de Serviço";
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-servicos');
		$this->load->view('frontend/alterar-os');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');	

	}

	public function arquivar(){
		$id = $this->input->post('id');
		for($i = 0; $i < count($id); $i++) {
			$id_arquiva = $id[$i];
			$this->os_model->arquivar($id_arquiva);
		}//for
		redirect(base_url('os'));		
	}	

	public function desarquivar(){
		$id = $this->input->post('id');
		for($i = 0; $i < count($id); $i++) {
			$id_arquiva = $id[$i];
			$this->os_model->desarquivar($id_arquiva);
		}//for
		redirect(base_url('os'));		
	}	

}
