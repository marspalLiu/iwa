<?php
session_start();
include("include/util.inc.php");

$exchange_barter_id = $_GET["barter_id"];
$user_id = $_SESSION["user_id"];

include("include/html-head.html");
include("include/banner.php");

$barter = $db->query("SELECT * FROM `barters` where `barter_id`=$exchange_barter_id")->fetch();

?>

    <div class="page-name">
        <span>The barter you want swap for</span>
    </div>

<div id="card-block">
<div class="rec-cards show-cards">
<div class="rec-card">
</div>    
<div class="rec-card">
    <div class="rec-avatar">
        <span class="avatar avatar-middle">
            <img src= <?= "img/".$barter["barter_id"]."/1.jpg"?> >
        </span>
    </div>
    <div class="rec-title">
        <span><?= $barter["barter_name"] ?></span>
    </div>
    <div class="rec-content">
        <ul class="rec-lists">
            <li>
                Category: <?= $db->query("SELECT `category_name` FROM `categories` where category_id =".$db->quote($barter["category_id"]))->fetch()["category_name"] ?>
            </li>
            <li>
                Purchase Date: <?= $barter["purchase_date"] ?>
            </li>
            <li class = "description">
                Description: <?= $barter["barter_description"] ?>
            </li>
            <li class = "description">
                Swap For: <?= $barter["swap_for"] ?>
            </li>
        </ul>
    </div>
</div>
</div>
</div>
<div class="page-name">
        <span>Choose your barter you want swap by</span>
</div>

<div id="card-block">
    <div class="rec-cards show-cards">
<?php 
    $barters = $db->query("SELECT * FROM `barters` where `owner_id`=$user_id")->fetchAll();
    foreach ($barters as $barter){
        
?>

<div class="rec-card">
    <div class="rec-avatar">
        <span class="avatar avatar-middle">
            <img src= <?= "img/".$barter["barter_id"]."/1.jpg"?> >
        </span>
    </div>
    <div class="rec-title">
        <span><?= $barter["barter_name"] ?></span>
    </div>
    <div class="rec-content">
        <ul class="rec-lists">
            <li>
                Category: <?= $db->query("SELECT `category_name` FROM `categories` where category_id =".$db->quote($barter["category_id"]))->fetch()["category_name"] ?>
            </li>
            <li>
                Purchase Date: <?= $barter["purchase_date"] ?>
            </li>
            <li class = "description">
                Description: <?= $barter["barter_description"] ?>
            </li>
            <li class = "description">
                Swap For: <?= $barter["swap_for"] ?>
            </li>
        </ul>
    </div>
    <div class="card-action">

        <ul class="card-action-ul">
            <li>
            </li>
            <li>
                <span>
                    <a href="<?= "swap-action.php?user_id=".$user_id."&be_exchanged_object_id=".$exchange_barter_id."&exchange_object_id=".$barter["barter_id"]?>">choose</a>
                </span>
            </li>
        </ul>
    </div>
</div>

<?php
    } 
?>

 
</div>
</div>

<?php 
    include("include/html-closing.html");
?>
