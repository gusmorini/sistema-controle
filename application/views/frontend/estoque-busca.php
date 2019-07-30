<?php

    if(count($busca) > 0){

    $this->table->set_heading("id","Qtd","Descrição","Valor","Tipo","...");
    
    foreach($busca as $row){
        
        $id = $row->ide_pec;
        $qtd = ( $row->lucro > 0 ? $row->qtd_pec : '...');
        $desc = $row->des_pec;
        $valor = 'R$ '.dinheiro($row->val_pec + $row->lucro);
        $tipo = ($row->lucro > 0 ? 'Produto': 'Serviço');

/*        $alterar = anchor(base_url('estoque/ficha/'.md5($id)),
            '<i class="glyphicon glyphicon-paperclip"></i>',array('title'=>'arquivo','class'=>'chama-modal'));*/
        //$alterar = anchor(base_url('estoque/produtos/'.md5($id).'/1'),'Alterar');

        $alterar = "<a href='#' class='chama-modal' data-ide_pec='$id' ><i class='glyphicon glyphicon-paperclip'></i></a>";
        
        $this->table->add_row($id,$qtd,$desc,$valor,$tipo,$alterar);
    }
    $this->table->set_template(array(
        'table_open' => '<table class="table table-striped">'
    ));
    echo $this->table->generate();
    
    echo escreve_resultado($busca);
    
    }else{
        $this->load->view('frontend/nada');
    }

?> 

<!-- MODAL á vista -->
<div class="modal fade" id="modal_editar">
<div class="modal-dialog modal-sm"><!-- aqui pode definir o tamanho do modal (modal-sm, modal-lg) pequeno ou grande -->
    <div class="modal-content">

        <?php
        //echo form_open(base_url('vendas/venda_avista'),array('autocomplete'=>'off'));
        echo form_open('#',array('id'=>'form_update','autocomplete'=>'off'));
        ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>  <!-- &times o html fornece um X -->  
            </button>
            <span class="modal-title"></span>
        </div><!-- modal-header -->

        <div class="modal-body">

            
        conteudo

        </div><!-- modal-body -->

        <div id="erro" class="text-danger"></div>

        <div class="modal-footer">
            <!-- <button type="submit" id="btn_avista" class="submit btn btn-success" value="submit">Confirma</button> -->
            <button type="button" id="btn_editar" class="btn btn-default">alterar</button>      
            <button type="submit" id="btn_update" class="btn btn-success">salvar</button>       
            <!-- <button type="button" id="btn_cancel" class="btn btn-warning sr-only">cancelar</button> -->             
        </div><!-- modal.footer -->
        
        <?php
        echo form_close();
        ?>

    </div><!-- modal-content -->
</div><!-- modal.dialog -->
</div><!-- modal -->

<script type="text/javascript">
    
    $('.chama-modal').click(function(){
        $('#modal_editar').modal({
            show:true,
            keybord:false
        });

        var ide_pec = $(this).attr('data-ide_pec');

        $.ajax({
            url: '<?=base_url("estoque/ficha/") ?>'+ide_pec,
            success: function(data){
                $('#modal_editar .modal-title').html('Editar item do estoque, código: '+ide_pec);
                $('#modal_editar .modal-body').html(data);
            }

        });

    });

</script>