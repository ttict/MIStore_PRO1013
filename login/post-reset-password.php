<?php 
require_once "../helpers/common.php";
require_once "../helpers/db.php";

$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$id = $_POST['id'];

$userQuery = "update users set `password` = '$password', password_reset_token = NULL where id = $id";
$user = executeQuery($userQuery);
$message = "Thay đổi thành công!";
$redirect = BASE_URL . "login.php";

?>
<html>
    <head></head>
    <body>

    <?php
        
            echo "<script type='text/javascript'>alert('$message')</script>";
        


    ?>
    <script>
    setTimeout(() => {
        window.location.replace("<?= $redirect ?>");
    }, 2);
    </script>
        
    </body>
</html>