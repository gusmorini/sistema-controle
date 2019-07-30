<?php
    $this->table->set_heading("Nome","End","Telefone");

    foreach($clientes as $row){

        $id = $row->ide_cli;
        $nome = $row->nom_cli;
       
        if(!$row->tel_cli == ''){
            $tel = $row->tel_cli;
        }else{
            $tel = '...';   
        } 
        
        if($row->end_cli !== ''){
            $end = $row->end_cli;
        }else{
            $end = '...';
        }
        
        $this->table->add_row($nome,$end,$tel);
    }
    $this->table->set_template(array(
        'table_open' => '<table class="table table-striped">'
    ));
    echo $this->table->generate();
    echo count($clientes)." clientes cadastrado(s)";
?>