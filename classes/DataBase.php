<?php

class Db{


    public static function readingDb($where = __DIR__ . '\..\db\db.json'){
        $db = [];
        if(file_exists($where)){
            $json = file_get_contents($where);
            $db = json_decode($json,true);
            return $db;

        }
    }

    public static function save($what, $where = __DIR__ . '\..\db\db.json'){
        file_put_contents($where, json_encode($what, JSON_FORCE_OBJECT));
    }
}