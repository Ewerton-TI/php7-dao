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
        
        //Carrega um usuario
        //$root = new Usuario();
        //$root->loadById(3);
        //echo $root;
        
        //carrega um lista de usuarios
        //$lista = Usuario::getList();
        //echo json_encode($lista);
        
        //Carrega uma lista de usuarios buscando pelo login
        //$search = Usuario::search("ro");
        //echo json_encode($search);
        
        //Carrega um usuario usando o login e a senha
       //$usuario = new Usuario();
       //$usuario->login("root","!@#$");
       
      // echo $usuario;
        
      // para inserir um novo usuario no banco de dados
       // $aluno = new Usuario("aluno","@luno");
       // $aluno->insert();
       //echo $aluno;
        
        //
        $usuario = new Usuario();
        
        $usuario->loadById(9);
        
        $usuario->update("Ewerton","@teste");
        
        echo $usuario;
        ?>
    </body>
</html>
