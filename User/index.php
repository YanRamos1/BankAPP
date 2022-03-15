<?php
require_once '../vendor/autoload.php';
require_once '../Template/header.php';
?>

<?php

use Models\Account;
use Models\Transaction;
use Models\User;

$user = new User();
$account = new Account();
$user = $user->getById($_GET['id']);
$acs = $account->getAllAccountsWithUsers();

?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Usuário</h1>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td><?php echo $user->id_user; ?></td>
                    </tr>
                    <tr>
                        <th>Nome</th>
                        <!--concatenate the first name and last name-->
                        <td><?php echo $user->first_name . ' ' . $user->last_name; ?></td>
                    </tr>
                    <tr>
                        <th>Cidade</th>
                        <td><?php echo $user->city; ?></td>
                    </tr>
                    <tr>
                        <th>Data de criação</th>
                        <td><?php echo $user->created_at; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Contas</h1>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Saldo</th>
                        <th>Status</th>
                        <th>Tipo</th>
                        <th>Criada em</th>
                        <th>Ações</th>
                    </tr>
                    <?php
                    $accounts = $account->getByUser($user->id_user);
                    foreach ($accounts as $account) {
                        ?>
                        <tr>
                            <td><?php echo $account['account_id']; ?>
                            <td><?php echo 'R$' . number_format($account['balance'], 2, ',', '.'); ?>
                            <td><?php echo $account['account_status']; ?>
                            <td><?php echo $account['account_type']; ?>
                            <td><?php echo $account['created_at']; ?>
                            <td>
                                <button type='button' class='btn btn-primary btn-sm'
                                        data-id-account='<?php echo $account['account_id'] ?>'
                                        data-toggle='modal'
                                        data-target='#ModalDeposit'>
                                    Depositar
                                </button>
                                <button type='button' class='btn btn-primary btn-sm'
                                        data-toggle='modal'
                                        data-id_accountt='<?php echo $account['account_id'] ?>'
                                        data-target='#ModalTransfer'>
                                    Transferir
                                </button>
                                <button type='button' class='btn btn-primary btn-sm'
                                        data-id-accounttt='<?php echo $account['account_id'] ?>'
                                        data-toggle='modal'
                                        data-target='#ModalExtract'>
                                    Extrato
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <div id="msg"> </div>


                <!-- Button trigger modal -->
                <?php
                echo "<button type='button' class='btn btn-primary btn-sm' data-id-user='{$user->id_user}' data-toggle='modal' data-target='#AddAccount'>
                    Criar nova conta
                </button>";
                ?>

                <div>
                    <!--modal to Extract-->
                    <div class="modal fade" id="ModalExtract" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Extrato</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <input type="text" hidden id="id_aaa">
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Valor</th>
                                                        <th>De</th>
                                                        <th>Para</th>
                                                        <th>Data</th>
                                                    </tr>
                                                    <tbody id="result">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--modal to AddAccount-->
                    <div class="modal fade" id="AddAccount" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Nova Conta</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <form id="NewAccount">
                                            <div class="form-group">
                                                <label for="type">Tipo</label>
                                                <select class="form-control" id="type" name="type">
                                                    <option value="1">Conta Corrente</option>
                                                    <option value="2">Conta Poupança</option>
                                                </select>
                                                <input hidden type="text" id="id_userr">
                                                <button type="submit" class="btn btn-primary">Criar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--modal to transfer money-->
                    <div class="modal fade" id="ModalTransfer" tabindex="-1" role="dialog"
                         aria-labelledby="modelTitleId"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Transferir</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="TransferBody" class="modal-body">
                                    <div class="container-fluid">
                                        <form id="Transfer">
                                            <div class="form-group">
                                                <label for="account_id">Conta</label>
                                                <select class="form-control" id="account_id" name="account_id">
                                                    <?php
                                                    foreach ($acs as $aa) {
                                                        ?>
                                                        <option value="<?php echo $aa['account_id']; ?>"><?php echo $aa['first_name'] . ' - ' . $aa['account_type'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input name="id_accountt" hidden id="id_accountt">
                                                <label for="value">Valor</label>
                                                <input type="text" class="form-control" id="ValueTransfer" name="value"
                                                       placeholder="R$0,00">
                                                <button type="submit" class="btn btn-primary">Transferir</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--modal to deposit money-->
                    <div class="modal fade" id="ModalDeposit" tabindex="-1" role="dialog"
                         aria-labelledby="modelTitleId"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Depositar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="DepositBody" class="modal-body">
                                    <div class="container-fluid">
                                        <form id="DepositForm">
                                            <input name="id_account" hidden id="id_account">
                                            <!--input for currency R$-->
                                            <label for="value"> Valor: </label>
                                            <input id="ValueDeposit" type="text" name="value"
                                                   placeholder="R$0.00">
                                            <button type="submit" class="btn btn-primary">Depositar</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function refreshTable($a) {
                        let table = document.getElementById('#result');
                        $.ajax({
                            url: 'http://191.37.120.186:8000/Controllers/GetTransaction.php',
                            type: 'POST',
                            data: {
                                id_account: $a
                            },
                            success: function (data) {
                                $('#result').html(data);
                            }
                        });
                    }
                    $('#ModalExtract').on('show.bs.modal', event=> {
                        let button = $(event.relatedTarget);
                        let id_account = button.data('id-accounttt');
                        let e = document.getElementById('id_aaa');
                        e.value = id_account;
                        refreshTable(id_account);
                    });
                    $('#AddAccount').on('show.bs.modal', event => {
                        let id = $(event.relatedTarget).data('id-user');
                        let a = document.getElementById('id_userr');
                        a.value = id;
                    });
                    $('#ModalDeposit').on('show.bs.modal', event => {
                        let id = $(event.relatedTarget).data('id-account');
                        let a = document.getElementById('id_account');
                        a.value = id;
                    });

                    $('#ModalTransfer').on('show.bs.modal', event => {
                        let id = $(event.relatedTarget).data('id_accountt');
                        let a = document.getElementById('id_accountt');
                        a.value = id;
                    });
                    //disable keys on input
                    $('#ValueDeposit').keypress(function (e) {
                        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                            return false;
                        }
                    });

                    $('#ValueTransfer').keypress(function (e) {
                        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                            return false;
                        }
                    });
                    //format to currency R$ #.##
                    $('#ValueTransfer').on('keyup', function () {
                        var val = $(this).val();
                        var val = val.replace(/\D/g, "");
                        var val = val.replace(/(\d)(\d{2})$/, "$1,$2");
                        $(this).val(val);
                    });

                    $('#ValueDeposit').on('keyup', function () {
                        var val = $(this).val();
                        var val = val.replace(/\D/g, "");
                        var val = val.replace(/(\d)(\d{2})$/, "$1,$2");
                        $(this).val(val);
                    });

                    $('#ModalDeposit').submit(function (e) {
                        e.preventDefault();
                        let account = $('#id_account').val();
                        let value = $('#ValueDeposit').val();

                        if (($('#ValueDeposit').val() == '') || ($('#id_account').val() == '')) {
                            alert('Preencha todos os campos');
                        } else {
                            $.ajax({
                                url: 'http://191.37.120.186:8000/Controllers/Deposit.php',
                                type: 'POST',
                                data:
                                    {
                                        id_account: account,
                                        value: value
                                    },
                                success: function (formData) {
                                    $('#ModalDeposit').modal('hide');
                                    location.reload();
                                },
                                beforeSend: function(formData) {
                                    $('#DepositBody').html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
                                }
                                //loading gif
                            });
                        }
                    });

                    $('#NewAccount').submit(function (e) {
                        e.preventDefault();
                        let id = $('#id_userr').val();
                        let type = $('#type').val();

                        if (($('#uu').val() == '') || ($('#type').val() == '')) {
                            alert('Preencha todos os campos');
                        } else {
                            $.ajax({
                                url: 'http://191.37.120.186:8000/Controllers/AddAccount.php',
                                type: 'POST',
                                data:
                                    {
                                        id_user: id,
                                        type: type
                                    },
                                success: function (formData) {
                                    alert(formData);
                                }
                            });
                        }
                    });

                    $('#ModalTransfer').submit(function (e) {
                        e.preventDefault();

                        let fromAccount = $('#id_accountt').val();
                        let value = $('#ValueTransfer').val();
                        //get value from dropdown selected account
                        let toAccount = $('#account_id').val();
                        if (toAccount === fromAccount) {
                            alert('Não é possível transferir para a mesma conta');
                        } else {
                            if (($('#ValueTransfer').val() == '') || ($('#id_accountt').val() == '') || ($('#account_id').val() == '')) {
                                alert('Preencha todos os campos');
                            } else {
                                $.ajax({
                                    url: 'http://191.37.120.186:8000/Controllers/Transfer.php',
                                    type: 'POST',
                                    data:
                                        {
                                            FromAccount: fromAccount,
                                            ToAccount: toAccount,
                                            value: value
                                        },
                                    success: function (formData) {
                                        location.reload();
                                    },
                                    beforeSend: function(formData) {
                                        $('#TransferBody').html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
                                    }
                                });
                            }
                        }
                    });
                </script>
            </div>
        </div>
</section>
<script
<?php
require_once '../Template/footer.php';
?>
