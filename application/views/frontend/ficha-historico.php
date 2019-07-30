<div class="panel panel-default">
<div class="panel-heading">Histórico de compras</div>
<div class="panel-body">
<?php

    
    if(count($his_compra)>0){

    $this->table->set_heading("Data","Descrição","Obs");
    
    foreach($his_compra as $row):

        $data = $row->dat_pro;
        $desc = str_replace('#', '<br>', $row->des_pro);
        $obs = ($row->obs_pro == '' ? '...' : $row->obs_pro );

        $this->table->add_row(data_brasil($data),$desc,$obs);

    endforeach;

    $this->table->set_template(array(
        'table_open' => '<table class="table table-striped">'
    ));
    echo $this->table->generate();

    }else{
        echo '...';
    }

?>
</div><!-- body -->
</div><!-- panel -->

<div class="panel panel-default">
<div class="panel-heading">Histórico de pagamento</div>
<div class="panel-body">
<?php 

    if(count($his_pag)>0){

    $this->table->set_heading("Data","Valor");
    
    foreach($his_pag as $row):

        $data = $row->dat_recebe;
        $val = $row->val_recebe;

        $this->table->add_row(data_brasil($data),'R$ '.dinheiro($val));

    endforeach;

    $this->table->set_template(array(
        'table_open' => '<table class="table table-striped">'
    ));
    echo $this->table->generate();

    }else{
        echo '...';
    }

?>
</div><!-- body -->
</div><!-- panel -->