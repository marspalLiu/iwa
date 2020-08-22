<?php
    session_start();
    include("include/util.inc.php");

    $db = getPDO();
    $user_id = $_SESSION['user_id'];
    $exchange_object_id = $_GET['exchange_object_id'];
    $be_exchanged_object_id = $_GET['be_exchanged_object_id'];
    $owner_name = $_GET['owner_name'];
    
    include("include/html-head.html");
    include("include/banner.php");
?>
    <div class="page-name">
        <span>Exchange your item</span>
    </div>

    <div id="card-block">
        <div class="rec-cards wrap show-cards" style="padding-left: 100px;">
<?php
    $row = $db->query("SELECT * FROM objects WHERE object_id=".$db->quote($be_exchanged_object_id))->fetch();
    $object_name = $row["object_name"];
    $category = $row["category"];
    $date = $row["date"];
    $remark = $row["remark"];
?>            
            <!-- Other's item info -->
            <div class="rec-card">
                <div class="rec-title">
                    Be exchanged item info
                </div>
                <div class="rec-avatar">
                    <span class="avatar avatar-middle">
                        <img src="//iconfont.alicdn.com/t/1596002262649.jpg@100h_100w.jpg">
                    </span>
                </div>
                <div class="rec-title">
                    <span>Object name: <?= $object_name ?></span>
                </div>
                <div class="rec-content">
                    <ul class="rec-lists">
                        <li>
                            Owner name: <?= $owner_name ?>
                        </li>
                        <li>
                            Date: <?= $date ?>
                        </li>
                        <li>
                            Category: <?= $category ?>
                        </li>
                        <li>
                            Remark: <?= $remark ?>
                        </li>
                    </ul>
                </div>
            </div>
<?php
    $object = $db->query("SELECT * FROM objects WHERE object_id=".$db->quote($exchange_object_id))->fetch();
    $my_object_name = $object["object_name"];
    $my_category = $object["category"];
    $my_date = $object["date"];
    $my_remark = $object["remark"];
    $me = $db->query("SELECT * FROM users WHERE user_id=".$db->quote($user_id))->fetch();
    $my_name = $me['user_name'];
?>
            <img class="exchange-icon"src="./images/exchange-big.png">

            <!-- My goods -->
            <div class="rec-card">
                <div class="rec-title">My item info</div>
                <div class="rec-avatar">
                    <span class="avatar avatar-middle">
                        <img src="//iconfont.alicdn.com/t/1596002262649.jpg@100h_100w.jpg">
                    </span>
                </div>
                <div class="rec-title">
                    <span>Object name: <?= $my_object_name ?></span>
                </div>
                <div class="rec-content">
                    <ul class="rec-lists">
                        <li>
                            My name: <?= $my_name ?>
                        </li>
                        <li>
                            Date: <?= $my_date ?>
                        </li>
                        <li>
                            Category: <?= $my_category ?>
                        </li>
                        <li>
                            Remark: <?= $my_remark ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear-both"></div>
    </div>

<?php
    $be_exchanged_user = $db->query("SELECT * FROM depository WHERE object_id=".$db->quote($be_exchanged_object_id))->fetch();
    $be_exchanged_user_id = $be_exchanged_user['user_id'];
?>
    <form action="contact-action.php" method="get" style="" class="contact-form">
        <span>What do you want to say?</span>
        <input type="hidden" name="be_exchanged_user_id" value=<?=$be_exchanged_user_id?>>
        <input type="hidden" name="exchange_object_id" value=<?=$exchange_object_id?>>
        <input type="hidden" name="be_exchanged_object_id" value=<?=$be_exchanged_object_id?>>
        <textarea name="message" rows = "10"></textarea>
        <button id="submit" type="submit">Submit</button>
    </form>

<?php
include("include/html-closing.html");
?>