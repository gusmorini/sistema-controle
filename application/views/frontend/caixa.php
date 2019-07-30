<div class="col-sm-3">

<div class="panel panel-default">
	<div class="panel-heading">Busca estoque</div>
	<div class="panel-body">

        <?php
        echo form_open('',array('id'=>'form_busca'));
        ?>

		  <div class="form-group">
				<!-- <label>Busca</label> -->
                <input type="text" name="txt-key" id="txt-key" class="form-control" autocomplete="off" placeholder="digita ai" required autofocus="">
          </div>                                  

        <?php
        echo form_close();
        ?> 
		
	</div> <!-- panel-body -->
</div><!-- panel -->

<div id="mini-carrinho">
   
</div>

<div class="alert alert-success" role="alert" id="msg">
  <span id="content-msg">  </span>
</div>
    
</div><!-- col -->


<div class="col-sm-9">

    <div class="panel panel-default">
    <div class="panel-heading" id="title-panel"></div>
    <div class="panel-body">
    	<div id="tela"></div>
    </div>
    </div>

</div><!-- col -->

<script type="text/javascript">
    
    //tela padrão
	tela_carrinho();
	
	//mostra o carrinho lateral
	mini_carrinho();

    $('#msg').hide();

    //função para fazer anicamão nas mensagens da tela
    jQuery.fn.wait = function (MiliSeconds) {
        $(this).animate({ opacity: '+=0' }, MiliSeconds);
        return this;
    }

    function msg(i){
        $('#msg').fadeIn().wait(2000).fadeOut('slow');
        $('#content-msg').html(i);
    }

    function tela_carrinho(){

        $('#title-panel').html('Carrinho de venda');

        $.ajax({
            url: '<?=base_url()?>vendas/tela_carrinho',
            success: function(data){
                $('#tela').html(data);
            }
        });
    }//carrinho

    function mini_carrinho(){
        $.ajax({
            url: '<?=base_url()?>vendas/mini_carrinho',
            success: function(data){
                $('#mini-carrinho').html(data);
            }
        });
    }//carrinho

    //busca rápida
    $('#txt-key').keyup(function(){
        var nome_form = '#form_busca';
        var local = '<?=base_url()?>vendas/caixa_busca';
        if($('#txt-key').val().length > 0)
        {
            $.ajax({
                url: local,
                method:'post',
                data: $(nome_form).serialize(),                             
                success: function (data)
                {
                    $('#title-panel').html('resultado');
                	$('#tela').html(data);
                }
            });//AJAX

        }
        else
        {
            tela_carrinho();
        }  //IF
    });//#busca-rapida

	//desativa a tecla ENTER nos formulários
    $('input').keypress(function(e){
    var code = null;
    code = (e.keyCode ? e.keyCode : e.which);                
    return (code == 13) ? false : true;
    });


</script>