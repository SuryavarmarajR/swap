<html>

<head>
	<style>

		.loginForm {
			background-color: #ffffff;
			width: 400px;
			margin: 100px auto 10px auto;
			padding: 30px;
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 2px 10px -3px #333;
			box-sizing: border-box;
		}

		.loginInput {
			border-radius: 100px;
			padding: 10px 15px;
			width: 70%;
			border: 1px solid #D9D9D9;
			outline: none;
			display: block;
			margin: 5px auto 5px auto;
		}

		.forgetPasswordButton {
			font-size: 15px;
			margin-top: 3px;
			display: inline-block;
			margin-left: 60px;
			color: #28A8BC;
		}

		.forgetPasswordButton:hover {
			cursor: pointer;
		}

		.signInButton {
			border-radius: 100px;
			border: black solid 1px;
			background-color: transparent;
			width: 20%;
			padding: 5px;
			margin-top: 5px;
			display: block;
			margin-left: 65%;
		}

		.signInButton:hover {
			cursor: pointer;
		}

		.signUpButton {
			border-radius: 100px;
			border: none;
			padding: 5px;
			display: block;
			color: #28A8BC;
		}

		.signUpButton:hover {
			cursor: pointer;
		}
	</style>
</head>

<body style="background-color: #eeeeee;">
	<form method="post" action="logindo.php" class="loginForm">
		<div style="text-align: center;">
			<h2>Login</h2>
		</div>
		<input type="text" name="username" placeholder="Username" class="loginInput" required />
		<input type="password" name="password" placeholder="Password" class="loginInput" required />
		<a onclick="window.location='/forgotpasswordform.php'" class="forgetPasswordButton">Forgot password?</a>
		<button class="signInButton">Sign in</button>
		<div style="text-align: center; margin-top: 15px;">
			<small>Don't have an account?</small>
			<a onclick="window.location='/signupform.php'" class="signUpButton"><small>Create account</small></a>
		</div>

	</form>


</body>

</html>