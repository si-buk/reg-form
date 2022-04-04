<?php
session_start();
require_once 'WritingReadingDb.php';

class ValidateForm{
    private $sol = 'lfjwuje2395kgy33n5kt2yjrrmnmqb';
    public $login;
    public $password;
    public $confirmPassword;
    public $email;
    public $name;
    public $error = [];
    public $dataUser = [];


    public function __construct($dataUser){
        $this->login = $this->fieldSecurity($dataUser['login']);
        $this->password = $this->fieldSecurity($dataUser['password']);
        $this->confirmPassword = $this->fieldSecurity($dataUser['confirmPassword']);
        $this->email = $this->fieldSecurity($dataUser['email']);
        $this->name = $this->fieldSecurity($dataUser['name']);

    }

    private function fieldSecurity($fields){
       $field = htmlspecialchars($fields);
       $field = trim($field);
       return $field;
    }

    public function encryptValue($value){
        return md5($this->sol.$value);
    }

    public function validatePassword(){
        if($this->password && $this->password == $this->confirmPassword)
        {
            return true;
        }else{
            $this->error['password']= 'Passwords do not match';
        }
    }


     public function validateEmail(){
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            return $this->email;
        }else{
            $this->error['email']= 'Email not valid';

        }
    }

    public function maxLength($str, $length){
        if(strlen($str)<$length){
            return false;
        }else{
            return true;
        }
    }

    public function LengthLogin(){
        if(!$this->maxLength($this->login, 6)){
            $this->error['login'] = 'Length must be greater than 6 characters';
        }else{
            $this->dataUser['login'] = $this->login;
            return $this->login;
        }
    }
    public function LengthName(){
        if(!$this->maxLength($this->name, 2)){
            $this->error['name'] = 'Length must be greater than 2 characters';
        }else{
            $this->dataUser['name']= $this->name;
            return $this->name;
        }
    }

    public function validateAddUser(){
        if($this->validatePassword()){
            if(preg_match('/[A-Za-z]/', $this->password) && preg_match('/[0-9]/', $this->password)){
                if($this->maxLength($this->password, 6)){
                    $this->dataUser['password'] = $this->encryptValue($this->password);
                }else{
                    $this->error['password'] = 'Length must be greater than 6 characters';
                }
            }else{
                $this->error['password'] = 'Password must contain letters and numbers';
            }

        }
        if($this->validateEmail()){
            if($this->uniqueness($this->validateEmail(), 'email')){
                $this->error['email'] = 'Email must be unique';
            }else{
                $this->dataUser['email']= $this->email;
            }
        }

        if($this->LengthLogin()){
            if($this->uniqueness($this->LengthLogin(), 'login')){
                $this->error['login'] = 'This login exists.';
            }else{
                $this->dataUser['login']= $this->login;
            }
        }
        $this->LengthName();

        if($this->error){
           $_SESSION['error'] = $this->error;
        }else{
            return $this->dataUser;
        }
    }

    public function uniqueness($meaning, $field){
        $db = new WritingReadingDb();
        $reid = $db->readingDb();
        $uniq='';
        if($reid){
            foreach($reid as $key=> $value){
                if($meaning == $value[$field]){
                    $value['id'] = $key;
                    $uniq = $value;
                    break;
                }
            }
        }

        return $uniq;

    }

    public function validateEditUser($key = null){
        $db = new WritingReadingDb();
        $dataUsers = $db->readingDb();
        if($dataUsers[$key]['password']!== $this->password){
            if($this->maxLength($this->password, 6)){
                $this->dataUser['password'] = $this->encryptValue($this->password);
            }else{
                $this->error['password'] = 'Length must be greater than 6 characters';
            }
        }else{
            $this->dataUser['password'] = $this->password;
        }
        if($this->validateEmail()){
            $this->dataUser['email']= $this->email;
        }
        if($this->LengthLogin()){
            $this->dataUser['login']= $this->login;
        }
        $this->LengthName();

        if($this->error){
           var_dump(json_encode($this->error, JSON_FORCE_OBJECT));
        }else{
            return $this->dataUser;
        }
    }


}