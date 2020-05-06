<?php

class Usuario {
    
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    
    function getIdusuario() {
        return $this->idusuario;
    }

    function getDeslogin() {
        return $this->deslogin;
    }

    function getDessenha() {
        return $this->dessenha;
    }

    function getDtcadastro() {
        return $this->dtcadastro;
    }

    function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    }

    function setDeslogin($deslogin){
        $this->deslogin = $deslogin;
    }

    function setDessenha($dessenha){
        $this->dessenha = $dessenha;
    }

    function setDtcadastro($dtcadastro){
        $this->dtcadastro = $dtcadastro;
    }

    public function loadById($id) {
        $sql = new sql();
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));
        
        if(isset($results[0])){
            
            $this->setData($results[0]);
        }
        
    }
public static function getList() {
    $sql = new sql();
    
    return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
}
public static function search($login) {
    
    $sql = new sql();
    
    return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
    ':SEARCH'=>"%".$login."%"    
    ));
}
public function login($login,$senha){
         $sql = new sql();
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
            ":LOGIN"=>$login,
            ":SENHA"=>$senha
        ));
        
        if(count($results) > 0){
            
            $this->setData($results[0]);
            
        }else{
            
            throw new Exception("Login e/ou senha invalidos."); 
        }
    }
    
    public function setData($data) {
        
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro( new DateTime ($data['dtcadastro']));
}


    public function insert() {
        $sql = new sql();
        
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:SENHA)",array(
            ':LOGIN'=> $this->getDeslogin(),
            ':SENHA'=> $this->getDessenha()
    ));
         if(count($results) > 0){
             $this->setData($results[0]);
         }
    }
    
    public function update($login,$senha)
    {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
        
        $sql = new sql();
        
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN,dessenha = :SENHA WHERE idusuario = :ID",array(
           ':LOGIN'=> $this->getDeslogin(),
            ':SENHA'=> $this->getDessenha(),
            ':ID'=> $this->getIdusuario()
        ));
    }
    
    public function delete(){
        $sql = new sql();
        
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID'=> $this->getIdusuario()
        ));
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
    }
    public function __construct($login = "",$senha = "") {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
    }
    public function __toString() {
        
        return json_encode(array(
            "idusuario"=> $this->getIdusuario(),
            "deslogin"=> $this->getDeslogin(),
            "dessenha"=> $this->getDessenha(),
            "dtcadastro"=> $this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
        
    }
    
}
