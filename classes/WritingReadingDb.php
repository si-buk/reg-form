<?php
require_once 'ValidateForm.php';
require_once 'DataBase.php';

class WritingReadingDb{
    public $db = [];
    public $dataUser;

    public function addUser($dataUser){
        if($dataUser){
            $validate = new ValidateForm($dataUser);
            $this->db = Db::readingDb();
            $this->db[] = $validate->validateAddUser();
            if($validate->validateAddUser()){
                $this->save($this->fileDb, $this->db);
                echo 'reg';
            }else{
                echo 'error';
            }
        }
    }

    public function delite($key){
        $this->db = Db::readingDb();
        unset($this->db[$key]);
        Db::save($this->db);
        echo 'error';
    }

    public function edit($dataUser){
        $validate = new ValidateForm($dataUser);
        $this->dataUser = $validate->validateEditUser($dataUser['key']);
        $key = $dataUser['key'];
        $this->db = Db::readingDb();
        $this->db[$key] = $this->dataUser;
        Db::save($this->db);
        echo 'error';
    }


}
