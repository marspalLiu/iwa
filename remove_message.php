<?php

include("include/util.inc.php");

$db = getPDO();
$be_exchanged_user_id = $_POST['be_exchanged_user_id'];
$be_exchanged_object_id = $_POST['be_exchanged_object_id'];
$exchange_user_id = $_POST['exchange_user_id'];
$exchange_object_id = $_POST['exchange_object_id'];

$db->exec("DELETE FROM messsages WHERE be_exchanged_user_id=$be_exchanged_user_id AND be_exchanged_object_id=$be_exchanged_object_id AND exchange_user_id=$exchange_user_id AND exchange_object_id=$exchange_object_id");

echo "done";
?>
