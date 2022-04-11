<?php
 session_start();
 require_once 'ValidateForm.php';
 require_once 'DataBase.php';


 class Auth{
    private $pathFileToken = __DIR__ .'\..\db\token.json';
    private $token=[];


    public function login($user){
        $validate = new ValidateForm($user);
        if($validate->uniqueness($user['login'], 'login')){
            $userDb = $validate->uniqueness($user['login'], 'login');
            $password = $validate->encryptValue($user['password']);
            if($userDb['password']== $password){
               setcookie('token', $_COOKIE['PHPSESSID'], time()+3600*24*30, '/');
               $this->token = Db::readingDb($this->pathFileToken);
               $this->token[$_COOKIE['PHPSESSID']] = $userDb['id'];
               Db::save($this->token, $this->pathFileToken);
               return true;
            }else{
                echo 'Не равно';
            }
        }
    }
    public function addSession(){
        $this->token = Db::readingDb($this->pathFileToken);
        $idUser = $this->token[$_COOKIE['token']];
        $allUser = Db::readingDb();
        $oneUser = $allUser[$idUser];
        if($oneUser){
            $_SESSION['name'] = $oneUser['name'];
        }


    }

    public function logout(){
        $this->token = Db::readingDb($this->pathFileToken);
        unset($this->token[$_COOKIE['token']]);
        unset($_SESSION['name']);
        setcookie('token', '', time()-3600);
        Db::save($this->token, $this->pathFileToken);
    }
 }
