<html>
	<head>
		<title><?php echo $title;?> IT Development System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="<?php echo base_url().'images/favicon.ico';?>">
		<link href="<?php echo base_url().'bootstrap/css/bootstrap.css';?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url().'bootstrap/css/bootstrap-responsive.css';?>" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/dt/dt_bootstrap.css'; ?>">  
			
		<link href="<?php echo base_url().'css/flick/jquery-ui-1.10.2.custom.css' ?>" rel="stylesheet" type="text/css">	
		<link rel="stylesheet" href="<?php echo base_url().'css/style.css';?>">

		<script src="<?php echo base_url().'js/jquery-1.9.1.js';?> "></script>
		<script src="<?php echo base_url().'js/jquery-ui-1.10.1.custom.js';?> "></script>
		<script type="text/javascript" src="<?php echo base_url().'js/dt/jquery.dataTables.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/dt/dt_bootstrap.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/mymd.js';?>"></script>
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
					
					<a class="brand" style="color:white" href="#">IT Development System - Administrator</a>
					
					
					<div class="nav-collapse collapse">
						<div class="navbar-text pull-right">
							<ul class="nav">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged as <?php echo $this->session->userdata('user_nickname'); ?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<?php /* <li><a href="#">Setting Account</a></li> */ ?>
										<li><a href="<?php echo site_url().'logins/c_login/logOut'; ?>">Log Out</a></li>
									</ul>
								</li>
							</ul>
						</div>
						
						<ul class="nav">
							<?php
							$menu_active = $this->session->userdata('menu_active');
							
							/* Menu Dept */
							if ($menu_active=="dept")
							{
								?><li class="active"><?php
							}
							else
							{
								?><li><?php
							}
							?>
										<a href="<?php echo site_url().'md_department/c_dept/dept_index';?>">Department</a>
									</li>
							<!-- End Menu Dept-->
							
							<?php
							/* Menu Status */
							if ($menu_active=="status")
							{
								?><li class="active"><?php
							}
							else
							{
								?><li><?php
							}
							?>
										<a href="<?php echo site_url().'md_status/c_status/';?>">Status</a>
									</li>
							<!-- End Menu Dept-->
							
							<?php
							/* Menu User */
							if ($menu_active=="user")
							{
								?><li class="active"><?php
							}
							else
							{
								?><li><?php
							}
							?>
										<a href="<?php echo site_url().'md_users/c_users/user';?>">User</a>
									</li>
							<!-- End Menu User-->
							
							<?php
							/* Menu Request Type / Case */
							if ($menu_active=="request")
							{
								?><li class="dropdown active"><?php
							}
							else
							{
								?><li class="dropdown"><?php
							}
							?>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Request</a>
											<ul class="dropdown-menu" style="left:0px;">
												<li><a href="<?php echo site_url().'md_request_category/c_request_category/'; ?>">Request Category</a></li>
												<li><a href="<?php echo site_url().'md_request_type/c_request_type/'; ?>">Request Type</a></li>
												<li><a href="<?PHP echo site_url().'md_request_priority/c_request_priority/'; ?>">Request Priority</a></li>
											</ul>
									</li>
							<!-- End Menu Request Type / Case -->
							
							<?php
							/* Menu Reporting */
							/*
							if ($menu_active=="reporting")
							{
								?><li class="dropdown active"><?php
							}
							else
							{
								?><li class="dropdown"><?php
							}
							?>
										<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reporting</a>
											<ul class="dropdown-menu">
												<li><a href="<?php echo site_url().'report/c_report_request/form_report_request'; ?>">Regular</a></li>
												<li><a href="<?php echo site_url().'report/c_report_request/form_report_graphic';?>">Graphic</a></li>
											</ul>
									</li>
							<!-- End Menu Request Type / Case -->
						  <!--<li><a href="#contact">Contact</a></li>-->*/ 
						  ?>
						</ul>
						
					</div>
					
					<div class="span1 loader" id="loader"><img src="<?php echo base_url().'images/spinner-medium.gif';?>"></div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row-fluid">
				<!-- Content -->
				<div class="span12">
					<?php echo $this->load->view($content_admin); ?>
				</div>
			</div>
			<hr>
			<footer>
				<p>Copyright&copy; IT Development Department 2013.</p>
			</footer>

		</div>
		
    
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