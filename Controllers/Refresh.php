<?php
//returns the refreshed data to page
require_once '../vendor/autoload.php';

use Includes\Database;

$db = Database::connect();
$sql = "SELECT * FROM users";
$stmt = $db->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($users as $user) {
    //echo table body row
    echo "<tr>";
    echo "<td>{$user['first_name']}</td>";
    echo "<td>{$user['last_name']}</td>";
    echo "<td>{$user['created_at']}</td>";

    echo "<td><button type='button' class='btn btn-info btn-sm' data-pass='{$user['id_user']}' data-toggle='modal' data-target='#modal_login'>
    Login
    </button>";
    echo "</tr>";
    echo "<div id=mensagens></div>";
}
?>
<script>
    $(document).ready(function () {
        $('#form_login').submit(function (e) {
            let id = document.getElementById('id_user_login').value;
            let pass = document.getElementById('pass').value;
            e.preventDefault();
            $.ajax({
                url: '../Controllers/Login.php',
                type: 'POST',
                data: {
                    id_user: id,
                    pass: pass
                },
                success: function (data) {
                    if (data == 'true') {
                        alert('Login efetuado com sucesso!');
                        window.location.href = '../User/index.php?id=' + id;
                    } else {
                        alert('Usuário ou senha incorretos');
                    }
                }
            });
        });
    })
</script>
<!--modal to put password to login-->
<<!-- Button trigger modal -->
