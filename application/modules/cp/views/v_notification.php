<html>
	<head>
		<title>JNE - <?php echo $title;?></title>
		<link rel="shortcut icon" href="<?php echo base_url().'images/favicon.ico';?>">
		<style type="text/css">
			.text-segoe{font-family:Segoe UI;}
		</style>
	</head>
	<body>
		<h2 class="text-segoe"><u><?php echo $judul; ?></u></h2>
			<span class="text-segoe"><?php echo $isi; ?></span>
			<span class="text-segoe"><a style="color:blue;" href="<?php echo site_url().'logins/c_login/logOut'; ?>">re-Login</a></span>
	</body>
</html>