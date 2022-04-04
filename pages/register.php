<?php
session_start();
require 'components/header.php';
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                  <form action="">
                    <div class="form-floating mb-3">
                        <input name="login" type="text" class="form-control" id="login" placeholder="login">
                        <label for="login">Login</label>
                        <?php
                            if($_SESSION['error']['login']){
                                echo '<p class="alert-danger ps-2">'.$_SESSION['error']['login'].'</p>';
                            }
                        ?>

                    </div>
                    <div class="form-floating mb-3">
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                        <label for="password">Password</label>
                        <?php
                            if($_SESSION['error']['password']){
                                echo '<p class="alert-danger ps-2">'.$_SESSION['error']['password'].'</p>';
                            }
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="confirmPassword" type="password" class="form-control" id="confirmPassword"
                               placeholder="confirmPassword">
                        <label for="confirmPassword">Confirm password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="email" type="text" class="form-control" id="email" placeholder="name@example.com">
                        <label for="email">Email address</label>
                        <?php
                            if($_SESSION['error']['email']){
                                echo '<p class="alert-danger ps-2">'.$_SESSION['error']['email'].'</p>';
                            }
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="name" type="text" class="form-control" id="name" placeholder="name">
                        <label for="name">Name</label>
                        <?php
                        if($_SESSION['error']['name']){
                            echo '<p class="alert-danger ps-2">'.$_SESSION['error']['name'].'</p>';
                        }
                        ?>
                    </div>
                    <input name="register" type="text" hidden>
                    <button class="btn btn-primary" type="submit">submit</button>
                </form>
            </div>
        </div>
    </div>
<?php
if($_SESSION['error']){
    unset($_SESSION['error']);
}
?>
<?php require 'components/footer.php'; ?>