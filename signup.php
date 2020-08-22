<?php
    session_start();
    include("include/util.inc.php");

    $user_name = $_POST["user_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $country = $_POST["country"];
    $login_name = $_POST["login"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    if($password1 !== $password2) {
        header("Location:signup_form.php?errorcode=0");
        die();
    }
    else {
        $encoded_password = password_hash($password1,PASSWORD_DEFAULT);
        $db = getPDO();
        $stmt = $db->exec("INSERT INTO `users` (`user_name`, `login_name`, `email`, `phone`, `country`,`password`) 
                                        VALUES ('$user_name', '$login_name', '$email', '$phone', '$country', '$encoded_password')");
        $_SESSION["user_id"] = $db->lastInsertId();
        $_SESSION["user_name"] = $user_name;
        header("Location: view_all.php");
        die();
    }
?>

