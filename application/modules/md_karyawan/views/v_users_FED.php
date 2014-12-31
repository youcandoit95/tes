<script type="text/javascript" src="<?php echo base_url().'js/js_modules/js_module_user.js';?>"></script>
 <script type="text/javascript">
		$(document).ready(function() {
				$('#datatable').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
				$('sup').tooltip();
				$('input.act').tooltip();
				$("#")
			});
			
		var url_frmNewUser = "<?php echo site_url().'users/c_users/new_user';?>";
		var url_cekUser = "<?php echo site_url().'users/c_users/cek_user';?>";	
		var url_goFED = "<?php echo site_url().'users/c_users/FED_User';?>";
		var url_delUser = "<?php echo site_url().'users/c_users/DEL_user_ajax';?>";
		var TD_user = "<?php	foreach ($TD_user as $t) {echo "$t->total";} ?>";
</script>
	<div class="Admin_dataStatus">
		<?php
		$sess_newUser = $this->session->flashdata('sukses_newUser');
		$sess_updUser = $this->session->flashdata('sukses_updateUser');
		if ($sess_newUser!="")
		{
			?>
			<div class="alert alert-success" id="successFrm">
				<button type="button" class="close" id="close_successFrm">&times;</button>
				<strong><?php echo substr($sess_newUser,0,8);?></strong> <?php echo substr($sess_newUser,8);?>
			</div>
			<?php
		}
		if ($sess_updUser!="")
		{
			?>
			<div class="alert alert-success" id="successFrm">
				<button type="button" class="close" id="close_successFrm">&times;</button>
				<strong><?php echo substr($sess_updUser,0,8);?></strong> <?php echo substr($sess_updUser,8);?>
			</div>
			<?php
		}
		
		/*
		$sess_delUser = $this->session->userdata('sukses_deleteUser');
		if ($sess_delUser!="")
		{
			?>
				<div class="alert alert-danger" id="deleteUser">
					<strong><?php echo substr($sess_delUser,0,6)?></strong> <?php echo substr($sess_delUser,7)?>
				</div>
			<?php
		}
		*/
		?>
		
		<div class="alert alert-danger gone" id="deleteUser">
			<strong>Whoaa!</strong> Username <span id="deletedUserName"></span> was deleted
		</div>
		
		
			<div class="alert alert-block" id="errorFrm">
				<h4>Warning!</h4>
				<?php echo validation_errors(); ?>
			</div>
	</div>

	<div class="Admin_dataButtonAdd">
		<input type="button" class="btn btn-primary gone" id="add_data" value="New User" onClick="openForm()">
	</div>
	
	<div class="Admin_dataForm" id="FED_User">
		<div class="alert alert-info">
			If you dont want to change password , please let it blank field password and re-password<br/>
			If you want to <strong>change password click <span id="GO_FED_User_changePass">here</span></strong>
			If you want to <strong>CANCEL change password click <span id="GO_FED_User_Cancel_changePass">here</span></strong>
		</div>
		<form method="POST" action="<?php echo site_url().'users/c_users/edit_user';?>">
		<table style="border:1px solid #ccc; margin-bottom:20px; padding-left:20px; width:50%;">
			<tr>
				<td width=150>Username</td><input type="hidden" name="FED_id" id="FED_id" value="<?php echo set_value('FED_id');?>"><input type="hidden" id="FED_compareUsername" name="FED_compareUsername" value="<?php echo set_value('FED_compareUsername');?>">
				<td><input type="text" class="form" id="FED_username" name="FED_username" value="<?php echo set_value('FED_username');?>"><sup id="tooltip_username" data-toggle="tooltip" data-placement="top" title="Your username for login authorization"><img src="<?php echo base_url().'images/icon/question.png';?>" width=10 height=8></sup>  <span class="cekAvUserTrue"></span><span class="cekAvUserFalse"></span></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" class="form" name="FED_email" id="FED_email" value="<?php echo set_value('FED_email');?>"></td>
			</tr>
			
			<?php
			$notmatch = $salah_pass;
			if ($notmatch!="")
			{
				if ($notmatch=="Y")
				{$class_pass = "";}
				else
				{$class_pass = "gone";}
			}
			?>
			<tr id="FED_F_Password" class="<?php echo$class_pass;?>">
				<td>Password</td><input type="hidden" name="FED_statChangePass" id="FED_statChangePass" value="N">
				<td><input type="password" class="form" name="FED_password" id="FED_password"><span class="cekPassMatchTrue"></span><span class="cekPassMatchFalse"></span></td>
			</tr>
			
			<tr id="FED_F_Re_Password" class="<?php echo$class_pass;?>">
				<td>Re-Password</td>
				<td><input type="password" class="form" name="FED_re_password" id="FED_re_password"><sup id="tooltip_rePass" data-toggle="tooltip" data-placement="top" title="Please fill again your password"><img src="<?php echo base_url().'images/icon/question.png';?>" width=10 height=8></sup><span class="cekPassMatchTrue2"></span><span class="cekPassMatchFalse2"></span></td>
			</tr>
			<tr>
				<td>Fullname</td>
				<td><input type="text" class="form" name="FED_fullname" id="FED_fullname" value="<?php echo set_value('FED_fullname');?>"></td>
			</tr>
			<tr>
				<td>Department</td>
				<td><input type="text" class="form" name="FED_department" id="FED_department" value="<?php echo set_value('FED_department');?>"></td>
			</tr>
			<tr>
				<td>Phone Personal</td>
				<td><input type="text" class="form" name="FED_phn_personal" id="FED_phn_personal" value="<?php echo set_value('FED_phn_personal');?>"><sup id="tooltip_phonePersonal" data-placement="top" title="Your handphone number"><img src="<?php echo base_url().'images/icon/question.png';?>" width=10 height=8></sup></td>
			</tr>
			<tr>
				<td>Phone Office</td>
				<td><input type="text" class="form" name="FED_phn_office" id="FED_phn_office" value="<?php echo set_value('FED_phn_office');?>"><sup id="tooltip_phoneOffice" data-placement="top" title="Your phone office number"><img src="<?php echo base_url().'images/icon/question.png';?>" width=10 height=8></sup></td>
			</tr>
			<tr>
				<td colspan=2 align="center"><input type="button" id="FED_BTN_cancel" class="btn btn-danger" value="CANCEL"> <input type="submit" value="UPDATE" class="btn btn-success"></td>
			</tr>
		</table>
		</form>
	</div>
	
	
	<div class="Admin_dataForm gone" id="form_add_data"><

		<form method="POST" action="<?php echo site_url().'users/c_users/new_user';?>">
		<table style="border:1px solid #ccc; margin-bottom:20px; padding-left:20px; width:50%;">
			<tr>
				<td width=150>Username</td>
				<td><input type="text" class="form" name="username" id="frm_username" value="<?php echo set_value('username');?>"><sup id="tooltip_username" data-toggle="tooltip" data-placement="top" title="Your username for login authorization"><img src="<?php echo base_url().'images/icon/question.png';?>" width=10 height=8></sup>  <span class="cekAvUserTrue"></span><span class="cekAvUserFalse"></span></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" class="form" name="email" id="frm_email" value="<?php echo set_value('email');?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" class="form" name="password" id="frm_password" value="<?php set_value('password');?>"><span class="cekPassMatchTrue"></span><span class="cekPassMatchFalse"></span></td>
			</tr>
			<tr>
				<td>Re-Password</td>
				<td><input type="password" class="form" name="re_password" id="re_frm_password" value="<?php set_value('re_password');?>"><sup id="tooltip_rePass" data-toggle="tooltip" data-placement="top" title="Please fill again your password"><img src="<?php echo base_url().'images/icon/question.png';?>" width=10 height=8></sup><span class="cekPassMatchTrue2"></span><span class="cekPassMatchFalse2"></span></td>
			</tr>
			<tr>
				<td>Fullname</td>
				<td><input type="text" class="form" name="fullname" id="frm_fullname" value="<?php echo set_value('fullname');?>"></td>
			</tr>
			<tr>
				<td>Department</td>
				<td><input type="text" class="form" name="department" id="frm_department" value="<?php echo set_value('department');?>"></td>
			</tr>
			<tr>
				<td>Phone Personal</td>
				<td><input type="text" class="form" name="phn_personal" id="frm_phn_personal" value="<?php echo set_value('phn_personal');?>"><sup id="tooltip_phonePersonal" data-placement="top" title="Your handphone number"><img src="<?php echo base_url().'images/icon/question.png';?>" width=10 height=8></sup></td>
			</tr>
			<tr>
				<td>Phone Office</td>
				<td><input type="text" class="form" name="phn_office" id="frm_phn_office" value="<?php echo set_value('phn_office');?>"><sup id="tooltip_phoneOffice" data-placement="top" title="Your phone office number"><img src="<?php echo base_url().'images/icon/question.png';?>" width=10 height=8></sup></td>
			</tr>
			<tr>
				<td colspan=2 align="center"><input type="button" id="cancel_add_data" onClick="closeForm()" class="btn btn-danger" value="Cancel"> <input type="submit" value="register" class="btn btn-success"></td>
			</tr>
		</table>
		</form>
	</div>
		
	<div class="Admin_dataContent border">
		<table id="datatable" style="font-size:12px;">
			<thead>
				<tr>
					<th>No</th>
					<th>User Name</th>
					<th>User Email</th>
					<th>User Fullname</th>
					<th>User Department</th>
					<th>User Phone</th>
					<th>User Phone Office</th>
					<th>User Created</th>
					<th>Active</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<?php
			$n = 1;
			?>
			
			<tbody>
				<?php
				foreach ($data_user as $d)
				{
					?>
					<tr id="row_deleteUser<?php echo$n;?>">
					
						<th><?php echo $n; ?><input type="hidden" id="males<?php echo$n; ?>" value="<?php echo $d->user_id;?>"></th>
						<td><?php echo $d->user_name; ?><input type="hidden" id="deleteUserame<?php echo$n; ?>" value="<?php echo $d->user_name;?>"></td>
						<td><?php echo $d->user_email; ?></td>
						<td><?php echo $d->user_fullName; ?></td>
						<td><?php echo $d->user_dept; ?></td>
						<td><?php echo $d->user_phonePersonal; ?></td>
						<td><?php echo $d->user_phoneOffice; ?></td>
						<td align="center"><?php echo $d->user_created; ?></td>
						<td align="center">
							<?php
							$active = $d->user_active; 
							if ($active == "Y")
							{
								?>
								<a href="<?php echo site_url().'users/c_users/Activate_user/'.$d->user_id;?>"> <img src="<?php echo base_url().'images/icon/true.png';?>"></a>
								<?php
							}
							else
							{
								?>
								<a href="<?php echo site_url().'users/c_users/Activate_user/'.$d->user_id;?>"><img src="<?php echo base_url().'images/icon/false.png';?>"></a>
								<?php
							}
							?>
						</td>
						<td align="center">
							<input type="image" class="act" id="GO_FED_User_<?php echo$n; ?>" src="<?php echo base_url().'images/icon/edit.png';?>" data-toggle="tooltip" data-placement="top" title="Edit">
							<input type="image" class="act" id="DEL_User_<?php echo$n;?>" src="<?php echo base_url().'images/icon/delete.png';?>" data-toggle="tooltip" data-placement="top" title="Delete">
						</td>
					</tr>
					<?php
					$n++;
				}
				?>
			</tbody>
		</table>
	</div>