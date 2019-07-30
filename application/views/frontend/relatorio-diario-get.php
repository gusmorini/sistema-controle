<?php 

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

		$dias = contar_dias($inicio,$final);
		$dias ++;

		$ent = dinheiro($entrada);
		$sai = dinheiro($saida);
		$bal = dinheiro($entrada - $saida);

		?>

		<div class="col-sm-12">
			<div class="row">
		
			<div class="col-xs-3 alert alert-warning" role="alert"> <?= "Dias: $dias" ?> </div>
			<div class="col-xs-3 alert alert-success" role="alert"> <?= "Entrada: R$ $ent" ?> </div>
			<div class="col-xs-3 alert alert-danger" role="alert"> <?= "Saída: R$ $sai" ?> </div>
			<div class="col-xs-3 alert alert-info" role="alert"><?= "Balanço: R$ $bal" ?></div>
				
			</div>
		</div>

		<?php

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