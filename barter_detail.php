<?php 
        session_start();
        include("include/html-head.html");
        include("include/banner.php");
        include("include/util.inc.php");
        $barter_id = $_GET["barter_id"];
?>




<section>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Owner name</th>
                        <th>Barter Id</th>
                        <th>Barter Name</th>
                        <th>Category</th>
                        <th>Purchase Date</th>
                        <th>Description</th>
                        <th>SwapFor</th>
                        
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    <?php
                        $barter = $db->query("SELECT * FROM `barters` WHERE `barter_id`=$barter_id")->fetch();
                    ?>
                                <tr>
                                    <td><?= $db->query("SELECT `user_name` FROM users where user_id =".$db->quote($barter["owner_id"]))->fetch()["user_name"] ?></td>
                                    <td><?= $barter["barter_id"] ?></td>
                                    <td><?= $barter["barter_name"] ?></td>
                                    <td><?= $db->query("SELECT `category_name` FROM `categories` where category_id =".$db->quote($barter["category_id"]))->fetch()["category_name"] ?></td>
                                    <td><?= $barter["purchase_date"] ?></td>
                                    <td><?= $barter["barter_description"] ?></td>
                                    <td><?= $barter["swap_for"] ?></td>
                                    

                                </tr>
                    
                </tbody>
            </table>
        </div>
    </section>
    <div id="card-block">
        <div id = "card-content" class="rec-cards show-cards">
    <?php 
        $images = glob("img/".$barter_id."/"."*.jpg");
        
        foreach ($images as $image) {
    ?>
            <div class="rec-card"  style="background:none;">
                <div class="rec-avatar">
                    <span class="avatar avatar-middle" >
                        <img src= "<?= $image?>" >
                    </span>
                </div>
            </div>
    <?php
        }
    ?>
       </div>                                
    </div>

    <?php 
        if(isset($_SESSION["user_id"]))
        {
    ?>
    <h3><a href="view_all.php"><button>Back to home page</button></a></h3>
    <?php
        } else { 
    ?>
    <h3><a href="visitor.php"><button>Back to home page</button></a></h3>
    <?php
        }
    ?>
<?php 
        include("include/html-closing.html");
?>