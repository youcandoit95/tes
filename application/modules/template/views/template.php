<?php

$user_agent = $_SERVER['HTTP_USER_AGENT']; 
if (preg_match('/Chrome/i', $user_agent))
{ } 
else 
{ echo"Tolong gunakan web browser Google Chrome<br>Terima Kasih";
 exit;
}

$src = "123456789";
$s = substr($src,rand(0,8),1);
if ($s%2==0)
{$bg = "bg2";}
else
{$bg = "bg1";}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>Signin Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url().'bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css">	

		<!-- Custom styles for this template -->
		<link href="<?php echo base_url().'css/sign_in.css' ?>" rel="stylesheet" type="text/css">	

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="<?php echo base_url().'js/ie10-viewport-bug-workaround.js';?>"></script>
	</head>

	<body class="<?php echo $bg; ?>">
		<div class="container">
		
			<?php
			if ($this->session->flashdata('info')!="")
			{
			?>
				<div class="span12">
					<div class="alert alert-<?php echo $this->session->flashdata('class_alert'); ?>">
						<strong><?php echo $this->session->flashdata('info'); ?></strong>
					</div>
				</div>
			<?php
			}
			?>
			
			<form class="form-signin" role="form" action="<?php echo site_url().'logins/c_login/login';?>" method="POST">
				<h2 class="form-signin-heading">Sign In - IT Development System</h2>
					<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>

		</div> <!-- /container -->

		<script src="<?php echo base_url().'bootstrap/js/bootstrap-transition.js';?>"></script>
		<script src="<?php echo base_url().'bootstrap/js/bootstrap-collapse.js';?>"></script>
	</body>
</html>
