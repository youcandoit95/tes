<?php
if ($this->session->flashdata('info')!="")
{
?>
	<div class="span12">
		<div class="alert alert-<?php echo $this->session->flashdata('class_alert'); ?>">
			<strong class="text-center"><?php echo $this->session->flashdata('info'); ?></strong>
		</div>
	</div>
<?php
}
?>

	<form id="myForm2" action="<?php echo site_url().'logins/c_login/login';?>" method="POST">
		<div class="login_container">
			<div class="title_container btn-inverse">
				<div class="w_60" style="padding:10px;">LOGIN - IT Development System</div>
				<div class="w_40" style="float:right; text-align:right;"><img src="<?php echo base_url().'images/jne.png'; ?>" width=82 height=50></div>
			</div>
			<div class="content_container" style="padding-left:20px; width:93%;">
				<table cellpadding="5" style="font-size:14px; color:white;">
						<tr>
							<td>Username</td><td><input type="text" name="username" style="height:30px;" value="<?php echo set_value('username');?>" /></td>
						</tr>
						<tr>
							<td>Password</td><td><input type="password" name="password"   style="height:30px;" value="<?php echo set_value('password');?>" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" value="Login" class="btn btn-primary" /> <a href="" data-toggle="modal" data-target="#box_modal">Forgot Password?</a></td>
						</tr>
				</table>
			</div>
			<div class="clear"></div>
		</div>
	</form>
	
	<br>
	<br>

	<center>
		<!--<input type="button" id="signup_btn" class="btn btn-warning" style="width:100px;" value="SIGN UP">-->
		<a class="hide" id="open_reset_pass" data-toggle="modal" data-target="#reset_pass_modal"></a>
		<script>
		var signup_proses_url = '<?php echo site_url().'signup/c_signup/signup_proses' ?>';

		$(document).ready(function(){
			<?php
			if ($this->session->flashdata('reset_code')!="")
			{
			?>
				setTimeout(function(){
							$("#open_reset_pass").trigger('click');
					},10);
			<?php
			}
			?>
		});
		</script>
		<form id="myForm" class="gone">
			<table cellpadding="10" style="border:1px solid #CCC; width:400px; background-color:#FFF; font-size:12px;" class="shadow">
				<tr class="btn-inverse">
					<td style="padding:10px;" align="left">SIGN UP</td>
					<td style="padding:10px;" align="right"><input type="button" id="login_btn" value="LOG IN" class="btn btn-success" /></td>
				</tr>
				<tr>
					<td>Full Name</td><td><input type="text" name="name" id="name" class="span3 ttip" required="" pattern="[A-z ]{3,70}" data-toggle="tooltip" data-placement="right" title="Minimal 3 Character" style="height:35px;" /></td>
				</tr>
				<tr>
					<td>Email</td><td><input type="email" name="email" id="email" class="span3" required="" style="height:35px;" /></td>
				</tr>
				<tr>
					<td>Username</td><td><input type="text" name="username" id="user" class="span3 ttip" required="" pattern="[a-zA-Z0-9]{6,40}" data-toggle="tooltip" data-placement="right" title="Minimal 6 Character, Special Character Not Allowed" style="height:35px;" /></td>
				</tr>
				<tr>
					<td>Password</td><td><input type="password" name="pass" id="pass" class="span3" required="" pattern="[a-zA-Z0-9]{6,40}" data-toggle="tooltip" data-placement="right" title="Minimal 6 Character, Special Character Not Allowed" style="height:35px;" /></td>
				</tr>
				<tr>
					<td>Re-password</td><td><input type="password" name="re_pass" id="re_pass" class="span3" required="" pattern="[a-zA-Z0-9]{6,40}" data-toggle="tooltip" data-placement="right" title="Minimal 6 Character" style="height:35px;" /></td>
				</tr>
				<tr>
					<td>Departement</td>
					<td>
						<select class="form" name="depart" id="depart" required="">
						<option value="">Choose</option>
						<?php
						foreach ($dept as $d)
						{
							if (isset($dept_select))
							{
								$dpts = $d->dept_id;
								if ($dpts == $dept_select)
								{
									?>
									<option value="<?php echo $d->dept_id;?>" selected="selected"><?php echo $d->dept_name;?></option>
									<?php
								}
								else
								{
									?>
									<option value="<?php echo $d->dept_id;?>"><?php echo $d->dept_name;?></option>
									<?php
								}
							}
							else
							{
								?>
								<option value="<?php echo $d->dept_id;?>"><?php echo $d->dept_name;?></option>
								<?php
							}
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Phone</td><td><input type="text" name="phone" id="phone" class="span3 ttip" style="height:35px;" required="" pattern="[0-9]{11,}" data-toggle="tooltip" data-placement="right" title="Minimal 11 Digits, Numeric only"/></td>
				</tr>
				<tr>
					<td>Office Phone</td><td><input type="text" name="o_phone" id="o_phone" class="span3 ttip" style="height:35px;" required="" pattern="[0-9]{6,}" data-toggle="tooltip" data-placement="right" title="Minimal 6 Digits, Numeric only" /></td>
				</tr>
				<tr>
					<td colspan=2 align="center"><span class="error hide"></span><span class="sukses hide"></span></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="SIGN UP" class="btn btn-primary" /> &nbsp;<span id="loader2" class="gone"><img src="<?php echo base_url().'images/loader2.gif'; ?>" /></span></td>
				</tr>
			</table>

		</form>

		<div id="box_modal" class="modal hide fade">
			<form method="POST" action="<?php echo site_url().'signup/c_signup/reset_password';?>">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<span style="font-size:21px">Reset Password</span>
				</div>
				<div class="modal-body">
					<input type="email" name="reset_email" required="" class="span4" style="height:35px;" placeholder="type here your email address"><br><input type="submit" style="height:35px;" class="btn btn-danger" value="Send">
				</div>
			</form>
		</div>

		<div id="reset_pass_modal" class="modal hide fade">
			<form method="POST" action="<?php echo site_url().'signup/c_signup/do_reset_password'; ?>">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<span style="font-size:21px">Recovery Password</span>
				</div>
				<div class="modal-body">
					<?php
					if ($this->session->flashdata('error_reset')=='true')
					{
						?><div class="alert alert-warning">Please fill the form correctly</div><?php
					}
					?>
					<table class="span5">
						<input type="hidden" name="reset_code" value="<?php echo $this->session->flashdata('reset_code')!="" ? $this->session->flashdata('reset_code') : ""; ?>">
						<tr>
							<td>New Password</td>
							<td><input type="password" name="pass" required="" class="span3" style="height:35px;"></td>
						</tr>
						<tr>
							<td>Confirm Password</td>
							<td><input type="password" name="confpass" required="" class="span3" style="height:35px;"></td>
						</tr>
					</table>
				</div>
				
				<div class="modal-footer">
					<input type="reset" class="btn" value="Reset" style="height:35px;">
					<input type="submit" class="btn btn-success" value="Recovery" style="height:35px;">
				</div>
			</form>
		</div>

	</center>