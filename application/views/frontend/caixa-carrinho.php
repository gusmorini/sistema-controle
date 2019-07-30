    <?php

        $this->table->set_heading("Qtd","Descrição","Unitátio","Sub-total","...");

        //echo form_open(base_url('vendas/atualizar_caixa'));
        echo form_open('',array('id'=>'form_carrinho','autocomplete'=>'off'));

        $val_total = 0;

        if( isset($_SESSION['caixa']) AND ( count($_SESSION['caixa']) > 0) ){
            
            foreach($_SESSION['caixa'] as $caixa):
                
                $id_md5 = $caixa['id'];
                $qtd_item = $caixa['qtd'];
                $valor_item = $caixa['valor'];
                $sub_item = $valor_item * $qtd_item;
                $val_total = $val_total + $sub_item;
                $desc = $caixa['desc'];
                $estoque = $caixa['estoque'];
                $tipo = $caixa['tipo'];

                if($tipo == 'Produto'){
                    $max = "max='$estoque'";
                }else{
                    $max = "";
                } 

                //$rem = anchor(base_url('vendas/remover/'.$id_md5),'remover');

                $rem = "<a href='#' class='remove_item' data-id=' ".$id_md5."' title='remover' > 
                        <i class='glyphicon glyphicon-remove'></i></a> ";

                $q_item = "<input type='number' autocomplete='off' name='qtd_item[]' min='1' $max value='$qtd_item' class='item-caixa qtd_item' data-id=' ".$id_md5."' required >";

                $v_item = "<input type='text' autocomplete='off' name='val_item[]' class='item-caixa money val_item' data-id=' ".$id_md5."' value='".dinheiro($valor_item)."' required >";

                echo form_hidden('id_item[]',$id_md5);


                $this->table->add_row($q_item,$desc,'R$ '.$v_item,'R$ '.dinheiro($sub_item),$rem);


            endforeach;
            $this->table->set_template(array('table_open' => '<table class="table table-striped">'));
            echo $this->table->generate();

            //echo form_submit('atualizar','Atualizar',array('class'=>'btn btn-default'));

            echo form_close();

            ?>

            <h4 class='pull-right text-primary'>R$ <?=dinheiro($val_total)?></h4>

            <?php

        }else{
            $this->load->view('frontend/nada');
        }

    ?>

<script type="text/javascript">
    
    $('.money').mask('000.000.000.000.000,00', {reverse: true});

    $('.remove_item').click(function(){

        var id = $(this).attr('data-id');
        $.ajax({
                url: '<?=base_url()?>vendas/rem_carrinho/'+id,                            
                success: function (data)
                {
                    tela_carrinho();
                    mini_carrinho();
                    contador();
                    aviso('item removido');
                }
            });//AJAX

    });

    //atualiza qtd
    $('.qtd_item').change(function(){

        var qtd = $(this).val();
        var id = $(this).attr('data-id');

        if(qtd > 0){
            
            $.ajax({
                url: '<?=base_url()?>vendas/atualiza_qtd/'+id+'/'+qtd,
                success: function(data){
                    tela_carrinho();
                    mini_carrinho();
                }
            });                   
        }


    });//atualizar qtd     

    //atualiza valor
    $('.val_item').change(function(){

        var val = converteMoedaFloat($(this).val() );
        var id = $(this).attr('data-id');

        if(val > 0){
            $.ajax({
                url: '<?=base_url()?>vendas/atualiza_valor/'+id+'/'+val,
                success: function(data){
                    tela_carrinho();
                    mini_carrinho();
                }
            });
        }     

    });//atualizar qtd 

</script>