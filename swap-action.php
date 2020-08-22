<?php
    include("include/util.inc.php");
    $send_user_id = $_GET["user_id"];
    $exchange_user_id = $send_user_id;
    $exchange_object_id = $_GET["exchange_object_id"];
    $be_exchanged_object_id = $_GET["be_exchanged_object_id"];
    $be_exchanged_user_id = $db->query("SELECT `owner_id` FROM `barters` where `barter_id`=$be_exchanged_object_id")->fetch()["owner_id"];
    $exchange_object_name = $db->query("SELECT `barter_name` FROM `barters` where `barter_id`=$exchange_object_id")->fetch()["barter_name"];
    $be_exchanged_object_name = $db->query("SELECT `barter_name` FROM `barters` where `barter_id`=$be_exchanged_object_id")->fetch()["barter_name"];
    
    $message = "Hi! I want swap $exchange_object_name for your $be_exchanged_object_name";

    # echo "INSERT INTO messsages (send_user_id,exchange_user_id,exchange_object_id,be_exchanged_user_id,be_exchanged_object_id,message)
    # VALUES('$send_user_id', '$exchange_user_id', '$exchange_object_id', '$be_exchanged_user_id', '$be_exchanged_object_id', '$message')"
    $db->exec("INSERT INTO messsages (send_user_id,exchange_user_id,exchange_object_id,be_exchanged_user_id,be_exchanged_object_id,message) 
    VALUES('$send_user_id', '$exchange_user_id', '$exchange_object_id', '$be_exchanged_user_id', '$be_exchanged_object_id', '$message')");

    header("Location: message-box.php");
?>