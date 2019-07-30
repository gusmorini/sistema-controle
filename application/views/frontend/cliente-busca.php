<?php
    if(count($busca)>0):

    $this->table->set_heading("Nome","Endereço","Telefone","Débito","...");

    foreach($busca as $row):
        $id = $row->ide_cli;
        $nome = $row->nom_cli;
        
        if($row->tel_cli !== ''){
            $tel = $row->tel_cli;
        }else{
            $tel = '...';
        }        

        if($row->end_cli !== ''){
            $end = $row->end_cli;
        }else{
            $end = '...';
        }

        $res = $this->clientes_model->valor_debito(md5($id));
        foreach($res as $row){ 
            $debito = $row->total; 
        }

/*        $btn_ficha = '<button class="btn btn-primary btn-xs btn_ficha" 
            id="btn_'.$id.'" data-id_cli="'.$id.'"> ficha </button>';*/

        $btn_ficha = "<a href=' ".base_url('clientes/ficha/'.md5($id))."' title='ficha'>
        <i class='glyphicon glyphicon-paperclip'></i> </a>";

        $this->table->add_row($nome,$end,$tel,'R$ '.dinheiro($debito),$btn_ficha);
    endforeach;
    $this->table->set_template(array('table_open' => '<table class="table table-striped">'));
    echo $this->table->generate(); 
    echo escreve_resultado($busca);

    else:
        $this->load->view('frontend/nada');
    endif;
?>

<script type="text/javascript">

    $('.btn_ficha').click(function(){
        var id_cli = $(this).data('id_cli');
        $('#tela').load('<?=base_url("clientes/ficha/") ?>'+id_cli);
    });


</script>