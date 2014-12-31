<?php
$user_agent = $_SERVER['HTTP_USER_AGENT']; 
/*if (preg_match('/Chrome/i', $user_agent))
{ } 
else 
{ echo"Tolong gunakan web browser Google Chrome<br>Terima Kasih";
 exit;
}*/
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
		<script type="text/javascript" src="<?php echo base_url().'js/myadmin.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/notification/sdh/sdh_notification.js'; ?>"></script>
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
										<?php /* <li><a href="<?php echo site_url().'manage_account/c_manage_account';?>">Manage Account</a></li> */ ?>
										<li><a href="<?php echo site_url().'logins/c_login/logOut'; ?>">Log Out</a></li>
									</ul>
								</li>
							</ul>
						</div>
						
						<ul class="nav">
							<li class="<?php echo $this->session->userdata('menu_active')=="all_req" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_ar/c_sdh_ar'; ?>">
									All Request
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="new_req" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_nr/c_sdh_nr'; ?>">
									<span class="btn btn-primary gone" style="margin:0;" id="incoming_new_request"></span>
									New Request
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="on_process" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_op/c_sdh_op'; ?>">
									On Process
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="hold" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_hr/c_sdh_hr'; ?>">
									Hold
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="waiting_done" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_wd/c_sdh_wd'; ?>">
									<?php /* <span class="btn btn-primary" style="margin:0;"><?php echo $total_request; ?></span> */ ?>
									Waiting Done
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="revision" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_rr/c_sdh_rr'; ?>">
									<span class="btn btn-primary hide" style="margin:0;" id="notif_revision_request"></span>
									Revision
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="done_request" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_dr/c_sdh_dr'; ?>">
									<span class="btn btn-primary hide" style="margin:0;" id="notif_done_request"></span>
									Done
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="cancel_request" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_cr/c_sdh_cr'; ?>">
									<span class="btn btn-primary gone" style="margin:0;" id="notif_cancel_request"></span>
									Cancel
								</a>
							</li>
							<li class="<?php echo $this->session->userdata('menu_active')=="report" ? "active" : ""; ?>">
								<a href="<?php echo site_url().'sdh_report_request/c_report_request'; ?>">
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
		var url_new_request = "<?php echo site_url().'sdh_notification/c_sdh_notification/new_request'; ?>";
		var url_cancel_request = "<?php echo site_url().'sdh_notification/c_sdh_notification/cancel_request'; ?>";
		var url_revision_request = "<?php echo site_url().'sdh_notification/c_sdh_notification/revision_request'; ?>";
		var url_done_request = "<?php echo site_url().'sdh_notification/c_sdh_notification/done_request'; ?>";
		var url_modal_detail_request = "<?php echo site_url().'sdh_notification/c_sdh_notification/new_request_detail';?>";
		var url_detail_request = "<?php echo site_url().'sdh_notification/c_sdh_notification/detail_request';?>";
		var img_url = "<?php echo base_url().'images/ext/'?>";
		var file_url = "<?php echo base_url().'uploads/'?>";
		var url_print = "<?php echo site_url().'print_request/c_print_request/'; ?>";
		var url_print_report = "<?php echo site_url().'sdh_report_request/c_report_request/print_report_request'; ?>";
	</script>	
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-transition.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-alert.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-modal.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-dropdown.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-scrollspy.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-tab.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-tooltip.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-popover.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-button.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-collapse.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-carousel.js';?>"></script>
    <script src="<?php echo base_url().'bootstrap/js/bootstrap-typeahead.js';?>"></script>
	
  </body>
</html>