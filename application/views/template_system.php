<?php
$menu_active = $this->session->userdata('menu_active');
$sub_menu_active = $this->session->userdata('sub_menu_active');
$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');

// echo $sess_login_level."-".$sess_karyawan_hrd;
// exit();
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Mohamad Yansen Riadi">
		<link rel="shortcut icon" href="<?php echo base_url().'images/logo_pinet.png';?>">
		<title>Prima Integrasi Network</title>
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/bootstrap.css' ?>">	
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'font-awesome-4.2.0/css/font-awesome.css' ?>">	
		<!-- Custom styles for this template -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/sb-admin.css' ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/dashboard.css' ?>">	
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/flick/jquery-ui-1.10.2.custom.css' ?>">
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/dt/dt_bootstrap.css'; ?>">
		<?php /*<link rel="stylesheet" type="text/css" href="<?php echo base_url().'media/css/jquery.dataTables.css'; ?>">*/?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'ext_table_tools/css/dataTables.tableTools.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/bootstrap-combobox.css'; ?>">
		<noscript><meta http-equiv="refresh" content="0.5;url=notSupported.php; ?>"></noscript>
	</head>

	<body>
		
		<div id="wrapper">

			<!-- Sidebar -->
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" style="color:white; width:225px;" href="#">
						<img src="<?php echo base_url().'images/logo_pinet2.png';?>">
						PINET System
					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
					<?php
					if ($sess_login_level!=88)
					{
						if ($menu_active=="hcis") // start menu hcis
						{
							if ($sess_login_level>=4 && $sess_login_level<=6) // manager sampe staff
							{
								?>
								<li class="nav-header">Absent</li>
								
								<li class="<?php echo $sub_menu_active=="punch_in_out" ? "active" : ""; ?>">
									<a href="<?php echo site_url().'hcis/c_hcis_absent_punch_in_out'; ?>">Punch In / Out</a>
								</li>
								<?php
							}
							
							if ($sess_login_level>=4)
							{
								?>
								<li class="nav-header">Over Time</li>
								
								<li class="<?php echo $sub_menu_active=="lembur" ? "active" : ""; ?>">
									<a href="<?php echo site_url().'hcis/c_hcis_lembur'; ?>">Form Over Time</a>
								</li>
								
								<li class="<?php echo $sub_menu_active=="data_lembur" ? "active" : ""; ?>">
									<a href="<?php echo site_url().'hcis/c_hcis_lembur/data_lembur'; ?>">Data Over Time</a>
								</li>
								<?php
							}
							
								?>
								<li class="nav-header">Annual Leave</li>
								<?php
							
							if ($sess_login_level>=3 && $sess_login_level<=6) // gm , manager sampe staff
							{
								?>
								
								<li class="<?php echo $sub_menu_active=="cuti" ? "active" : ""; ?>">
									<a href="<?php echo site_url().'hcis/c_hcis_cuti'; ?>">Form Annual Leave</a>
								</li>
								
								<li class="<?php echo $sub_menu_active=="data_cuti" ? "active" : ""; ?>">
									<a href="<?php echo site_url().'hcis/c_hcis_cuti/data_cuti'; ?>">Data Annual Leave</a>
								</li>
								<?php
							}
							?>
							
							<?php
							if ($sess_login_level < 5) // selain staff dan leader
							{
								?>
								<li class="nav-header">Approval</li>
								
								<?php
								if ($sess_login_level == 3 || $sess_login_level == 4) // manager dan gm
								{
								?>
									
									<li class="<?php echo $this->session->userdata('sub_menu_active')=="early_punch_out" ? "active" : ""; ?>">
										<a href="<?php echo site_url().'hcis/c_hcis_absent_approval/early_punch_out'; ?>">Early Punch Out</a>
									</li>
								<?php
								}
								
								if ($sess_karyawan_hrd==1) // manager hrd only
								{
									?>
									<li class="<?php echo $this->session->userdata('sub_menu_active')=="early_punch_out_2nd_level" ? "active" : ""; ?>">
										<a href="<?php echo site_url().'hcis/c_hcis_absent_approval/early_punch_out_2nd_level'; ?>">Early Punch Out 2nd Level</a>
									</li>
									<?php
								}
								
								if ($sess_login_level == 3 || $sess_login_level == 4) // manager dan gm
								{
								?>
									
									<li class="<?php echo $this->session->userdata('sub_menu_active')=="annual_leave" ? "active" : ""; ?>">
										<a href="<?php echo site_url().'hcis/c_hcis_cuti_approval/annual_leave'; ?>">Annual Leave</a>
									</li>
								<?php
								}
								
								if ($sess_karyawan_hrd==1) // manager hrd only
								{
									?>
									<li class="<?php echo $this->session->userdata('sub_menu_active')=="annual_leave_2nd_level" ? "active" : ""; ?>">
										<a href="<?php echo site_url().'hcis/c_hcis_cuti_approval/annual_leave_2nd_level'; ?>">Annual Leave 2nd Level</a>
									</li>
									<?php
								}
							}
							?>
							
							<li class="nav-header">Report Absent</li>
							
							<?php
							if ($sess_login_level >=4) // manager keatas
							{
								?>
								<li class="<?php echo $this->session->userdata('sub_menu_active')=="report_your_absen" ? "active" : ""; ?>">
									<a href="<?php echo site_url().'hcis/c_hcis_absent_report/index_your_absent'; ?>">Your Absent</a>
								</li>
								<?php
							}
							
							if ($sess_login_level <=4) // manager keatas
							{
								?>
								<li class="<?php echo $this->session->userdata('sub_menu_active')=="report_team_absen" ? "active" : ""; ?>">
									<a href="<?php echo site_url().'hcis/c_hcis_absent_report/index_team_absent'; ?>">Team Absent</a>
								</li>
								<?php
							}
							
							if ($sess_login_level==4 && $sess_karyawan_hrd==1) // manager hrd only
							{
								/*
								?>
								<li class="nav-header">Master Data</li>
								
								<li class="<?php echo $this->session->userdata('sub_menu_active')=="md_cuti" ? "active" : ""; ?>">
									<a href="<?php echo site_url().'hcis/c_hcis_md_cuti/'; ?>">Cuti</a>
								</li>
								
								<?php
								*/
							}
							?>
						<?php	
						} // end menu hcis
					}
					else
					{
						?>
						<li class="nav-header">Master Data</li>
					
						<li class="<?php echo $this->session->userdata('sub_menu_active')=="karyawan" ? "active" : ""; ?>"><a href="<?php echo site_url().'md_karyawan/c_md_karyawan/';?>">Karyawan</a></li>
						<li class="<?php echo $this->session->userdata('sub_menu_active')=="md_cuti" ? "active" : ""; ?>"><a href="<?php echo site_url().'hcis/c_hcis_md_cuti/'; ?>">Cuti</a></li>
						<?php
					}
					?>
					</ul>
					
					<?php
					if ($sess_login_level!=88)
					{
						?>
						<ul class="nav navbar-nav navbar-left navbar-user">
							<li class="<?php echo $menu_active=="hcis" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'hcis/c_hcis'; ?>">HCIS</a>
							</li>
							
							<li class="<?php echo $menu_active=="bug_report" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'bug_report/c_bug_report'; ?>">Bug Report</a>
							</li>
						</ul>
						<?php
					}
					?>
					<ul class="nav navbar-nav navbar-right navbar-user">
						<?php
						/*
						<li class="dropdown messages-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">7 New Messages</li>
								<li class="message-preview">
									<a href="#">
										<span class="avatar"><img src="http://placehold.it/50x50"></span>
										<span class="name">John Smith:</span>
										<span class="message">Hey there, I wanted to ask you something...</span>
										<span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
									</a>
								</li>
								<li class="divider"></li>
								<li class="message-preview">
									<a href="#">
										<span class="avatar"><img src="http://placehold.it/50x50"></span>
										<span class="name">John Smith:</span>
										<span class="message">Hey there, I wanted to ask you something...</span>
										<span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
									</a>
								</li>
								<li class="divider"></li>
								<li class="message-preview">
									<a href="#">
										<span class="avatar"><img src="http://placehold.it/50x50"></span>
										<span class="name">John Smith:</span>
										<span class="message">Hey there, I wanted to ask you something...</span>
										<span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
									</a>
								</li>
								<li class="divider"></li>
								<li><a href="#">View Inbox <span class="badge">7</span></a></li>
							</ul>
						</li>
						
						<li class="dropdown alerts-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Default <span class="label label-default">Default</span></a></li>
								<li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
								<li><a href="#">Success <span class="label label-success">Success</span></a></li>
								<li><a href="#">Info <span class="label label-info">Info</span></a></li>
								<li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
								<li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
								<li class="divider"></li>
								<li><a href="#">View All</a></li>
							</ul>
						</li>
						*/
						?>
						
						<li class="dropdown user-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Logged as <?php echo $this->session->userdata('karyawan_fullname');?>  <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<!--<li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>-->
								<!--<li><a href="#"><i class="fa fa-gear"></i> Change Password</a></li>
								<li class="divider"></li>-->
								<li><a href="<?php echo site_url().'cp/c_cp/'; ?>">Change Password</a></li>
								<li><a href="<?php echo site_url().'logins/c_login/logOut'; ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>

			<div id="page-wrapper" style="margin-top: -45px;">

				<div class="row">
					<div class="col-lg-12">
					<?php 
					if (isset($title_content))
					{
					?>
						<div class="row">
							<div class="col-lg-12" style="border-bottom: 1px solid #eee; margin-bottom:20px;">
								<div class="row">
									<h1 class="page-header" style="border:0px; padding:0; margin:0"><?php echo $title_content; ?></h1>
								</div>
								<div class="row text-right" style="padding-right:5px;">						
									<b><?php echo date('d F Y'); ?><br/><span id="clock"></span></b>
								</div>
							</div>
						</div>
					<?php
					}
					?>
					
					<?PHP
					$text_alert_warning = $this->session->flashdata('text_alert_warning');
					?>
					<div class="alert alert-warning alert-dismissible" role="alert" id="alert_warning" style="<?php echo $text_alert_warning=="" ? "display:none" : ""; ?>">
						<strong>Peringatan!</strong> <span id="text_alert_warning"><?php echo $text_alert_warning; ?></span>
					</div>
					
					<div class="alert alert-warning alert-dismissible" role="alert" style="<?php echo validation_errors()=="" ? "display:none" : ""; ?>" id="alert_form_validation">
						<strong>Peringatan!</strong> <span id="text_alert_warning_form_validation"><?php echo validation_errors(); ?></span>
					</div>
					
					<?PHP
					$text_alert_sukses = $this->session->flashdata('text_alert_sukses');
					?>
					<div class="alert alert-success alert-dismissible" role="alert" id="alert_success" style="<?php echo $text_alert_sukses=="" ? "display:none" : ""; ?>">
						<strong>Sukses!</strong> <span id="text_alert_success"><?php echo $text_alert_sukses; ?></span>
					</div>
					
					<?PHP
					$text_alert_danger = $this->session->flashdata('text_alert_danger');
					?>
					<div class="alert alert-danger alert-dismissible" role="alert" id="alert_danger" style="<?php echo $text_alert_danger=="" ? "display:none" : ""; ?>">
						<strong>Gagal!</strong> <span id="text_alert_danger"><?php echo $text_alert_danger; ?></span>
					</div>
					
					<?php 
					if (isset($content))
					{
					?>
					<div class="row">
						<div class="col-lg-<?php echo isset($width_content) ? $width_content : "12"; ?> main bg-white">
							<div id="loading_view_content" style="display:none;">
								<h3 class="text-center">Loading...</h3>
							</div>
							<div id="view_content">
							<?php echo $this->load->view($content); ?>
							</div>
						</div>
					</div>
					<?php
					}
					?>
					
					<!-- SUB CONTENT -->
					<?php 
					if (isset($title_sub_content))
					{
					?>
						<h1 class="sub-header"><?php echo $title_sub_content; ?></h1>
					<?php
					}
					?>
					
					<?php 
					if (isset($sub_content))
					{
					?>
					<div class="row">
						<div class="col-xs-6 col-sm-<?php echo isset($width_sub_content) ? $width_sub_content : "12"; ?> main bg-content">
							<?php echo $this->load->view($sub_content); ?>
						</div>
					</div>
					<?php
					}
					?>
					</div>
				</div>

			</div><!-- /#page-wrapper -->

		</div><!-- /#wrapper -->

		<div class="container-fluid">					
			<div class="row">
				<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
			</div>
		</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script>
		var base_url = "<?php echo base_url(); ?>";
		var user_no = "<?php echo isset($user_no) ? $user_no : ""; ?>";
		var url_ajax_data_karyawan = "<?php echo site_url().'ajax/c_ajax_data_karyawan/'; ?>";
		
		var img_url = "<?php echo base_url().'images/ext/'?>";
		var file_url = "<?php echo base_url().'uploads/'?>";
		
		var p_do_absent = "<?php echo $sub_menu_active=="punch_in_out" ? "1" : "0"; ?>";
	</script>
	
	<script src="<?php echo base_url().'js/jquery-1.11.1.js';?> "></script>
	<script src="<?php echo base_url().'js/jquery-ui-1.10.1.custom.js';?> "></script>
	
	<script src="<?php echo base_url().'bootstrap/js/bootstrap.min.js';?>"></script>
	
	<script src="<?php echo base_url().'js/dt/jquery.dataTables.js';?>"></script>
	<script src="<?php echo base_url().'ext_table_tools/js/dataTables.tableTools.js';?>"></script>
	<script src="<?php echo base_url().'js/dt/dt_bootstrap.js';?>"></script>
	<script src="<?php echo base_url().'js/bootstrap-combobox.js';?>"></script>
	
	<script src="<?php echo base_url().'js/jquery-ui-timepicker-addon.js';?>"></script>
	<script src="<?php echo base_url().'js/jquery-ui-sliderAccess.js';?>"></script>
	
	<script src="<?php echo base_url().'js/global_plugin.js';?>"></script>
	
	<?php
	if ($sess_login_level==88)
	{
		?>
		<script src="<?php echo base_url().'js/myadmin.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/mymd.js';?>"></script>
		
		<?php
		if ($this->session->userdata('menu_active')=="dept")
		{
			?>
			<script type="text/javascript" src="<?php echo base_url().'js/js_modules/js_module_dept.js';?>"></script>
			<script type="text/javascript">
			var url_FED = "<?php echo site_url().'md_department/c_dept/GO_FED';?>";
			var url_DEL = "<?php echo site_url().'md_department/c_dept/dept_delete';?>";
			var url_ACTV = "<?php echo site_url().'md_department/c_dept/dept_activate_ajax';?>";
			</script>
			<?php
		}
		else if ($sub_menu_active=="karyawan")
		{
			?>
			<script type="text/javascript">
			var url_frmNewUser = "<?php echo site_url().'md_users/c_users/new_user';?>";
			var url_cek_user = "<?php echo site_url().'md_karyawan/c_md_karyawan/cek_user';?>";	
			var url_goFED = "<?php echo site_url().'md_users/c_users/FED_User';?>";
			var url_detail_karyawan = "<?php echo site_url().'md_karyawan/c_md_karyawan/ajax_detail_karyawan';?>";
			var url_get_md_dept = "<?php echo site_url().'md_karyawan/c_md_karyawan/ajax_option_md_dept';?>";	
			var url_get_md_bagian = "<?php echo site_url().'md_karyawan/c_md_karyawan/ajax_option_md_bagian';?>";	
			var url_set_ya_get_cuti = "<?php echo site_url().'md_karyawan/c_md_karyawan/set_ya_get_cuti'; ?>";
			var url_set_tidak_get_cuti = "<?php echo site_url().'md_karyawan/c_md_karyawan/set_tidak_get_cuti'; ?>";
			</script>
			<script type="text/javascript" src="<?php echo base_url().'js/js_modules/js_module_karyawan.js';?>"></script>
			<?php
		}
		else if ($this->session->userdata('menu_active')=="acc_user_isd")
		{
			?>
			<script type="text/javascript" src="<?php echo base_url().'js/js_modules/acc_isd_user.js';?>"></script>
			<script type="text/javascript">
			var url_activate_acc = "<?php echo site_url().'md_acc_user_isd/c_acc_user_isd/activate';?>";
			var url_disactivate_acc = "<?php echo site_url().'md_acc_user_isd/c_acc_user_isd/disactivate';?>";
			</script>
			<?php
		}
	}
	else
	{
		?>
		<script type="text/javascript">
		var url_detail_karyawan = "<?php echo site_url().'md_karyawan/c_md_karyawan/ajax_detail_karyawan';?>";
		</script>
		<script type="text/javascript" src="<?php echo base_url().'js/js_modules/js_module_karyawan.js';?>"></script>
		<?php
		if ($sub_menu_active=="report_team_absen")
		{
			?>
			<script type="text/javascript">
			var url_get_md_dept = "<?php echo site_url().'md_karyawan/c_md_karyawan/ajax_option_md_dept_report';?>";	
			var url_get_md_bagian = "<?php echo site_url().'md_karyawan/c_md_karyawan/ajax_option_md_bagian_report';?>";	
			</script>
			<script type="text/javascript" src="<?php echo base_url().'js/js_modules/js_module_karyawan.js';?>"></script>
			<?php
		}
		
		if ($sub_menu_active=="cuti")
		{
			?>
			<script type="text/javascript">
			var url_cancel_cuti = "<?php echo site_url().'hcis/c_hcis_cuti/cancel_cuti';?>";
			</script>
			<?php
		}
	?>
	<?php
	}
	?>
		<script src="<?php echo base_url().'js/pinet_sys.js';?>"></script>
  </body>
</html>
