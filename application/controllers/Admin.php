<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
		
		// verifica se esta autenticado
		if (!$_SESSION['autenticado']){
			redirect(base_url('/login'));
		}
		
	}

	public function index(){

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "financeiro";		
		
		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		//$this->load->view('frontend/submenu-admin');
		$this->load->view('frontend/admin');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');

	}	

	public function retirada(){
		//$dados['os'] = $this->os_model->listar_os();

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Adicionar Retirada";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-admin');
		$this->load->view('frontend/adicionar-retirada');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function adicionar_retirada(){
		
		$desc = $this->input->post('desc');
		$valor = dinheiro_sql($this->input->post('valor'));
		$data = $this->input->post('data');

		$this->admin_model->adicionar_retirada($desc,$valor,$data);

	}

	public function rel_anual(){

		$this->load->view('frontend/relatorio-anual');

	}

	public function rel_anual_get(){
		$dados['ano']  = $this->input->post('ano');
		$this->load->view('frontend/relatorio-anual-get',$dados);
	}	
	
	public function rel_diario(){
	
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Relatório Diário";
		
		if($this->input->post('inicio') AND $this->input->post('final') AND $this->input->post('inicio') <= $this->input->post('final'))
		{
			$dados['datainicio'] = $this->input->post('inicio');
			$dados['datafinal'] = $this->input->post('final');
		}else
		{
			$dados['datainicio'] = data_form();
			$dados['datafinal'] = data_form();
		}
	
		$this->load->view('frontend/relatorio-diario',$dados);

	}

	public function rel_diario_get(){

		$inicio = $this->input->post('inicio');
		$final = $this->input->post('final');

		$data_hoje = data_usa();

		if($inicio == ''){
			$inicio = $data_hoje;
		}else if ($final == ''){
			$final = $data_hoje;
		}else if($inicio > $data_hoje){
			$inicio = $data_hoje;
		}else if($final > $data_hoje){
			$final = $data_hoje;
		}else if($inicio > $final){
			$inicio = $final;
		}

		$dados['inicio'] = $inicio;
		$dados['final'] = $final;

		$dados['resultado'] =  $this->admin_model->busca_rel_diario($inicio,$final);
		$this->load->view('frontend/relatorio-diario-get',$dados);

	}

	public function tela_recibo(){

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Recibo";
		$this->load->view('frontend/recibo',$dados);
	
	}

	public function recibo_corpo(){

		$dados['recibo'] = $this->input->post();

		$this->load->view('frontend/recibo-corpo',$dados);

	}	

}
