<?php
/*
$user_agent = $_SERVER['HTTP_USER_AGENT']; 
if (preg_match('/Chrome/i', $user_agent)) { } else { echo"Tolong gunakan web browser Google Chrome<br>Terima Kasih"; break;} */
?>
<html>
	<head>
		<title><?php echo $title; ?>- IT Development System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="<?php echo base_url().'images/favicon.ico';?>">
		<link href="<?php echo base_url().'bootstrap/css/bootstrap.css';?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url().'bootstrap/css/bootstrap-responsive.css';?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url().'css/flick/jquery-ui-1.10.2.custom.css' ?>" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'css/style.css';?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/dt/dt_bootstrap.css'; ?>">  
		
		<script type="text/javascript" src="<?php echo base_url().'js/jquery-1.9.1.js';?> "></script>
		<script type="text/javascript" src="<?php echo base_url().'js/jquery-ui-1.10.1.custom.js';?> "></script>
		<script type="text/javascript" src="<?php echo base_url().'js/dt/jquery.dataTables.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/dt/dt_bootstrap.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/jquery-ui-timepicker-addon.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/jquery-ui-sliderAccess.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/my.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/notification/uh/uh_notification.js';?>"></script>
		<script src="<?php echo base_url().'js/redirect.js';?>"></script>
		
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<a class="brand" href="#" style="color:white;">IT Development System <?php echo $this->session->userdata('user_grid')!="" ? "- ".$this->session->userdata('user_grid') : ""; ?></a>
					
					<div class="nav-collapse collapse">
						<div class="navbar-text pull-right">
							<ul class="nav">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged as <?php echo $this->session->userdata('user_fname');?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<?php /*<li><a href="<?php echo site_url().'manage_account/c_manage_account';?>">Manage Account</a></li>  */ ?>
										<li><a href="<?php echo site_url().'logins/c_login/logOut'; ?>">Log Out</a></li>
									</ul>
								</li>
							</ul>
						</div>
						
						<ul class="nav">
							<li class="<?php echo $this->session->userdata('menu_active')=="new_req" ? "active" : ""; ?>"><a href="<?php echo site_url().'user_request/c_user_request'; ?>">New Request</a></li>
							<li class="<?php echo $this->session->userdata('menu_active')=="all_req" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_ar/c_uh_ar'; ?>">
									<?php /*<span class="btn btn-primary" style="margin:0;"><?php echo $total_request; ?></span> */ ?>
									All Request
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="waiting_respond" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_wr/c_uh_wr'; ?>">
									Waiting Respond
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="on_process" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_op/c_uh_op'; ?>">
									<span class="btn btn-primary hide" style="margin:0;" id="notification_on_process"></span>
									On Process
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="hold" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_hr/c_uh_hr'; ?>">
									<span class="btn btn-primary hide" style="margin:0;" id="notification_hold"></span>
									Hold
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="waiting_done" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_wd/c_uh_wd'; ?>">
									<span class="btn btn-primary hide" style="margin:0;" id="notification_waiting_done"></span>
									Waiting Done
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="revision_request" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_rr/c_uh_rr'; ?>">
									<span class="btn btn-primary hide" style="margin:0;" id="notification_revision"></span>
									Revision
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="done_request" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_dr/c_uh_dr'; ?>">
									Done
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="cancel_request" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_cr/c_uh_cr'; ?>">
									Cancel
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="report" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'uh_report_request/c_report_request'; ?>">
									Report
								</a>
							</li>
						  <!--<li><a href="#about">About</a></li>
						  <li><a href="#contact">Contact</a></li>-->
						</ul>
						
					</div>
					<div class="span1 loader2" id="loader"><img src="<?php echo base_url().'images/spinner-medium.gif';?>"></div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->load->view($content); ?>
				</div>
			</div>
			<hr>
			<footer>
				<p style="font-size:11px;">Copyright&copy; IT Development Department 2013.<br></p>
			</footer>

		</div>
		<script type="text/javascript">
		var user_no = "<?php echo $user_no; ?>";
		var url_on_process_request = "<?php echo site_url().'uh_notification/c_uh_notification/on_process_request'; ?>";
		var url_waiting_done_confirmation = "<?php echo site_url().'uh_notification/c_uh_notification/waiting_done_confirmation'; ?>";
		var url_hold_request = "<?php echo site_url().'uh_notification/c_uh_notification/hold_request'; ?>";
		var url_modal_detail_request = "<?php echo site_url().'uh_notification/c_uh_notification/request_detail'; ?>";
		var url_print = "<?php echo site_url().'print_request/c_print_request/'; ?>";
		var url_print_report = "<?php echo site_url().'uh_report_request/c_report_request/print_report_request'; ?>";
		</script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-transition.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-alert.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-modal.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-dropdown.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-scrollspy.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-tooltip.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-popover.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-button.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-collapse.js';?>"></script>
  </body>
</html>