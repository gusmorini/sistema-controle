<?php

    $usuario = ($user) ?? null;
    $err = ($erro) ?? null;

?>


<div id="login">

    <form action="/login/autenticar" method="post">

       

        <?php 

            if ($err){
                $html = "<div class='alert alert-warning'>";
                $html.= $err;
                $html.= "</div>";
                echo $html;
            }


        ?>

        <div class="form-group">
            <label for="usuario">Usuario [admin]</label>
            <input required class="form-control" type="text" name="usuario" value="<?=$usuario?>" />
        </div>
        
        <div class="form-group">
            <label for="senha">Senha [1234]</label>
            <input required class="form-control" type="password" name="senha">
        </div>
        
        <button class="btn btn-warning">Entrar</button>

           

    </form>


</div>