<?php
require_once 'ValidateForm.php';

class WritingReadingDb{
    public $db = [];
    public $dataUser;
    public $fileDb = __DIR__ . '\..\db\db.json';


    public function readingDb($where = __DIR__ . '\..\db\db.json'){
        if(file_exists($where)){
            $json = file_get_contents($where);
            if($json){
                $this->db= json_decode($json,true);
                return $this->db;
            }
        }
    }

    public function save($where = __DIR__ . '\..\db\db.json', $what){
        file_put_contents($where, json_encode($what, JSON_FORCE_OBJECT));
    }


    public function addUser($dataUser){
        if($dataUser){
            $validate = new ValidateForm($dataUser);
            $this->readingDb();
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
        $this->readingDb();
        unset($this->db[$key]);
        $this->save($this->fileDb, $this->db);
        echo 'error';
    }

    public function edit($dataUser){
        $validate = new ValidateForm($dataUser);
        $this->dataUser = $validate->validateEditUser($dataUser['key']);
        $key = $dataUser['key'];
        $this->readingDb();
        $this->db[$key] = $this->dataUser;
        file_put_contents($this->fileDb, json_encode($this->db, JSON_FORCE_OBJECT));
        echo 'error';
    }


}
