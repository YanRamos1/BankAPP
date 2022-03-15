<?php

use Models\Account;

require_once 'template/header.php';
require_once './vendor/autoload.php';
$account = new Account();
$accounts = $account->getAllAccountsWithUsers();

?>

<div class="container" style="background-color: aqua">
    <div>
    <h1 class="d-flex justify-content-center">Depositar</h1>


    <form id="FormDeposit">
        <div id="DepositBody" class="form-group">
            <label for="valor">Valor</label>
            <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor">

            <label>
                <select>
                    <?php
                    foreach ($accounts as $account) {
                       ?>
                        <option id="account_select" value="<?php echo $account['account_id'] ?>"><?php echo $account['first_name'] . ' - ' . $account['account_type'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Depositar</button>
    </div>
</div>

<script>
    $('#valor').keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    //format to currency R$ #.##
    $('#valor').on('keyup', function () {
        var val = $(this).val();
        var val = val.replace(/\D/g, "");
        var val = val.replace(/(\d)(\d{2})$/, "$1,$2");
        $(this).val(val);
    });
    $('#FormDeposit').submit(function (e) {
        e.preventDefault();
        let account = $('#account_select').val();
        let value = $('#valor').val();

        if (($('#valor').val() == '') || ($('#account_select').val() == '')) {
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
                    alert(formData);
                    location.reload();
                },
                beforeSend: function () {
                    $('#DepositBody').html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
                }
            });
        }
    });
</script>
<?php
require_once 'template/footer.php';
?>
