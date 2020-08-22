<?php

include("include/util.inc.php");

$db = getPDO();
$be_exchanged_user_id = $_GET['be_exchanged_user_id'];
$be_exchanged_object_id = $_GET['be_exchanged_object_id'];
$exchange_user_id = $_GET['exchange_user_id'];
$exchange_object_id = $_GET['exchange_object_id'];

include("include/banner.php");
?>

    <h1>What do you want to reply?</h1>

    <form action="reply-action.php" method="get">
        <input type="hidden" name="be_exchanged_user_id" value=<?=$be_exchanged_user_id?>>
        <input type="hidden" name="exchange_object_id" value=<?=$exchange_object_id?>>
        <input type="hidden" name="be_exchanged_object_id" value=<?=$be_exchanged_object_id?>>
        <textarea name="message"></textarea>
        <input type="submit" value="Submit">
    </form>

<?php
include("include/html-closing.html");
?>


