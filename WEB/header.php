
<div id="aviso" class="alert alert-info"> <span id="content-aviso"></span> </div>


<nav class="navbar-inverse navbar-fixed-top menu">

<div class="container">

    <div class="navbar-head text-capitalize">
    <a href="<?= base_url('home') ?>" class="navbar-brand">Controle</a>

    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra-navegacao">
        
        <span class="sr-only">Alternar Menu </span><!-- leitores de tela -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

        <div class="collapse navbar-collapse" id="barra-navegacao">
          <ul class="nav navbar-nav navbar-right">           
            <li><a href="<?= base_url('vendas/caixa') ?>">Vendas <div id="contador" ></div></a></li>
            <li><a href="<?= base_url('os') ?>">Ordem</a></li>
            <li><a href="<?= base_url('clientes') ?>">Clientes</a></li>
            <!-- <li><a href="<?= base_url('estoque/produtos') ?>" role="button">Produtos </a></li> -->
            <li><a href="<?= base_url('estoque') ?>" role="button">Estoque </a></li>
            <li><a href="<?= base_url('admin') ?>">Financeiro </a></li>
          </ul> <!-- ul.navbar left -->    
        </div>                        
    </div> <!-- nav-header -->

</div><!-- container -->
</nav><!-- NAV MENU -->     

<div class="recuo-topo">  </div>

<div class="container">
<div class="row">


<script type="text/javascript">

    function aviso(i){

        //função para fazer anicamão nas mensagens da tela
        jQuery.fn.wait = function (MiliSeconds) {
            $(this).animate({ opacity: '+=0' }, MiliSeconds);
            return this;
        }

        $('#aviso').show();
        $('#aviso').fadeIn().wait(2000).fadeOut('slow');
        $('#content-aviso').html(i);
    }

    //aviso('ajsdhkashdkjashdkjhasd');

</script>