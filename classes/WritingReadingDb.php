<?php
require_once 'ValidateForm.php';

class WritingReadingDb{
    public $db = [];
    public $dataUser;


    public function readingDb($where = __DIR__ . '\..\db\db.json'){
        if(file_exists($where)){
            $json = file_get_contents($where);
            if($json){
                $this->db= json_decode($json,true);
                return $this->db;
            }
        }
    }

    public function save($where, $what){
        file_put_contents($where, json_encode($what, JSON_FORCE_OBJECT));
    }


    public function addUser($dataUser){
        $this->dataUser = $dataUser;
        if($this->dataUser){
            $validate = new ValidateForm($this->dataUser);
            $this->readingDb();
            $this->db[] = $validate->validateAddUser();
            if($validate->validateAddUser()){
                $this->save($this->fileDb, $this->db);
            }
            return $this->db;
        }

    }

    public function delite($key){
        $this->readingDb();
        unset($this->db[$key]);
        file_put_contents($this->fileDb, json_encode($this->db, JSON_FORCE_OBJECT));
    }

    public function edit($dataUser){
        $validate = new ValidateForm($dataUser);
        $this->dataUser = $validate->validateEditUser();
        $key = $dataUser['key'];
        $this->readingDb();
        $this->db[$key] = $this->dataUser;
        file_put_contents($this->fileDb, json_encode($this->db, JSON_FORCE_OBJECT));
        return $this->db;
    }


}
