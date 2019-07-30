<?php

    $this->table->set_heading("id","Qtd","Descrição","Valor","Tipo","...");
    
    foreach($lista as $row){
        
        $id = $row->ide_pec;
        $qtd = ( $row->lucro > 0 ? $row->qtd_pec : '...');
        $desc = $row->des_pec;
        $valor = 'R$ '.dinheiro($row->val_pec + $row->lucro);
        $tipo = ($row->lucro > 0 ? 'Produto': 'Serviço');

        $alterar = anchor(base_url('estoque/ficha/'.md5($id)),
            '<i class="glyphicon glyphicon-paperclip"></i>',array('title'=>'arquivo'));
        
        $this->table->add_row($id,$qtd,$desc,$valor,$tipo,$alterar);
    }
    $this->table->set_template(array(
        'table_open' => '<table class="table table-striped">'
    ));
    echo $this->table->generate();
    
    echo escreve_resultado($lista);

?>