<?php
require 'components/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="">
                <div class="form-floating mb-3">
                    <input name="login" type="text" class="form-control" id="login" placeholder="login">
                    <label for="login">Login</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <input name="auth" type="text" hidden>
                <button class="btn btn-primary btn-form" type="button">submit</button>
            </form>
        </div>
    </div>
</div>

<?php
require 'components/footer.php';
?>
