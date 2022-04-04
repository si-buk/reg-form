<?php

class Router{
    private $pages =[];

    public function addRoute($url, $path){
        $this->pages[$url] = $path;
    }

    public function route($url){
        $path = $this->pages[$url];
        $file_dir = 'pages/'. $path;

        if($path == ''){
            require '404.php';
            die();
        }

        if(file_exists($file_dir)){
            require $file_dir;
            die();
        }else{;
            require '404.php';
            die();
        }
    }
}