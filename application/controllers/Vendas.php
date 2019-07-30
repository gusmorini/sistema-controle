<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//$this->load->model('os_model');
		$this->load->model('estoque_model');

		// verifica se esta autenticado
		if (!$_SESSION['autenticado']){
			redirect(base_url('/login'));
		}
	}

	public function index(){
		redirect(base_url('vendas/caixa'));
	}

	public function contador_caixa(){
		if(isset($_SESSION['caixa']) ){
	        $contador = count($_SESSION['caixa']);
	    }else{
	        $contador = 0;
	    }
	    echo $contador;
	}

	public function caixa_busca(){
		$key = $this->input->post('txt-key');
		$dados['busca'] = $this->estoque_model->busca_rapida($key);
		$this->load->view('frontend/caixa-busca',$dados);
	}

	public function tela_carrinho(){
		$this->load->view('frontend/caixa-carrinho');
	}

	public function mini_carrinho(){
		$this->load->view('frontend/caixa-mini-carrinho');
	}

	public function caixa(){
		if($this->input->post('txt-key')){
			$dados['key'] = $this->input->post('txt-key');
			$dados['busca_rapida'] = $this->estoque_model->busca_rapida($dados['key']);
		}else{
			$dados['key'] = '';
			/*$dados['clientes'] = $this->clientes_model->listar_clientes();*/
		}		

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Venda";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		//$this->load->view('frontend/submenu-vendas');		
		$this->load->view('frontend/caixa');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	private function limpa_caixa(){
		unset($_SESSION['caixa']);
		redirect(base_url('vendas/caixa'));
	}

	public function rem_carrinho($id){

		$id = str_replace('%20', '', $id);
		if($id){
			unset ($_SESSION['caixa'][$id]);
		}

	}

	public function atualiza_qtd($id,$qtd){
		$id = str_replace('%20', '', $id);
		$_SESSION['caixa'][$id]['qtd'] = $qtd;
	}	

	public function atualiza_valor($id,$valor){
		$id = str_replace('%20', '', $id);
		$_SESSION['caixa'][$id]['valor'] = $valor;
	}

	public function carrinho_adicionar(){

		$id_md5 = md5($this->input->post('id'));
		$qtd_item = $this->input->post('qtd_item');
		$valor = $this->input->post('valor');
		$estoque = $this->input->post('estoque');
		$tipo = $this->input->post('tipo');
		$desc = $this->input->post('desc');

		if($qtd_item <= 0){ $qtd_item = 1; }
		if($qtd_item > $estoque AND $tipo == 'Produto' ){ $qtd_item = $estoque; }

		$_SESSION['caixa'][$id_md5]['id'] = $id_md5;
		$_SESSION['caixa'][$id_md5]['qtd'] = $qtd_item;
		$_SESSION['caixa'][$id_md5]['valor'] = $valor;
		$_SESSION['caixa'][$id_md5]['estoque'] = $estoque;
		$_SESSION['caixa'][$id_md5]['tipo'] = $tipo;
		$_SESSION['caixa'][$id_md5]['desc'] = $desc;		

	}

	public function add_carrinho($id){

		$id = str_replace('%20', '', $id);
		$id_md5 = md5($id);

		$this->load->model('estoque_model');
		$res = $this->estoque_model->busca_estoque($id_md5);

		foreach($res as $row):

			$valor = $row->val_pec + $row->lucro;
			$estoque = $row->qtd_pec;
			$desc = $row->des_pec;

			if($row->lucro > 0){
				$tipo = 'Produto';
			}else{
				$tipo = 'Serviço';
			}

			$_SESSION['caixa'][$id_md5]['id'] = $id_md5;
			$_SESSION['caixa'][$id_md5]['qtd'] = 1;
			$_SESSION['caixa'][$id_md5]['valor'] = $valor;
			$_SESSION['caixa'][$id_md5]['estoque'] = $estoque;
			$_SESSION['caixa'][$id_md5]['tipo'] = $tipo;
			$_SESSION['caixa'][$id_md5]['desc'] = $desc;

		endforeach;
	}	

/*	public function recibo(){

		if($this->input->post('nome')){
			$dados['recibo_nome'] = $this->input->post('nome');
			$dados['recibo_desc'] = $this->input->post('desc');
			$dados['recibo_valor'] = $this->input->post('valor');
			$dados['recibo_extenso'] = $this->input->post('extenso');
			$dados['recibo_data'] = $this->input->post('data');
		}else{
			$dados['recibo_nome'] = '';
			$dados['recibo_desc'] = '';
			$dados['recibo_valor'] = '';			
			$dados['recibo_extenso'] = '';
			$dados['recibo_data'] = data_form();
		}		

		$dados['titulo'] = "Controle";
		$dados['subtitulo'] = "Recibo";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/submenu-vendas');		
		$this->load->view('frontend/recibo');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}*/

	public function receber(){

		$id = $this->input->post('ide_cli');
		$v_recebido = dinheiro_sql($this->input->post('valor'));
		$data = $this->input->post('data');
		$debito = $this->input->post('debito');

		if($v_recebido > $debito){
			$v_recebido = $debito;
		}

		$this->load->model('clientes_model');
		$res = $this->clientes_model->busca_ficha_cliente(md5($id));
		foreach($res as $row){
			$nome = $row->nom_cli;
		}	

		$this->estoque_model->atualiza_valor($id,$v_recebido);
		$this->estoque_model->insere_receber($id,$data,$v_recebido);
		$this->estoque_model->insere_controle($data,$nome,$v_recebido);

		echo 'ok';

		//redirect(base_url('clientes/ficha/'.md5($id)));	

	}

	public function venda_avista(){
		$valor = dinheiro_sql($this->input->post('valor'));
		$data = $this->input->post('data');
		echo "$valor $data";
		if($this->estoque_model->venda_avista($data,$valor)){
			$this->limpa_caixa();
		}
	}

	public function venda_aprazo(){
		$id = $this->input->post('ide_cli');
		$data = $this->input->post('data_venda');
		$valor = dinheiro_sql($this->input->post('val_venda'));
		$obs = $this->input->post('obs_pro');

		if($this->estoque_model->venda_aprazo($id,$data,$valor,$obs)){
			$this->limpa_caixa();
		}

	}

	public function busca_cliente_aprazo(){
		$key = $this->input->post('nome');
		$res = $this->estoque_model->busca_aprazo($key);

		if(count($res)>0){
			foreach ($res as $row){
				$nome = $row->nom_cli;
				$id = $row->ide_cli;
				echo "<a href='#' data-id='$id' data-nome='$nome' class='btn_cli list-group-item' >$nome</a>";
				//<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
			}
		}else{
			echo "<a href='#' class='list-group-item' >...</a>";
		}

	}

	public function receber_unica(){
		$ide_pro = $this->input->post('ide_pro');
		$ide_cli = $this->input->post('ide_cli');
		//$nome = $this->input->post('nome');

		$this->load->model('clientes_model');
		$res = $this->clientes_model->busca_ficha_cliente(md5($ide_cli));
		foreach($res as $row){
			$nome = $row->nom_cli;
		}

		$v_recebido = dinheiro_sql($this->input->post('val_rec'));
		$val_pro = $this->input->post('val_pro');
		$data = $this->input->post('data_rec');
		
		if( $v_recebido > $val_pro ){
			$v_recebido = $val_pro;
		}

		if($this->estoque_model->receber_unica($ide_pro,$ide_cli,$nome,$v_recebido,$data,$val_pro)){
			//redirect(base_url('clientes/ficha/'.md5($ide_cli)));
			echo "ok";
		}

	}

	public function salvar_promissoria(){
		$id = $this->input->post('ide_pro');
		$ide_cli = $this->input->post('ide_cli');
		$desc = $this->input->post('desc');
		$obs = $this->input->post('obs');
		$valor = dinheiro_sql($this->input->post('valor'));
		
		if($this->estoque_model->salvar_promissoria($id,$desc,$obs,$valor)){
			echo 'ok';
		}

	}	

}
