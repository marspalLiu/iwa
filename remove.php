<?php

include("include/util.inc.php");

$barter_id = $_GET['barter_id'];

$barter_id = $db->quote($barter_id);
$db->exec("DELETE FROM `barters` WHERE `barter_id` =".$barter_id);

?>