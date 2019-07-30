<div class="panel panel-default">
    <div class="panel-heading">resumo
     <button type="button" id="btn_tela_carrinho" class="btn btn-default btn-xs pull-right">Carrinho</button>
     </div>
    <div class="panel-body">
        
    <?php

        if( isset($_SESSION['caixa']) AND ( count($_SESSION['caixa']) > 0) ){       
            
            $val_total = 0;

            $this->table->set_heading("Qtd","Descrição");

            foreach($_SESSION['caixa'] as $caixa):

                $qtd_item = $caixa['qtd'];
                $desc = $caixa['desc'];
                
                $valor_item = $caixa['valor'];
                $sub_item = $valor_item * $qtd_item;
                $val_total = $val_total + $sub_item;

                $this->table->add_row($qtd_item,$desc);

            endforeach;
            
            $this->table->set_template(array('table_open' => '<table class="table table-striped">'));
            echo $this->table->generate();

            echo "<small class='text-primary'>R$ ".dinheiro($val_total)."</small>";  

            ?>
            <div class="pull-right">
              <button type='button' class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal-avista">à vista</button>
                <button type='button' class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal-aprazo">à Prazo</button>            
            </div>
            <?php

        /*include_once './application/views/frontend/modal-avista.php';
        include_once './application/views/frontend/modal-aprazo.php';          */

        include_once 'modal-avista.php';
        include_once 'modal-aprazo.php';            

        }else{
           
            echo '...';

        }


    ?>



    </div>
</div>

<script type="text/javascript">
    
    $('#btn_tela_carrinho').click(tela_carrinho);

</script>
