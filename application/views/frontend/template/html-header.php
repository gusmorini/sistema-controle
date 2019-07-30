<!doctype html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $titulo.' / '.$subtitulo ?></title>
    
    <link rel="icon" href="./img/ic_lock_outline_black_24dp_2x.png" />
    

    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <link href="<?=base_url()?>assets/frontend/css/controle.css" rel="stylesheet">

    <link href="<?=base_url()?>assets/frontend/css/print.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/frontend/css/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->   

    <script src="<?=base_url()?>assets/jquery/jquery-3.2.1.js"></script> 

    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.js"></script>

<!--     <script src="<?=base_url()?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/dataTables.bootstrap.min.js"></script> -->

    <script src="<?=base_url()?>assets/jquery/funcoes_de_conversao.js"></script>
    <script src="<?=base_url()?>assets/jquery/jquery.validate.min.js"></script>
    <script src="<?=base_url()?>assets/jquery/jquery.validate.min.pt-br.js"></script>
    <script src="<?=base_url()?>assets/jquery/jquery.mask.js"></script>  


    <script type="text/javascript">


        function contador(){

        $.ajax({
            url: '<?=base_url()?>vendas/contador_caixa',
                success: function(data){
                $('#contador').html(data);
            }
        });
        }

        function fecha_modal(){
            console.log('fecha_modal');
            $('.modal').modal('hide');
            $('.modal-backdrop').hide();
            $("body").css({"overflow":"visible"});
        }

        contador();    



    </script>     


<!-- assets\datatables\media\css -->   

</head>
<body>