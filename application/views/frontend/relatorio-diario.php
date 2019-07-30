<div class="col-md-9">

<div class="panel panel-default">
<div class="panel-heading">Relatório diário</div>
<div class="panel-body">

<div id="resultado">
	<div class="text-center">
		<img src="./assets/frontend/img/pages/relatorio1.png" style="height: 300px;" >
	</div>

</div>

</div>
</div>
	
</div>

<div class="col-md-3">
	<div class="panel panel-default">
	  <div class="panel-heading">Inicio e Final</div>
	  <div class="panel-body">

	  <?php 
	  
	  //echo form_open('admin/relatoriodiario');
	  echo form_open('#',array('id'=>'form_rel_diario'));

	  ?>
	  <div class="form-group">
	    <label>Data Inicio </label>
	    <input type="date" name="inicio" class="form-control" value="<?= $datainicio ?>" required>
	  </div>
	  <div class="form-group">
	    <label>Data Final</label>
	    <input type="date" name="final" class="form-control" value="<?= $datafinal ?>" required>
	  </div>
	  <button type='button' id="btn_rel_diario" class='btn btn-default'>enviar</button>
		<?php
			echo form_close();
		?>
	</div>
	</div>  

	<div class="panel panel-default">
	<div class="panel-body">
		<button type="button" id="retirada" class="btn btn-default btn-block">Adicionar retirada</button>
	</div>
	</div>

	<div id="alerta"></div>


</div><!-- col -->

<script type="text/javascript">

	$('#retirada').click(function(){
		$('#modal_retirada').modal('show'); 
	});

	// submit form
    $('#btn_rel_diario').click(function(){

        var id_form = '#form_rel_diario';
        var local = '<?= base_url('admin/rel_diario_get') ?>';

		$.ajax({
		url: local,
		method:'post',
		data: $(id_form).serialize(),                             
		success: function (data)
		{
			$('#resultado').html(data);
		}
		});//AJAX     	
        
    });//relatorio-get()

</script>