<div class="modal fade" id="myModal-aprazo">
    <div class="modal-dialog"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
        <div class="modal-content">

            <!-- <form name="prazo" id="prazo" method="post" action="carrinho-aprazo" autocomplete="off"> -->
            
            <?php

                echo form_open('#',array('id'=>'form_aprazo','autocomplete'=>'off','class'=>'cmxform'));

            ?>

            <input type="hidden" name="ide_cli" id="ide_cli" >

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
                </button>
                <h4 class="modal-title">Venda à prazo</h4>
            </div><!-- modal-header -->

            <div class="modal-body">

                <div class="form-group">
                    <label>Cliente</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder='Digite o nome do cliente'>
                    <div id="resultado" class="busca-aprazo list-group"  ></div>
                </div>

                <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>data</label>
                        <input type="date" name="data_venda" id="data_venda" value="<?= data_usa() ?>" class="form-control" autocomplete="off">
                    </div>                  
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Total</label>
                        <input type="text" name="val_venda" id="val_venda" value="<?= dinheiro($val_total) ?> " 
                        required class="form-control money">
                    </div>                  
                </div>

                </div>

                <div class="form-group">
                    <label>Observação</label>
                    <input type="text" name="obs_pro" id="obs_pro" placeholder='Observação' class="form-control">
                </div>

                
            </div><!-- modal-body -->

            <div class="modal-footer">
                <button type="submit" id="btn_aprazo" name="submit" class="btn btn-success">Confirmar</button>
            </div><!-- modal.footer -->

            </form> 

        </div><!-- modal-content -->
    </div><!-- modal.dialog -->
</div><!-- modal -->

<script type="text/javascript">

    $('#resultado').hide();
    
    //busca rápida
    $('#nome').keyup(function(){
        
        var nome_form = '#form_aprazo';
        var local = '<?= base_url('vendas/busca_cliente_aprazo') ?>';
        
            if($('#nome').val().length > 2){
                
                $('#resultado').show();
                
                $.ajax({
                    url: local,
                    method:'post',
                    data: $(nome_form).serialize(),                             
                    success: function (data)
                    {
                        $('#resultado').html(data);

                        $('.btn_cli').click(function(){

                            var id = $(this).attr('data-id');
                            var nome = $(this).attr('data-nome');

                            $('#ide_cli').val(id);
                            $('#resultado').hide();
                            $(this).val('');
                            $('#nome').val(nome);

                        });                    
                    }
                });//AJAX
            }else{
               $('#resultado').hide(); 
            }
        
    });//#busca-rapida

    //receber aprazo
    $('#btn_aprazo').click(function(){

        $("#form_aprazo").validate({
            
            rules:{
                data_venda:{required:true},
                val_venda:{required:true, valor_min:true},
                nome:{required:true}
            },

            messages:{
                data_venda:{ required:'data requerida'},
                val_venda:{ required:'valor requerido'},
                nome:{required:'nome requerido'}
            },

            submitHandler: function( form ){
             
                var nome_form = '#form_aprazo';
                var local = '<?= base_url('vendas/venda_aprazo') ?>';
                
                $.ajax({
                    url: local,
                    method:'post',
                    data: $(nome_form).serialize(),                             
                    success: function (data)
                    {
                        console.log(data);
                        tela_carrinho();
                        mini_carrinho(); 
                        contador();
                        aviso('Venda à Prazo Realizada');
                    }
                });//AJAX

                fecha_modal();

            }//submit
            
        });// validate
        

    });//receber  aprazo  

</script>