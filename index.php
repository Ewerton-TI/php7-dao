<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        require_once ("config.php");
      /*  $sql = new sql();
        
        $usuarios = $sql->select("SELECT *FROM tb_usuarios");
        
        echo json_encode($usuarios);*/
        
        $root = new Usuario();
        
        
        $root->loadById(3);
        echo $root;
        ?>
    </body>
</html>
