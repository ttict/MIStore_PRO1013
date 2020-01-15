<?php
    require_once "../helpers/db.php";
    require_once "../helpers/common.php";
        $name = isset($_POST["name"]) ? $_POST['name'] : '';
        $address = isset($_POST["address"]) ? $_POST['address'] : '';
        $password = isset($_POST["password"]) ? password_hash($_POST['password'],PASSWORD_DEFAULT) : '';
        $phone = isset($_POST["phone"]) ? $_POST['phone'] : '';
        $email = isset($_POST["email"]) ? $_POST['email'] : '';

        $sqlquery = "SELECT * FROM users WHERE email = '$email'";
        $user = executeQuery($sqlquery, false);
        $UNIT_URL=$_SESSION['UNIT_URL'];
        if ($user) {
            $loi="email da trung";
            header("location: login.php");
        }
        else{
            $userquery = "INSERT INTO users (`name`, `password`, email, `address`, `role` ) VALUES ('$name','$password','$email','$address', '1' )";
                
            executeQuery($userquery, false);
               
               
    }
    header("location: $UNIT_URL");
?>