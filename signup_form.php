<?php
    include('include/html-head.html');
    include('include/banner.php');
    include('include/util.inc.php');
?>

<div class="page-name">
    <span>Sign-up to eSwap Platform</span>
</div>
		
<div id="content">

    <form method="post" action="signup.php">
        <div class="form-content">
            <div class="form-item">
                <div class="item-label">
                    Your name
                </div>
                <div class="item-content">
                    <input class="form-input" type="text" name="user_name" required>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Your phone
                </div>
                <div class="item-content">
                    <input class="form-input" type="text" name="phone" required>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Your email
                </div>
                <div class="item-content">
                    <input class="form-input" type="text" name="email" required>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Your country
                </div>
                <div class="item-content">
                    <input class="form-input" type="text" name="country" required>
                </div>
            </div>
            <hr>
            <div class="form-item">
                <div class="item-label">
                    Login
                </div>
                <div class="item-content">
                    <input class="form-input" type="text" name="login" required>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Password
                </div>
                <div class="item-content">
                    <input class="form-input" type="password" name="password1" required>
                </div>
            </div>
            <div class="form-item">
                <div class="item-label">
                    Repeat password
                </div>
                <div class="item-content">
                    <input class="form-input" type="password" name="password2" required>
                </div>
            </div>
            <div class="form-item">
                <div class="notice-message">
                    <?php
                        if(isset($_GET["errorcode"])) {
                            echo "ATTENTION: The two passwords are different!!!";
                        }
                    ?>
                </div>
            </div>
            <div class="form-item">
                <button id="submit" name="submit" type="submit">Submit</button>
            </div>
        </div>
        

    </form>
</div>

<?php
	include('include/html-closing.html');
?>
