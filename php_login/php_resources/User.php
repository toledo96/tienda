<?php

include_once 'Session.php';
include 'Database.php';

class User{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
        
    }

    ///////////////////////// REGISTRO /////////////////////////
    public function userRegistration($data){

        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        // $password =  md5($data['password']);
        $password =  $data['password'];
        $role = 0;
        $confirm_password = $data['conf_password'];
        
        $chk_email = $this->emailCheck($email);
        $chk_password = $this->passwordCheck($password,$confirm_password);

        if($name == "" OR $username == "" OR $email == "" OR $password == ""){
            $msg = "<div class='alert alert-danger'>  <b> Error! hay campos vacios </b>  </div>";
            return $msg; 
        }


        $regex = "/^[a-zA-ZñÑáéíóú\s]+$/";
        if(preg_match($regex,$name)){
            
        }else{
            $msg = "<div class='alert alert-danger'>  <b> Error! solo puede contener letras </b>  </div>";
            return $msg;
        }

        $regex2 = "/^[a-zA-Z\s\d]+$/";
        if(preg_match($regex2,$username)){
            
        }else{
            $msg = "<div class='alert alert-danger'>  <b> Error! solo puede contener letras y números </b>  </div>";
            return $msg;
        }

        $regex3 = "/^[a-zA-Z\s\d\.\-\_]+$/";
        if(preg_match($regex3,$password)){
            
        }else{
            $msg = "<div class='alert alert-danger'>  <b> Error! la contraseña solo puede contener letras y números </b>  </div>";
            return $msg;
        }



        if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
            $msg = "<div class='alert alert-danger'>  <b> Error! El email no es valido  </b>  </div>";
            return $msg;
        }

        if($chk_email == true){
            $msg = "<div class='alert alert-danger'>  <b> Error! el email ya existe  </b>  </div>";
            return $msg;
        }

        if($chk_password == true){
            $password =  md5($data['password']);
        }else{
            $msg = "<div class='alert alert-danger'>  <b> Error! las contraseñas no coinciden  </b>  </div>";
            return $msg;
        }

        $sql = "INSERT INTO usuarios (role,name, username, email, password) VALUES(:role,:name, :username, :email, :password) ";
        $query = $this->db->pdo->prepare($sql);
        $query->bindParam(':role', $role,PDO::PARAM_STR);
        $query->bindParam(':name', $name,PDO::PARAM_STR);
        $query->bindParam(':username', $username,PDO::PARAM_STR);
        $query->bindParam(':email', $email,PDO::PARAM_STR);
        $query->bindParam(':password', $password,PDO::PARAM_STR);
        $result = $query->execute();
        if($result){
            $msg = "<div class='alert alert-success'>  <b> Exito! se ha registrado  </b>  </div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'>  <b> Error! no se ha podido registrar  </b>  </div>";
            return $msg;
        }


    }

    public function emailCheck($email){
        $sql = "SELECT email from usuarios WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function passwordCheck($password,$confirm_password){
        if (strcmp($password, $confirm_password) === 0){
            // echo "Los strings coinciden";
            return true;
        }else{
            return false;
        }
    }

    //////////////////////////// FIN REGISTRO ///////////////////////////////////////

    public function userLogin($data){
        $email = $data['email'];
        $password = md5($data['password']);
        $chk_email = $this->emailCheck($email);

        if($email == "" OR $password == ""){
            $msg = "<div class='alert alert-danger'>  <b> Error! hay campos vacios </b>  </div>";
            return $msg; 
        }

        if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
            $msg = "<div class='alert alert-danger'>  <b> Error! El email no es valido  </b>  </div>";
            return $msg;
        }

        if($chk_email == false){
            $msg = "<div class='alert alert-danger'>  <b> Error! el email no existe  </b>  </div>";
            return $msg;
        }

        $result = $this->getLoginUser($email,$password);
        if($result){    
            Session::init();
            Session::set("login",true);
            Session::set("id",$result->id);
            Session::set("name",$result->name);
            Session::set("username",$result->username);
            Session::set("loginmesg",$msg = "<div class='alert alert-succes'>  <b> Success! Logeado </b>  </div>");
            header("Location: index.php");

        }else{
            $msg = "<div class='alert alert-danger'>  <b> Error! datos no encontrados  </b>  </div>";
            return $msg;
        }

    }

    public function getLoginUser($email,$password){
        $sql = "SELECT * FROM usuarios WHERE email = :email AND password = :password LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    ///////////////////////////////////////// LOGIN /////////////////////////////////////////






}