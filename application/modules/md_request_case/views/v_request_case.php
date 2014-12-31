<?php
$sess_msg_status_dml_dept = $this->session->flashdata('msg_status_dml_dept');
$sess_status_dml_dept = $this->session->flashdata('status_dml_dept');
$validation_error = validation_errors();
if (isset($sess_status_dml_dept)=="N" && $validation_error!="")
{
	$class_fad = "";
	$class_go_fad = "gone";
}
else
{
	$class_fad = "gone";
	$class_go_fad = "";
}
?>

<!-- JS Modules -->	
<script type="text/javascript" src="<?php echo base_url().'js/js_modules/js_module_requestCase.js';?>"></script>
<script type="text/javascript">
var url_FED = "<?php echo site_url().'md_request_case/c_request_case/GO_FED';?>";
var url_DEL = "<?php echo site_url().'md_request_case/c_request_case/GO_DEL';?>";
var url_ACT = "<?php echo site_url().'md_request_case/c_request_case/RC_activate';?>";
$(document).ready(function(){
	$("#data_modules").dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	});	
});
</script>

<!-- End JS Modules -->	
	
	<!-- Status Form -->
	<div class="Admin_dataStatus">
		
		<!-- Status Sukses -->
		<?php
		if ($sess_msg_status_dml_dept!="" AND $sess_status_dml_dept=="Y")
		{
		?>
		<div class="alert alert-success" id="successFrm">
		<?php
		}
		else
		{
		?>
		<div class="alert alert-success gone" id="successFrm">
		<?php
		}
		?>
			<strong><?php echo substr($sess_msg_status_dml_dept,0,8);?></strong> <?php echo substr($sess_msg_status_dml_dept,8);?>
		</div>
		
		<!-- Status Error / Delete -->
		<div class="alert alert-danger tengah gone" id="DEL">
			<strong>Whoaa!</strong> Request Type <u><span id="data_deleted"></span></u> was deleted
		</div>
		<!-- End Status Error / Delete -->
		
		<!-- Status Warning / Form error -->
		<?php
		if ($validation_error!="")
		{
			?>
			<div class="alert alert-block" id="errorFrm">
				<h4>Warning!</h4>
				<?php echo validation_errors(); ?>
			</div>
			<?php
		}
		?>
		<!-- End Status Warning / Form error -->
		
	</div>
	
	<!-- End Status Form -->	
	
	<!-- Data and Form -->
	<div class="backend_100">
		<!-- left side (Data / Record Modules) -->
		<div class="span6 border">
		
			<!-- Data / Record Modules-->	
			<table id="data_modules" style="font-size:14px; font-family:calibri">
				<thead>
					<tr>
						<th>No</th>
						<th>RC Name</th>
						<th>RC Type</th>
						<th>RC Based</th>
						<th>Active</th>
						<th>Action</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
					$n = 1;
					foreach ($data_rc as $d)
					{
						?>
						<tr id="data_row_<?php echo$n; ?>">
							<th><?php echo$n;?></th>
							
								<input type="hidden" id="data_record_<?php echo$n; ?>" value="<?php echo $d->requestCase_id;?>">
								<input type="hidden" id="data_delete_name_<?php echo$n; ?>" value="<?php echo $d->requestCase_name;?>">
								
							<td><?php echo $d->requestCase_name; ?></td>
							<td><?php echo $d->requestCase_type; ?></td>
							<td><?php echo $d->requestCase_based; ?></td>
							<th>
								<?php
								if ($d->requestCase_active=="Y")
								{
									?><span class="ACTV" id="GO_ACTV_<?php echo$n;?>"><img src="<?php echo base_url().'images/icon/true.png';?>"></span><?php
								}
								else
								{
									?><span class="ACTV" id="GO_ACTV_<?php echo$n;?>"><img src="<?php echo base_url().'images/icon/false.png';?>"></span><?php
								}
								?>
							</th>
							<th>
								<?php /*<input type="image" id="GO_FED_<?php echo$n;?>" src="<?php echo base_url().'images/icon/edit.png';?>">*/?>
								<input type="image" id="GO_DEL_<?php echo$n;?>" src="<?php echo base_url().'images/icon/delete.png';?>">
							</th>
						</tr>
						<?php
						$n++;
					}
					?>
				</tbody>
			</table>
			<!-- End Data / Record Modules-->	
		
		</div>
		<!-- End left side (Data / Record Modules) -->
		
		<!-- Right side (Form / Managing Data) -->
		<div class="span6">
		
			<!-- Button New Data -->
			<div class="Admin_dataButtonAdd" style="text-align:left">
				<input type="button" class="btn btn-primary <?php echo$class_go_fad;?>" id="GO_FAD" value="New Data Request Case" onClick="openFAD()">
			</div>
			<!-- End Button New Data -->
	
			<!-- Form Edit Data -->
			<div class="Admin_dataForm gone" id="FED">
				<div class="alert alert-info tengah">
				<strong>Please update data correctly</strong><br>
				Change Request Case Type click <span class="pointer" id="openRCtype">here</span><br>
				Change Request Case Based click <span class="pointer" id="openRCbased">here</span><br>
				Change Request Case Type and Based click <span class="pointer" id="openRCbasedtype">here</span><br>
				</div>
					<form method="POST" action="<?php echo site_url().'md_request_case/c_request_case/RC_update';?>">
					<table class="backend_form_100" style="width:58%;">
						<tr>
							<td>Request Case Name</td>
							<td><input type="text" class="form" name="FED_RC_name" id="FED_RC_name" value="<?php echo set_value('FED_RC_name');?>"></td>
						</tr>
						<tr id="RCtype">
							<td>Request Case Type</td>
							<td>
								<select name="FED_RC_type" id="FED_RC_type">
									<?PHP
									foreach ($data_rt as $rt)
									{
										$type_tbl = $rt->requestType_id;
										$type_post = set_value('new_RC_type');
										if ($type_tbl == $type_post)
										{
											$selected = "selected='selected'";
										}
										else
										{
											$selected = "";
										}
										?><option value="<?php echo $rt->requestType_id;?>" <?php echo$selected?>><?php echo $rt->requestType_name;?></option><?php
									}
									?>
								</select>
							</td>
						</tr>
						<tr id="RCbased">
							<td>Request Case Based</td>
							<td>
								<select name="FED_RC_based" id="FED_RC_based">
									<?PHP
									$based_post = set_value('FED_RC_based');
									if ($based_post=="Orion")
									{
										$select_based_orion = "selected='selected'";
										$select_based_website = "";
									}
									else if ($based_post=="Website")
									{
										$select_based_orion = "";
										$select_based_website = "selected='selected'";
									}
									?>
									<option value="Orion" <?php echo$select_based_orion; ?>>Orion</option>
									<option value="Website" <?php echo$select_based_website; ?>>Website</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan=2 align="center">
								<input type="button" class="btn btn-danger" id="cancel_FAD" value="CANCEL" onClick="closeFAD()"> <input type="submit" class="btn btn-success" value="INSERT">
							</td>							
						</tr>
					</table>
					</form>
				
			</div>
			<!-- End Form Edit Data -->	
		
			<!-- Form New / Add Data -->
			<div class="Admin_dataForm <?php echo$class_fad;?>" id="FAD">
				<form method="POST" action="<?php echo site_url().'md_request_case/c_request_case/RC_new';?>">
				<table class="backend_form_100" style="width:58%;">
					<tr>
						<td>Request Case Name</td>
						<td><input type="text" class="form" name="new_RC_name" id="new_RC_name" value="<?php echo set_value('new_RC_name');?>"></td>
					</tr>
					<tr>
						<td>Request Case Type</td>
						<td>
							<select name="new_RC_type" id="new_RC_type">
								<?PHP
								foreach ($data_rt as $rt)
								{
									$type_tbl = $rt->requestType_id;
									$type_post = set_value('new_RC_type');
									if ($type_tbl == $type_post)
									{
										$selected = "selected='selected'";
									}
									else
									{
										$selected = "";
									}
									?><option value="<?php echo $rt->requestType_id;?>" <?php echo$selected?>><?php echo $rt->requestType_name;?></option><?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Request Case Based</td>
						<td>
							<select name="new_RC_based" id="new_RC_based">
								<?PHP
									$FAD_based_post = set_value('new_RC_based');
									if ($FAD_based_post!="")
									{
										if ($FAD_based_post=="Orion")
										{
											$FAD_select_based_orion = "selected='selected'";
											$FAD_select_based_website = "";
										}
										else if ($FAD_based_post=="Website")
										{
											$FAD_select_based_orion = "";
											$FAD_select_based_website = "selected='selected'";
										}
										
										/*<option value="Orion" <?php echo$FAD_select_based_orion; ?>>Orion</option>*/
										?>
										<option value="Orion_FNC"  <?php echo$FAD_select_based_orion; ?>>Orion Finance</option>
										<option value="Orion_BLG"  <?php echo$FAD_select_based_orion; ?>>Orion Billing</option>
										<option value="Orion_OPS"  <?php echo$FAD_select_based_orion; ?>>Orion Operation</option>
										<option value="Website" <?php echo$FAD_select_based_website; ?>>Website</option>
										<?php
									}
									else
									{
										/*<option value="Orion">Orion</option>*/
										?>
										<option value="Orion_FNC"  >Orion Finance</option>
										<option value="Orion_BLG"  >Orion Billing</option>
										<option value="Orion_OPS"  >Orion Operation</option>
										<option value="Website">Website</option>
										<?php
									}
									?>
									
							</select>
						</td>
					</tr>
					<tr>
						<td colspan=2 align="center">
							<input type="button" class="btn btn-danger" id="cancel_FAD" value="CANCEL" onClick="closeFAD()"> <input type="submit" class="btn btn-success" value="INSERT">
						</td>							
					</tr>
				</table>
				</form>
			</div>
			<!-- End Form New / Add Data -->
			
		</div>
	</div>
	<!-- End Data and Form -->