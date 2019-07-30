<style type="text/css">
    
    .item{
        width: 80px;
    }

</style>


<?php

    if(count($busca)>0){

    //$this->table->set_heading("id","Qtd","Descrição","Valor","Tipo","...","...");
    
    echo "<table class='table table-striped'>";
    echo "<tr>";
        echo "<th>Id</th>";
        echo "<th>Estoque</th>";
        echo "<th>Descrição</th>";
        echo "<th>Valor</th>";
        echo "<th>Tipo</th>";
        echo "<th>item</th>";
        echo "<th>...</th>";
    echo "</tr>";

    foreach($busca as $row){
        
        $id = $row->ide_pec;
        $qtd = ( $row->lucro > 0 ? $row->qtd_pec : '...');
        $desc = $row->des_pec;
        $valor = $row->val_pec + $row->lucro;
        $tipo = ($row->lucro > 0 ? 'Produto': 'Serviço');

        $qtd_item = "";

        $btn_submit = " <button type='button' class='btn btn-success submit' data-id='$id' ><i class='glyphicon glyphicon-ok'></i> </a></button> ";
        
        if($row->qtd_pec <= 0 AND $row->lucro > 0){ 

            $btn_submit = " <button type='button' class='btn btn-danger' data-id='$id' ><i class='glyphicon glyphicon-remove'></i> </a></button> ";        
        }
        
        //$this->table->add_row($id,$qtd,$desc,$valor,$tipo,$qtd_item,$vender);

        $form = "<form id='form_$id' method='post'> 
            <input type='hidden' name='id' value='$id'>
            <input type='hidden' name='estoque' value='$qtd'>
            <input type='hidden' name='desc' value='$desc'>
            <input type='hidden' name='valor' value='$valor'>
            <input type='hidden' name='tipo' value='$tipo'>
            <input type='number' name='qtd_item' min='1' value='1' class='item form-control'>
            </form>
        ";

        echo "";

        echo "";

        echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$qtd</td>";
            echo "<td>$desc</td>";
            echo "<td>R$ ".dinheiro($valor)."</td>";
            echo "<td>$tipo</td>";
            echo "<td>$form</td>";
            echo "<td>$btn_submit</td>";
        echo "</tr>";



    }
    //$this->table->set_template(array('table_open' => '<table class="table table-striped">'));
    //echo $this->table->generate();
    
    echo "</table>";


    //echo escreve_resultado($busca);

}else{
    $this->load->view('frontend/nada'); 
}

?>

<script type="text/javascript">

    $('.submit').click(function(){

        var id = $(this).attr('data-id');
        var id_form = '#form_'+id;
        var action = '<?=base_url()?>vendas/carrinho_adicionar';

        //console.log(id+'-'+id_form);

        $.ajax({
            url: action,
            method:'post',
            data: $(id_form).serialize(),                             
            success: function (data)
            {

                console.log(data);
                contador();
                mini_carrinho();                

            }
        });//AJAX



    });
    
/*    $('.btn_vender').click(function(){
        var ide_pec = $(this).attr('data-idpec');
        var url_final = 'vendas/add_carrinho/'+ide_pec;
        
        console.log(url_final);
        console.log(ide_pec);

        $.ajax({
            url: url_final,
            success: function(data){
                contador();
                //mostra o carrinho lateral
                mini_carrinho();
            }
        });        
        
    });*/

</script>