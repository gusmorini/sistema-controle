<div class="col-sm-9">

<div id="submenu" > submenu </div>

<!-- <div id="tela"></div> -->

</div><!-- col -->


<!-- MODAL receber -->
<div class="modal fade" id="modal_alterar">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
            </button>
            <span class="modal-title">Alterar Cadastro</span>
        </div><!-- modal-header -->

        <div class="modal-body">

        <?php
        echo form_open('#',array('id'=>'form_pessoa','autocomplete'=>'off','class'=>'cmxform'));

        foreach($clientes as $row){

            $nome = $row->nom_cli;
            $end = $row->end_cli;
            $tel = $row->tel_cli;
            $i1 = $row->item1;
            $i2 = $row->item2;
            $tipo = $row->tip_cli;
            $id = $row->ide_cli;

            if($row->tip_cli == 1){
                $label_1 = "RG";
                $label_2 = "CPF";
            }else{
                $label_1 = "CNPJ";
                $label_2 = "I.E";
            }

        ?>
        <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= $nome ?>">
        </div>              
        <div class="form-group">
        <label>Endereço</label>
        <input type="text" name="end" class="form-control" value="<?= $end ?>">
        </div>          
        <div class="form-group">
        <label>Telefone</label>
        <input type="text" name="tel" class="form-control phone" value="<?= $tel ?>">
        </div>
        <?php
            if($tipo == 1){

            ?>
            <div class="form-group">
            <label>RG</label>
            <input type="text" name="rg" class="form-control" value="<?= $i1 ?>">
            </div>
            <div class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control cpf" value="<?= $i2 ?>">
            </div> 
            <?php

            }else{

            ?>
            <div class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" class="form-control cnpj" value="<?= $i1 ?>">
            </div>
            <div class="form-group">
            <label>IE</label>
            <input type="text" name="ie" class="form-control " value="<?= $i2 ?>">
            </div>
            <?php

            }
        ?>              
             
        <input type="hidden" name="tipo" value="<?= $tipo ?>">
        <input type="hidden" name="id" value="<?= $id ?>">

        </div><!-- modal-body -->

        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button> -->
            <button type="submit" class="btn btn-success" id="btn_cad">Confirma</button>
        </div><!-- modal.footer -->
        <?php
        } // foreach
        echo form_close();
        ?>
    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->
</div><!-- col -->

<script type="text/javascript">
$(document).ready(function(){

    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    //$('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.phone').mask('0 0000-0000');

    tela_debitos();
    
    $('#btn_debitos').click(function(){
        tela_debitos();
    });    

    $('#btn_historico').click(function(){
        tela_historico();
    });    

    $('#btn_alterar').click(function(){
        tela_alterar();
    });

    function tela_historico(){
        $.ajax({
            url: '<?=base_url("clientes/tela_ficha_historico/".$id) ?>',
            success: function(data){
                $('#submenu').html(data);
            }

        });
    }

    function tela_alterar(){
        $.ajax({
            url: '<?=base_url("clientes/tela_ficha_alterar_pessoa/".$id) ?>',
            success: function(data){
                $('#submenu').html(data);
            }

        });
    }

    function tela_debitos(){
        $.ajax({
            url: '<?=base_url("clientes/tela_ficha_debitos/".$id) ?>',
            success: function(data){
                $('#submenu').html(data);
            }

        });
    }

    $('#btn_cad').click(function(){

        $("#form_pessoa").validate({
            
            rules:{
                nome:{ required:true }
            },

            messages:{
                nome:{ required:'nome requerido'}
            },

            submitHandler: function( form ){
             
            var nome_form = '#form_pessoa';
            $.ajax({
                url: ' <?= base_url('clientes/salvar_alteracoes') ?> ',
                method:'post',
                data: $(nome_form).serialize(),                             
                success: function (data)
                {
                    location.reload();
                }
            });//AJAX

            }//submitHandler

        });//validate

    });//btn 

});//document      

</script>