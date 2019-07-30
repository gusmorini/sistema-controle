<div class="panel panel-default">
    <div class="panel-heading">Lista de débitos</div>
    <div class="panel-body">
<?php

    $this->table->set_heading('Desde','Vencido',"Nome","Débito","Telefone");
    $deb_total = 0;
    foreach($debitos as $row){

        $id = $row->ide_cli;
        $nome = $row->nom_cli;
        $tel = $row->tel_cli;
        if($tel == ''){
            $tel = '...';
        }
        
       $result =  $this->clientes_model->busca_debito_cliente($id);    

        foreach($result as $r){ 
            $deb = 'R$ '.dinheiro($r->debito);
            $deb_total = $deb_total + $r->debito;
            $data_compra = $r->dat_pro;
        }

        $dias = contar_dias($data_compra,data_form());
        if($dias > 31){
            $vencido = "<span class='text-danger'>Sim</span>";
        }else{
            $vencido = "<span class='text-primary'>Não</span>";
        }

        $this->table->add_row(data_brasil($data_compra),$vencido,$nome,$deb,$tel);
    }//foreach
    $this->table->set_template(array(
        'table_open' => '<table class="table table-striped">'
    ));
    echo $this->table->generate();
    echo count($debitos)." clientes com débitos Total de R$ ".dinheiro($deb_total);

?>
</div>
</div>