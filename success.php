<?php
    require_once 'classes/ValidateForm.php';
    require_once 'classes/WritingReadingDb.php';
    require_once 'classes/Auth.php';

    $db = new WritingReadingDb();
    $auth = new Auth();

if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    if(isset($_POST['key'])){
        if(isset($_POST['del'])){
            $db->delite($_POST['key']);
        }
        if(isset($_POST['save'])){
            $db->edit($_POST);
        }
    }
    if(isset($_POST['register'])){
      $db->addUser($_POST);
    }
    if(isset($_POST['auth'])){
       if($auth->login($_POST)){
           echo 'redirect';
       }else{
           echo 'Не авторизовались';
       }
    }
    if(isset($_POST['logout'])){
        $auth->logout();
        echo 'redirect';
    }
}














