<div class="col-sm-3">

    <div class="panel panel-default">
    <div class="panel-heading">Busca estoque</div>
    <div class="panel-body">
    <?php
    echo form_open('',array('id'=>'form_busca'));
    ?>
      <div class="form-group">
            <!-- <label>Busca</label> -->
            <input type="text" id="txt-key" name="txt-key" class="form-control" autocomplete="off" placeholder="busca estoque" autofocus="">
      </div>                                              
        
    <?php
    echo form_close();
    ?>  
    </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-body">

    <div class="btn-group-vertical btn-block    ">
    <button id="btn_novo" class="btn btn-default ">Novo Cadastro</button>
    <button id="btn_lis" class="btn btn-default ">Estoque lista</button>
    <button id="btn_falta" class="btn btn-default ">Produtos em falta</button>
    </div>

    </div>
    </div>

</div><!-- col -->

<div class="col-sm-9">
	<div class="panel panel-default">
	<div class="panel-heading" id="title-panel"></div>
	<div class="panel-body">
		<div id="tela"></div>
	</div>
	</div>
</div><!-- col -->

<?php include_once "modal-novo-produto.php";  ?>

<script type="text/javascript">

    function tela_emfalta(){

        $('#title-panel').html('Produtos em falta');

        $.ajax({
            url: '<?=base_url()?>estoque/tela_emfalta',
            success: function(data){
                $('#tela').html(data);
            }

        });
    }    

    function tela_lista(){

        $('#title-panel').html('Lista do estoque');

        $.ajax({
            url: '<?=base_url()?>estoque/busca',
            success: function(data){
                $('#tela').html(data);
            }

        });
    }

    $('#btn_novo').click(function(){

        $('#modal_cadastro').modal('show');

    });

    tela_lista();   

    $('#btn_lis').click(tela_lista);   

    $('#btn_falta').click(tela_emfalta);

    //desativa a tecla ENTER nos formulários
    $('input').keypress(function(e){
    var code = null;
    code = (e.keyCode ? e.keyCode : e.which);                
    return (code == 13) ? false : true;
    });

    $('#txt-key').keyup(function(){
        var nome_form = '#form_busca';
        if($('#txt-key').val().length >= 3)
        {
            $.ajax({
                url: ' <?= base_url('estoque/busca') ?> ',
                method:'post',
                data: $(nome_form).serialize(),                             
                success: function (data)
                {
                $('#title-panel').html('Resultado');
                $('#tela').html(data);
                }
            });//AJAX

        }

    });//#txt-key    

</script>