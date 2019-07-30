<div class="col-sm-3">

    <div class="panel panel-default">
    <div class="panel-heading">Busca clientes</div>
    <div class="panel-body">
    <?php
    echo form_open('',array('id'=>'form_busca_cliente'));
    ?>
      <div class="form-group">
            <!-- <label>Busca</label> -->
            <input type="text" id="txt-key" name="txt-key" class="form-control"autocomplete="off" placeholder="digita aqui" autofocus="">
      </div>                                              
        
    <?php
    echo form_close();
    ?>
    </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-body">
        <div class="btn-group-vertical btn-block">
<!--         <button id="btn_cadastro" class="btn btn-default">Novo Cadastro</button> -->
        <button data-toggle="modal" data-target="#modal_cadastro" class="btn btn-default">Novo Cadastro</button>
        <button id="btn_lista" class="btn btn-default">Clientes</button>
        <button id="btn_deb" class="btn btn-default">Débitos</button>
        </div>
    </div>
    </div>   

</div><!-- col -->

<div class="col-sm-9">
	<div class="panel panel-default">
	<div class="panel-heading" id="title-panel"> </div>
	<div class="panel-body">
		<div id="tela"></div>
	</div>
	</div>
</div> <!-- col -->

<?php include_once "modal-novo-cliente.php"; ?>

<script type="text/javascript">


    //tela padrão ao carregar a página
    tela_lista();

    $('#btn_lista').click(tela_lista); 

    $('#btn_deb').click(tela_debitos);//btn 

    function tela_debitos(){
        console.log('tela_debitos');
        $('#title-panel').html('Débitos');
        $('#tela').load('<?=base_url()?>clientes/tela_debitos');
    }

    function tela_lista(){
        $('#title-panel').html('Lista');
        $('#tela').load('<?=base_url('clientes/tela_lista') ?>');
    }

    //desativa a tecla ENTER nos formulários
    $('input').keypress(function(e){
    var code = null;
    code = (e.keyCode ? e.keyCode : e.which);                
    return (code == 13) ? false : true;
    });

    //busca rápida
    $('#txt-key').keyup(function(){
        var nome_form = '#form_busca_cliente';
        if($('#txt-key').val().length >= 3)
        {
            $.ajax({
                url: ' <?= base_url('clientes/busca') ?> ',
                method:'post',
                data: $(nome_form).serialize(),                             
                success: function (data)
                {
                    $('#title-panel').html('Resultado');
                    $('#tela').html(data);
                }
            });//AJAX

        }
        else
        {
            tela_lista();
        }  //IF
    });//#txt-key 

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

                    tela_lista();
                    aviso('Cadastrado');

                }
            }
        });//AJAX

        }//submit

        });//validate

        fecha_modal();


    });//btn


</script>