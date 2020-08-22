<?php
	include("include/html-head.html");
?>

<div id="signin">
	<h1>Login to eSwap platform</h1>
	<form id="login-form" action="dosignin.php" method="post">
		<div class="form-content">
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
					<input class="form-input" type="password" name="password" required>
				</div>
			</div>
			<div class="form-item">
				<div class="notice-message">
					<?php
						if (isset($_GET["errorCode"])) {
							$errorCode = $_GET["errorCode"];
							switch ($errorCode) {
								case 'noUser':
									# username or password error
									$errorCode = "Your username or password is error!!!";
									break;
								case 'inputEmpty':
									# input nothing
									$errorCode = "Your input nothing!!!";
									break;
								default:
									# code...
									break;
							}
							echo $errorCode;
						}
					?>
				</div>
			</div>
			<div class="form-item">
				<button id="submit" type="submit">Sign-in</button>
			</div>
		</div>
		<button class="form-button" type="reset">Reset</button>
		<button class="form-button"><a href="visitor.php">Visitor login</a></button>
		<button class="form-button"><a href="signup_form.php?">Sign up</a></button>
	</form>
	<h4>&copy; 2020 Xin Liu,ZeChen Meng,JinTao Sha</h4>
</div>

<?php
	include("include/html-closing.html");
?>
