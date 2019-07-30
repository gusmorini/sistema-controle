  <?php 

	$resultado = $this->admin_model->busca_rel_diario($datainicio,$datafinal);

	$entrada = 0;
	$saida = 0;

    if(count($resultado) > 0)
	{
	
		
		$this->table->set_heading("Data","Descrição","Tipo","Valor");
		foreach($resultado as $r)
		{
			if($r->tip_cont == 'entrada')
			{
				$entrada = $entrada + $r->val_cont;
			}
			else
			{
				$saida = $saida + $r->val_cont;
			}
			
			$data = data_brasil($r->dat_cont);
			$desc = $r->des_cont;
			$tipo = $r->tip_cont;
			$valor = 'R$ '.dinheiro($r->val_cont);
			
			$this->table->add_row($data,$desc,$tipo,$valor);
		}//foreach

		$this->table->set_template(array(
			'table_open' => '<table class="table table-striped">'
		));
		echo $this->table->generate();

	}//for count > 0
	else
	{
		?>
			<div class="col-sm-12 text-center text-info">
				<h3>Nenhum resultado</h3>
			</div>
		<?php
	}
?>