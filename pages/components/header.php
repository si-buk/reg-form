<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" aria-current="page" href="/">Home</a>
                            <?php if(!$_SESSION['name']):?>
                            <a class="nav-link" href="/register">Register</a>
                            <a class="nav-link" href="/login">Login</a>
                            <?php else: ?>
                            <a class="nav-link" href="/users">Users</a>
                            <?php endif ?>
                        </div>
                        <div class="navbar-nav logout">
                            <?php if($_SESSION['name']):?>
                                <form action="">
                                    <input name="logout" type="text" hidden>
                                    <button class="btn btn-danger" >logout</button>
                                </form>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="row mt-5">
        <?php if($_SESSION['name']):?>
            <h2>Hello <?php echo $_SESSION['name']?></h2>
        <?php endif ?>
    </div>
</div>