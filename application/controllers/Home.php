<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('home_model');

		// verifica se esta autenticado
		if (!$_SESSION['autenticado']){
			redirect(base_url('/login'));
		}
	}

	public function index(){

		
		
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Home";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/home');
		//$this->load->view('frontend/home-aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function get_ordem_servico(){

		$dados = $this->home_model->get_ordem_servico();
		$this->table->set_heading("Cod","Nome");
		foreach($dados as $row):
		$this->table->add_row($row->ide_lem,$row->nom_lem);
		endforeach;
		$this->table->set_template(array('table_open' => '<table class="table table-striped">'));
        echo $this->table->generate();

	}

	public function get_caixa(){

		$dados = $this->home_model->get_caixa();
		$this->table->set_heading("Data","Descrição");
		foreach($dados as $row):
		$this->table->add_row(data_brasil($row->dat_cont),$row->des_cont);
		endforeach;
		$this->table->set_template(array('table_open' => '<table class="table table-striped">'));
        echo $this->table->generate();

	}


}
