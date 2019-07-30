<?php

echo form_open('#',array('id'=>'form_pessoa','autocomplete'=>'off')  );

?>

<div class="form-group col-sm-6">
		<label>Tipo</label>
        <select class="form-control" id="tipo" name="tipo">
        	<option value="1">Pessoa Fisica</option>
        	<option value="2">Pessoa Jurídica</option>
        </select>
  </div>	

  <div class="form-group col-sm-6">
		<label>Nome</label>
        <input type="text" name="nome" class="form-control">
  </div>			  
  <div class="form-group col-sm-6">
		<label>endereço</label>
        <input type="text" name="end" class="form-control">
  </div>		  
  <div class="form-group col-sm-6">
		<label>telefone</label>
        <input type="text" name="tel" class="form-control phone">
  </div>

  <div id="campo-fisica">
  <div class="form-group col-sm-6">
		<label>RG</label>
        <input type="text" name="rg" id="rg" class="m-num form-control")">
  </div>
  <div class="form-group col-sm-6">
		<label>CPF</label>
        <input type="text" name="cpf" id="cpf" class="m-cpf form-control cpf">
  </div>
  </div>		  

  <div id="campo-juridica">
  <div class="form-group col-sm-6">
		<label>CNPJ</label>
        <input type="text" name="cnpj" id="cnpj" class="form-control cnpj">
  </div>
  <div class="form-group col-sm-6">
		<label>I.E</label>
        <input type="text" name="ie" id="ie" class="form-control">
  </div>
  </div>

  <div class="col-sm-12">
	<button type="submit" id='btn_cadastrar' class="btn btn-default">cadastrar</button>
	<div id="alerta" class="pull-right"></div>
  </div>		  	  

<?php
echo form_close();
?> 


<script type="text/javascript">
	
	$('#campo-juridica').hide();

	$('#btn_cadastrar').click(function(){

		var id_form = '#form_pessoa';
		var local = ' <?= base_url('clientes/adicionar_pessoa') ?> ';
		var id_modal = '#modal_cadastro';

        $(id_form).validate({
           
            rules:{
                nome:{required:true}
            },

        submitHandler: function(form){

	    $.ajax({
	        url: local,
	        method:'post',
	        data: $(id_form).serialize(),                             
	        success: function (data)
	        {
	        	if(data == ''){
					$('#alerta').html('cliente já cadastrado');
	        	}else{
	        		//$('#alerta').html(data);
	        		$(id_form)[0].reset();

	        	}
	        }
	    });//AJAX

		}//submit

		});//validate

	});//btn

	$( "#tipo" ).change(function() {
	  if($('#tipo').val() == 2){
	  	$('#campo-fisica').hide();
	  	$('#rg').val('');
	  	$('#cpf').val('');
	  	$('#campo-juridica').show();
	  }else{
		$('#campo-juridica').hide();
		$('#cnpj').val('');
	  	$('#ie').val('');
		$('#campo-fisica').show();
	  }
	});

	$('.phone').mask('0 0000-0000');
	$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
	$('.cpf').mask('000.000.000-00', {reverse: true});


</script>