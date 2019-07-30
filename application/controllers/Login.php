<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('login_model');
	}

	public function index(){

        // verifica se esta autenticado
		if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == true){
			redirect(base_url('/home'));
        }
		
		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Login";

		$this->load->view('frontend/template/html-header',$dados);
		//$this->load->view('frontend/template/header');
	    $this->load->view('frontend/login');
		// //$this->load->view('frontend/home-aside');
		// $this->load->view('frontend/template/footer');
		// $this->load->view('frontend/template/html-footer');
    }
    
    public function autenticar(){

        // verifica se esta autenticado
		if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == true){
			redirect(base_url('/home'));
        }
        
        $user = $this->input->post('usuario');
        $pass = md5($this->input->post('senha'));

        if($this->login_model->get_user($user, $pass)){
            
            $_SESSION['autenticado'] = true;
            redirect(base_url());

        } else {

            $dados['titulo'] = "Controle";
            $dados['subtitulo'] = "Erro";
            
            $dados['erro'] = "usuario ou senha inválidos";
            $dados['user'] = $user;
            
            $this->load->view('frontend/template/html-header',$dados);
            $this->load->view('frontend/login');

        }
        
    }

    public function sair(){
        $_SESSION['autenticado'] = false;
        redirect(base_url('/login'));
    }


}
