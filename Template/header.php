<!doctype html>
<html lang="en">
<head>
    <title>BANK APP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- My CSS -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="container" style="background: #f5f5f5">
<?php
const BASE_URL = 'http://191.37.120.186:8000/';
use Models\User;
use function MongoDB\BSON\toJSON;


?>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<nav>
    <ul class="nav justify-content-end " style="background: #005896">
        <button style="margin: 5px 10px 5px 0 " type="button" class="btn btn-success">
            <!-- p on center -->
            <div style="font-size: 8pt;" class="d-flex justify-content-center align-items-center">
                <a class="text-white" style="color: black" href="<?= BASE_URL ?>">Home</a>
            </div>
        </button>
        <button style="margin: 5px 10px 5px 0 " type="button" class="btn btn-success">
            <!-- p on center -->
            <div style="font-size: 8pt;" class="d-flex justify-content-center align-items-center">
                <a class="text-white" href="<?= BASE_URL ?>depositar.php">Depositar</a>
            </div>
        </button>
        <li class="nav-item">
            <!-- Button trigger modal -->
            <?php
            if ($_SERVER['REQUEST_URI'] == '/') {
                echo '<button style="margin: 5px 10px 5px 0 " type="button" class="btn btn-warning" data-toggle="modal"
                    data-target="#modelAddUser">';
                echo '<div style="font-size: 8pt;" class="d-flex justify-content-center">
                   Novo usuario
                </div>';
            }
            ?>

            </button>
            <!-- Models -->
            <div class="modal fade" id="modelAddUser" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form_register">
                                <!--- first_name -->
                                <div class="form-group">
                                    <label for="first_name">Primeiro Nome</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           placeholder="First Name">
                                </div>
                                <!--- last_name -->
                                <div class="form-group">
                                    <label for="last_name">Ultimo Nome</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           placeholder="Last Name">
                                </div>
                                <!--- password -->
                                <div class="form-group">
                                    <label for="password_register">Senha</label>
                                    <input type="password" class="form-control" name="password_register"
                                           id="password_register">
                                </div>
                                <!--- city -->
                                <div class="form-group">
                                    <label for="city">Cidade</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                           placeholder="City">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
