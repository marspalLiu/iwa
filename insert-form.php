<?php
    session_start();
    include("include/util.inc.php");

    $db = getPDO();
    $user_id = $_SESSION['user_id'];

    include("include/html-head.html");
    include("include/banner.php");
?>
    <div class="page-name">
        <span>Upload Your Barter</span>
    </div>

    <form action="insert-action.php" method="post" enctype="multipart/form-data">
        <div class="form-content">
            <div class="form-item">
                <div class="item-label">
                    Category
                </div>
                <div class="item-content">
                    <div class= "select">
                    <select class="noborder" type="text" name="category">
                        <?php
                        $rows = $db->query("SELECT * FROM `categories`")->fetchAll();
                            foreach ($rows as $row) { 
                        ?>
                        <option value = <?= $row["category_id"]?>><?= $row["category_name"]?></option>

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
                    <input class="form-input" type="text" name="barter_name"/>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Purchase Date
                </div>
                <div class="item-content">
                    <input class="form-input" type="text" name="date" placeholder = "YYYY/MM/DD"/>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Description
                </div>
                <div class="item-content">
                    <textarea class="form-input" cols="30" rows="6" type="text" name="description"></textarea>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Swap for
                </div>
                <div class="item-content">
                    <textarea class="form-input" cols="30" rows="6" type="text" name="swapfor"></textarea>
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
