<?php
    session_start();
    include("include/html-head.html");
	include("include/util.inc.php");

    $barter_id = $_GET["barter_id"];
    $owner_id = $_SESSION["user_id"];
    $category_id = $_POST["category"];
    $barter__name = $_POST["barter_name"];
    $barter_description = $_POST["description"];
    $barter_purchase_date = $_POST["date"];
    $swap_for = $_POST["swapfor"];

    
    $image_list = glob("img/".$barter_id."/*");

    $i = count($image_list);    
    $images = $_FILES["barter_image"]['tmp_name'];
    foreach ($images as $image) {
        if (is_uploaded_file($image)) {
            move_uploaded_file($image,
            "img/".$barter_id."/".$i.".jpg");
        }
        $i++;
    }

    $barter_id = $db->quote($barter_id);
    $db->exec("UPDATE barters 
                SET `category_id`=`category_id`, `barter_name`='barter_name',`barter_description`='$barter_description', 
                    `purchase_date`='$barter_purchase_date', `swap_for` = '$swap_for'
                WHERE `barter_id`=$barter_id");
    include("include/banner.php");
?>
		<div class="page-name">
            <span>The barter information have been updated</span>
        </div>

		<h3><a href="view_all.php"><button>Back to home page</button></a></h3>
<?php
	include("include/html-closing.html");
?>
