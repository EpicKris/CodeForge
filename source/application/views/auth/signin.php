<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Sign In</title>
	
		<!-- CSS -->
		<link href="/resources/css/bootstrap.min.css" rel="stylesheet">
		<link href="/resources/css/codeforge-theme.min.css" rel="stylesheet">
	
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body id="body-auth">

		<div class="site-wrapper">
			<div class="site-wrapper-inner">
				<?php
				$attributes = array(
					'class' => 'form-auth',
					'role' => 'form'
				);
				echo form_open('auth', $attributes);
				?>
					<h1 class="auth-heading">Sign In</h1>
					<div class="group">
						<div class="form-group<?php if (form_error('user') !== '') echo ' has-error'; ?>">
							<label for="user">Username</label>
							<input type="text" name="user" class="form-control" id="user" placeholder="Username" required autofocus>
						</div>
						<div class="form-group<?php if (form_error('pass') !== '') echo ' has-error'; ?>">
							<label for="pass">Password</label>
							<input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
						</div>
					</div>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
				</form>
			</div>
		</div>

		<!-- JS -->
		<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="/resources/js/bootstrap.min.js"></script>
		<script src="/resources/js/codeforge.min.js"></script>

	</body>

</html>