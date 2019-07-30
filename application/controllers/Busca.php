<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('categorias_model','modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();

		// verifica se esta autenticado
		if (!$_SESSION['autenticado']){
			redirect(base_url('/login'));
		}
		
	}

	public function index(){
		$this->load->library('table');	
		$key = $this->input->post('txt-busca');
		$dados['categorias'] = $this->categorias;
		$this->load->model('busca_model','buscamodel');
		$dados['busca'] = $this->buscamodel->fazer_busca($key);
		$dados['titulo'] = "Busca";
		$dados['subtitulo'] = "  ";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/busca');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}
