<?php
    session_start();
    include("include/util.inc.php");

    $be_exchanged_user_id = $_POST['be_exchanged_user_id'];
	$be_exchanged_object_id = $_POST['be_exchanged_object_id'];
	$exchange_user_id = $_POST['exchange_user_id'];
	$exchange_object_id = $_POST['exchange_object_id'];

    $db = getPDO();
	$rows = $db->query("SELECT
        m.*, 
        u1.user_name AS exchange_user_name,
        u2.user_name AS be_exchange_user_name,
        o1.barter_name AS exchange_object_name,
        o2.barter_name AS be_exchanged_object_name
    FROM
        messsages m
    LEFT JOIN users u1 ON m.exchange_user_id = u1.user_id
    LEFT JOIN users u2 ON m.be_exchanged_user_id = u2.user_id
    LEFT JOIN barters o1 ON m.exchange_object_id = o1.barter_id
    LEFT JOIN barters o2 ON m.be_exchanged_object_id = o2.barter_id
    WHERE
        exchange_user_id = ".$db->quote($exchange_user_id)."
    and be_exchanged_user_id = ".$db->quote($be_exchanged_user_id)."
    and exchange_object_id = ".$db->quote($exchange_object_id)."
    and be_exchanged_object_id = ".$db->quote($be_exchanged_object_id))->fetchAll();

    echo json_encode($rows);

    
?>