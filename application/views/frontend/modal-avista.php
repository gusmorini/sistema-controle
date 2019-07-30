<!-- MODAL á vista -->
<div class="modal fade" id="myModal-avista">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">

        <?php
            //echo form_open(base_url('vendas/venda_avista'),array('autocomplete'=>'off'));
            echo form_open('#',array('id'=>'form_avista','autocomplete'=>'off'));
        ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
            </button>
            <span class="modal-title">Venda à vista</span>
        </div><!-- modal-header -->

        <div class="modal-body">

            <div class="form-group">
                <label>Valor da venda</label>
                <input type="text" value="<?= dinheiro($val_total) ?>" class="form-control" disabled>
            </div>

            <div class="form-group">
                <label>data</label>
                <input type="date" name="data" id="data" value='<?= data_usa() ?>' class="form-control">
            </div>

            <div class="form-group">
                <label>Valor Recebido</label>
                <input type="text" name="valor" id="valor" value="<?= dinheiro($val_total) ?>" class="form-control money">
            </div>                    
        </div><!-- modal-body -->

        <div id="erro" class="text-danger"></div>

        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-warning" data-dismiss="modal">Cancela</button> -->
            <button type="submit" id="btn_avista" class="submit btn btn-success" value="submit">Confirma</button>
        </div><!-- modal.footer -->
        
        <?php

            echo form_close();

        ?>

    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->

<script type="text/javascript">

    //receber
    $('#btn_avista').click(function(){

        $("#form_avista").validate({
            
            rules:{
                data:{required:true},
                valor:{required:true, valor_min:true}
            },

            messages:{
                data:{ required:'data requerida'},
                valor:{ required:'valor requerido'}
            },

            submitHandler: function( form ){
                
                var nome_form = '#form_avista';
                var local = '<?= base_url('vendas/venda_avista') ?>';

                console.log('entrou if');
                
                $.ajax({
                    url: local,
                    method:'post',
                    data: $(nome_form).serialize(),                             
                    success: function (data)
                    {
                        tela_carrinho();
                        mini_carrinho(); 
                        contador();
                        aviso('Venda à vista Realizada');
                    }
                });//AJAX 

                fecha_modal();

            }//submit


        });
                   
    });//receber

</script>