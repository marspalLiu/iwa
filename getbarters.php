<?php

include("include/util.inc.php");
session_start();
$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:null;

$owner_id = isset($_GET["owner_id"])?$_GET["owner_id"]:null;
$category_id = isset($_GET["category_id"])?$_GET["category_id"]:null;
$date_sort = isset($_GET["date_sort"])?$_GET["date_sort"]:null;
$like_name = isset($_GET["like_name"])?$_GET["like_name"]:null;



$barters = $db->query("SELECT * FROM `barters` "
.((isset($owner_id) || isset($category_id) || isset($like_name))?"WHERE ":"")
.(isset($owner_id)? "`owner_id` = $owner_id":"")
.((isset($owner_id) && isset($category_id))? " AND ":" ")
.(isset($category_id)?"`category_id` = $category_id":"")
.((isset($like_name) && (isset($category_id) || isset($owner_id)))?" AND ":"")
.(isset($like_name)?("`barter_name` LIKE '%".$like_name."%'"):"")
.(isset($date_sort)?" ORDER BY `purchase_date` $date_sort":""))->fetchAll();

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
        <?php
            if(isset($user_id))  {
        ?>
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
                    <a href="swap.php?barter_id=<?=$barter["barter_id"] ?>">swap</a>
                </span>
            </li>
        <?php
            }
        ?>
        </ul>
        <?php
            }
        ?>
        
    </div>
</div>

<?php
    }
?>