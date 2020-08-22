<?php
    session_start();
    include("include/util.inc.php");

    $db = getPDO();
    $barter_id = $_GET['barter_id'];

    include("include/html-head.html");
	include("include/banner.php");	
?>
		<div class="page-name">
            <span>Update barter data</span>
        </div>
<?php
    $barter = $db->query("SELECT * FROM `barters` WHERE `barter_id`=".$db->quote($barter_id))->fetch();
?>
    <form action="update-action.php?barter_id=<?=$barter_id?>" method="post" enctype="multipart/form-data">
        <div class="form-content">
            <div class="form-item">
                <div class="item-label">
                    Category
                </div>
                <div class="item-content">
                    <div class="select">
                    <select class="noborder" type="text" name="category">
                        <?php
                        $rows = $db->query("SELECT * FROM `categories`")->fetchAll();
                            foreach ($rows as $row) { 
                        ?>
                        <option value = <?= $row["category_id"]?> <?=$row["category_id"]==$barter["category_id"]?"selected = \"selected\"":"";?>><?= $row["category_name"]?></option>

                        <?php
                            }
                        ?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Barter Name
                </div>
                <div class="item-content">
                    <input class="form-input" type="text" name="barter_name" value = <?=$barter["barter_name"]?>/>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Purchase Date
                </div>
                <div class="item-content">
                    <input class="form-input" type="text" name="date" value = <?=$barter["purchase_date"]?>/>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Description
                </div>
                <div class="item-content">
                    <textarea class="form-input" cols="30" rows="6" type="text" name="description" ><?=$barter["barter_description"]?></textarea>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Swap for
                </div>
                <div class="item-content">
                    <textarea class="form-input" cols="30" rows="6" type="text" name="swapfor" ><?=$barter["swap_for"]?></textarea>
                </div>
            </div> 
            <div class="form-item">
                <div class="item-label">
                    Barter Image
                </div>
                <div class="item-content">
                    <input class="form-input" cols="30" rows="6" type="file" name="barter_image[]"  multiple="multiple" accept="image/jpeg"></textarea>
                </div>
            </div>
            <div class="form-item">
                <button id="submit" type="submit">Submit</button>
            </div>
        </div>
    </form>
<?php
	include("include/html-closing.html");
?>
