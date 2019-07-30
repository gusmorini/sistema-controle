<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}		
		$this->load->model('postagens_model','modelpostagem');		
	}

	public function index(){
		$this->load->library('table');
		$id = $this->session->userdata('userlogado')->id;
		$dados['postagens'] = $this->modelpostagem->listar_postagens($id);
		$dados['categorias'] = $this->modelpostagem->listar_categoria();
		$dados['autores'] = $this->modelpostagem->listar_autores();
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "Postagens";
		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/postagens');
		$this->load->view('backend/template/html-footer');
	}

	public function alterar($id){
		$dados['postagens'] = $this->modelpostagem->listar_postagem($id);
		$dados['categorias'] = $this->modelpostagem->listar_categoria();
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "Postagem";
		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-postagens');
		$this->load->view('backend/template/html-footer');		

	}

	public function salvar_alteracoes(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-titulo','Titulo','required|min_length[3]');
		$this->form_validation->set_rules('txt-subtitulo','Subtitulo','required|min_length[3]');
		$this->form_validation->set_rules('txt-conteudo','Conteúdo','required|min_length[3]');
		if($this->form_validation->run()==FALSE){
			$id = md5($this->input->post('txt-id'));
			$this->alterar($id);
		}else{
			$id = $this->input->post('txt-id');
			$titulo = $this->input->post('txt-titulo');
			$subtitulo = $this->input->post('txt-subtitulo');
			$conteudo = $this->input->post('txt-conteudo');
			$categoria = $this->input->post('txt-categoria');
			if($this->modelpostagem->alterar($id,$titulo,$subtitulo,$conteudo,$categoria)){
				redirect(base_url('admin/postagens/'));
			}else{
				echo "Houve um erro no sistema!";
			}
		}
	}

	public function excluir($id){
		if($this->modelpostagem->excluir($id)){
			redirect(base_url('admin/postagens'));
		}else{
			echo "Houve um erro no sistema!";
		}		
	}

	public function inserir(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-titulo','Titulo','required|min_length[3]');
		$this->form_validation->set_rules('txt-subtitulo','Subtitulo','required|min_length[3]');
		$this->form_validation->set_rules('txt-conteudo','Conteúdo','required|min_length[3]');
		if($this->form_validation->run()==FALSE){
			$this->index();
		}else{
			$titulo = $this->input->post('txt-titulo');
			$subtitulo = $this->input->post('txt-subtitulo');
			$conteudo = $this->input->post('txt-conteudo');
			$categoria = $this->input->post('txt-categoria');
			$user = $this->input->post('txt-autor');
			echo "$titulo - $subtitulo - $conteudo - $categoria - $user";
			if($this->modelpostagem->adicionar($titulo,$subtitulo,$conteudo,$categoria,$user)){
				redirect(base_url('admin/postagens'));
			}else{
				echo "Houve um erro no sistema!";
			}
		}
	}

	public function nova_foto(){
		$id = $this->input->post('id');
		$config['upload_path']='./assets/frontend/img/postagens';
		$config['allowed_types']='jpg|png|gif';
		$config['file_name']=$id.".jpg";
		$config['overwrite']=TRUE;
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload()){
			echo $this->upload->display_errors();
		}else{
			$config2['source_image']='./assets/frontend/img/postagens/'.$id.'.jpg';
			$config2['create_thumb']=FALSE;
			//$config2['width']=800;
			$config2['height']=300;
			$this->load->library('image_lib',$config2);
			if($this->image_lib->resize()){
				if($this->modelpostagem->alterar_img($id)){
				redirect(base_url('admin/postagens/alterar/'.$id));
				}else{
				echo "Houve um erro no sistema!";
				}
			}else{
				echo $this->image_lib->display_errors();
			}
		}		
	}	

}
