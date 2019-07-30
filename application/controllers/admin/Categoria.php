<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logado')){
		redirect(base_url('admin/login'));
		}
		$this->load->model('categorias_model','modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();		
	}

	public function index(){
		$this->load->library('table');
		$dados['categorias'] = $this->categorias;
		//cabeçalho dinâmico
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "Categoria";

		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/categoria');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-categoria','Nome da categoria',
			'required|min_length[3]|is_unique[categoria.titulo]');
		if($this->form_validation->run()==FALSE){
			$this->index();
		}else{
			$titulo = $this->input->post('txt-categoria');
			if($this->modelcategorias->adicionar($titulo)){
				redirect(base_url('admin/categoria'));
			}else{
				echo "Houve um erro no sistema!";
			}
		}
	}

	public function excluir($id){
		if($this->modelcategorias->excluir($id)){
			redirect(base_url('admin/categoria'));
		}else{
			echo "Houve um erro no sistema!";
		}		
	}

	public function editar($id){
		$dados['categorias'] = $this->modelcategorias->listar_titulo($id);
		//cabeçalho dinâmico
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "Categoria";
		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-categoria');
		$this->load->view('backend/template/html-footer');		
	}

	public function salvar_alteracoes(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-categoria','Nome da categoria',
			'required|min_length[3]|is_unique[categoria.titulo]');
		if($this->form_validation->run()==FALSE){
			//$this->index();
			$id = md5($this->input->post('txt-id'));
			$this->editar($id);
		}else{
			$id = $this->input->post('txt-id');
			$titulo = $this->input->post('txt-categoria');
			if($this->modelcategorias->alterar($id,$titulo)){
				redirect(base_url('admin/categoria'));
			}else{
				echo "Houve um erro no sistema!";
			}
		}		
	}

}
