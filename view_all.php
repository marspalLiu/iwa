<?php
    session_start();
    include("include/html-head.html");
    include("include/banner.php");
    include("include/util.inc.php");
    include("include/barters-filter.php");
    $user_id = $_SESSION["user_id"];
?>
<div class="page-name">
	<span>All Barters</span>
</div>

<div id="card-block">
    <div id = "card-content" class="rec-cards show-cards">
<?php 
    $db = getPDO();
    $barters = $db->query("SELECT * FROM `barters`")->fetchAll();
    foreach ($barters as $barter){
        
?>

<div class="rec-card" value = <?= $barter["barter_id"]?>>
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
        <?php 
            if($user_id == $barter["owner_id"]) {
        ?>
            <li>
                <span>
                    <a href="update-form.php?barter_id=<?=$barter["barter_id"] ?>">update</a>
                </span>
            </li>
            <li>
                <span>
                    <a href="javascript:void(0)" class = "delete_button" data-id="<?= $barter["barter_id"] ?>">delete</a>
                </span>
            </li>
        <?php 
            }   else  {
        ?>
            <li>
                <span>
                    <a href="barter_detail.php?barter_id=<?=$barter["barter_id"] ?>">detail</a>
                </span>
            </li>
            <li>
                <span>
                    <a href="swap?barter_id=<?=$barter["barter_id"] ?>">swap</a>
                </span>
            </li>
        <?php
            }
        ?>
        </ul>
    </div>
</div>

<?php
    } 
?>
<?php
    include("include/html-closing.html");
?>