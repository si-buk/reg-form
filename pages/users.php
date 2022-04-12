<?php
require_once __DIR__.'\..\classes\DataBase.php';
require 'components/header.php';

$dataUser = Db::readingDb();
?>

    <div class="container mt-5">
        <div class="row">
            <table class="table">

                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Login</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($dataUser as $key=>$value){ ?>
                <tr>
                    <th scope="row"><?php echo $key ?></th>
                    <td><?php echo $value['login'] ?></td>
                    <td><?php echo $value['name'] ?> </td>
                    <td><?php echo $value['email'] ?></td>
                    <td><?php echo $value['password'] ?></td>
                    <td class="d-flex">
                        <button form="save" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $key?>">r</button>
                        <!-- Button trigger modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $key?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="modal-form" action="">
                                            <label class="mt-2" for="login">Login</label>
                                            <input class="w-100" type="text" name="login" value="<?php echo $value['login'] ?>">
                                            <label class="mt-2" for="login">name</label>
                                            <input class="w-100" type="text" name="name" value="<?php echo $value['name'] ?>">
                                            <label class="mt-2" for="login">email</label>
                                            <input class="w-100" type="text" name="email" value="<?php echo $value['email'] ?>">
                                            <label class="mt-2" for="login">password</label>
                                            <input class="w-100" type="text" name="password" value="<?php echo $value['password'] ?>">
                                            <input name="key" type="text" hidden value="<?php echo $key?>">
                                            <input name="save" type="text" hidden>
                                            <button type="button" class="btn btn-primary btn-form mt-2">Save</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <form action="" >
                            <input name="key" type="text" hidden value="<?php echo $key?>">
                            <input name="del" type="text" hidden>
                            <button class="btn btn-danger btn-form" type="button">x</button>
                        </form>

                    </td>
                </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php require 'components/footer.php'; ?>