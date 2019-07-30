<?php

    $this->table->set_heading("id","Estoque","Descrição","Custo");
    
    foreach($produtos as $row){
        
        $id = $row->ide_pec;
        $qtd = $row->qtd_pec;
        $desc = $row->des_pec;
        $valor = 'R$ '.dinheiro($row->val_pec);

    
        $this->table->add_row($id,$qtd,$desc,$valor);
    }
    $this->table->set_template(array(
        'table_open' => '<table class="table table-striped">'
    ));
    echo $this->table->generate();
    echo count($produtos)." produtos em falta";
?> 