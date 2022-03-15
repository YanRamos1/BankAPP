<?php
require_once 'vendor/autoload.php';
require_once 'template/header.php';
use Models\User;
?>

<div class="container" style="background-color: #ececec">
    <div class="container-fluid">
        <h2 class="text-center">Usuários do sistema</h2>
    </div>
    <table class="table" id="tblusers">
        <thead>
        <tr>
            <th>Primeiro Nome</th>
            <th>Ultimo nome</th>
            <th>Desde</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody id="result">

        </tbody>
    </table>
    <!-- button to run -->
    <div id="tester">

    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--- form -->
                    <form id="form_login">
                        <!--- first_name -->
                        <label for="pass">Senha</label>
                        <input type="password" id="pass" class="form-control" placeholder="">
                        <input type="hidden" id="id_user_login" class="form-control" placeholder="">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->

<script>


    $(document).ready(function () {
        refreshTable();
        $('#form_register').submit(function (e) {
            e.preventDefault();
            let form = document.querySelector('#form_register');
            let formData = new FormData(form);
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('password', document.getElementById('password_register').value);
            formData.append('city', document.getElementById('city').value);

            if (($('#first_name').val() == '') || ($('#last_name').val() == '') || ($('#city').val() == '') || ($('#email').val() == '') || ($('#password').val() == '')) {
                alert('Please fill all the fields');
            } else {
                $.ajax({
                    url: 'http://191.37.120.186:8000/Controllers/AddUser.php',
                    type: 'POST',
                    data: $('#form_register').serialize(),
                    success: function (formData) {
                        refreshTable();
                        $('#modelAddUser').modal('hide');
                        alert('User added successfully');
                    }
                });
            }
        });
        $('#modal_login').on('show.bs.modal', function (e) {
            let pass = $(e.relatedTarget).data('pass');
            $('#id_user_login').val(pass);
        })

    });

    function refreshTable() {
        let table = document.getElementById('#result');
        $.ajax({
            url: 'http://191.37.120.186:8000/Controllers/Refresh.php',
            type: 'GET',
            success: function (data) {
                $('#result').html(data);
            }
        });
    }


</script>

<?php
require_once 'template/footer.php';
?>
