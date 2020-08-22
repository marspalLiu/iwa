<?php
	session_start();
	include("include/util.inc.php");

	$message = $_GET["message"];

	# TO COMPLETE
	$db = getPDO();
	$exchange_user_id = $_SESSION['user_id'];
	$be_exchanged_user_id = $_GET['be_exchanged_user_id'];
	$exchange_object_id = $_GET['exchange_object_id'];
	$be_exchanged_object_id = $_GET['be_exchanged_object_id'];
	$message = $_GET['message'];
	#############

	include("include/banner.php");
?>

    <div class="page-name">
        <span>Your message has been sent successfully!</span>
    </div>

<?php
	$db->exec("INSERT INTO messsages(send_user_id,exchange_user_id,exchange_object_id,be_exchanged_user_id,be_exchanged_object_id,message) VALUES('$exchange_user_id','$exchange_user_id', '$exchange_object_id', '$be_exchanged_user_id', '$be_exchanged_object_id', '$message')");
?>

    <h3><a href="list.php?select_category=all"><button>Back to home page</button></a></h3>
<?php
	include("include/html-closing.html");
?>