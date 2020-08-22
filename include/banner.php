
<div id="banner">

	<div id="nav_logo_block" class="nav">
		<a href="<?= isset($_SESSION["user_name"])?"./view_all.php":"#"?>">
			<img src="images/logo.png" title="return to index">
		eSwap platform</a>
	</div>

	<div id="nav_menu_block" class="nav">
		<ul>

			<li style='display:<?= isset($_SESSION["user_name"])?"flex":"none"?>'>
				<a href="./message-box.php">
					<img src="images/message.png" title="Messages">
					<span>Messages</span>
				</a>
			</li>

			<li style='display:<?= isset($_SESSION["user_name"])?"flex":"none"?>'>
				<a href="./mybarters.php">
					<img src="images/goods.png" title="My barters">
					<span>My barters</span>
				</a>
			</li>

			<li style='display:<?= isset($_SESSION["user_name"])?"flex":"none"?>'>
				<a href="./insert-form.php">
					<img src="images/upload.png" title="Upload barters">
					<span>Upload barters</span>
				</a>
			</li>

			<li>
				<a href="signout.php">
					<img src="images/user.png" title="click to sign out">
					<?= isset($_SESSION["user_name"])?$_SESSION["user_name"]:"Log In"?>
				</a>
			</li>
			
		</ul>
	</div>

</div>
