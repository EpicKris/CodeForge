<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>404 Page Not Found</title>
	
		<!-- CSS -->
		<link href="/resources/css/codeforge.min.css" rel="stylesheet">
		<link href="/resources/css/codeforge-theme-apple.min.css" rel="stylesheet">
	
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body style="padding-top: 15px;">

		<div class="container-fluid">

			<div class="row">

				<div class="col-xs-12">

					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title"><?php echo $heading; ?></h1>
						</div>
						<div class="panel-body">
							<?php echo $message; ?>
						</div>
					</div>

				</div>

			</div>

		</div>

		<!-- JS -->
		<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="/resources/js/bootstrap.min.js"></script>
		<script src="/resources/js/codeforge.min.js"></script>

	</body>

</html>