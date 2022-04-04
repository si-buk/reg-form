<?php
 session_start();
 require_once 'ValidateForm.php';
 require_once 'WritingReadingDb.php';


 class Auth{
    private $pathFileToken = __DIR__ .'\..\db\token.json';
    private $token=[];


    public function login($user){
        $validate = new ValidateForm($user);
        $db = new WritingReadingDb();
        if($validate->uniqueness($user['login'], 'login')){
            $userDb = $validate->uniqueness($user['login'], 'login');
            $password = $validate->encryptValue($user['password']);
            if($userDb['password']== $password){
               setcookie('token', $_COOKIE['PHPSESSID'], time()+3600*24*30, '/');
               $this->token = $db->readingDb($this->pathFileToken);
               $this->token[$_COOKIE['PHPSESSID']] = $userDb['id'];
               $db->save($this->pathFileToken, $this->token);
               return true;
            }else{
                echo 'Не равно';
            }
        }
    }
    public function addSession(){
        $db = new WritingReadingDb();
        $this->token = $db->readingDb($this->pathFileToken);
        if($this->token[$_COOKIE['token']]){
            $idUser = $this->token[$_COOKIE['token']];
            $allUser = $db->readingDb();
            $oneUser = $allUser[$idUser];
            $_SESSION['name'] = $oneUser['name'];
        }
    }

    public function logout(){
        $db = new WritingReadingDb();
        $this->token = $db->readingDb($this->pathFileToken);
        unset($this->token[$_COOKIE['token']]);
        unset($_SESSION['name']);
        setcookie('token', '', time()-3600);
        $db->save($this->pathFileToken, $this->token);
    }
 }
