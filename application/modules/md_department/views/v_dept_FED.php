<?php
$sess_msg_status_dml_dept = $this->session->flashdata('msg_status_dml_dept');
$sess_status_dml_dept = $this->session->flashdata('status_dml_dept');
?>

<!-- JS Modules -->	
<script type="text/javascript" src="<?php echo base_url().'js/js_modules/js_module_dept.js';?>"></script>
<script type="text/javascript">
var url_FED = "<?php echo site_url().'MD_department/c_dept/GO_FED';?>";
var url_DEL = "<?php echo site_url().'MD_department/c_dept/dept_delete';?>";
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
		<div class="alert alert-danger tengah gone" id="deleteDept">
			<strong>Whoaa!</strong> Department <span id="dept_deleted"></span> was deleted
		</div>
		<!-- End Status Error / Delete -->
		
		<!-- Status Warning / Form error -->
		
			<div class="alert alert-block" id="errorFrm">
				<h4>Warning!</h4>
				<?php echo validation_errors(); ?>
			</div>
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
						<th>Dept. Name</th>
						<th>Active</th>
						<th>Action</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
					$n = 1;
					foreach ($dept_data as $d)
					{
						?>
						<tr id="data_row_<?php echo$n; ?>">
							<th><?php echo$n;?></th>
							
								<input type="hidden" id="data_record_<?php echo$n; ?>" value="<?php echo $d->dept_id;?>">
								<input type="hidden" id="data_delete_name_<?php echo$n; ?>" value="<?php echo $d->dept_name;?>">
								
							<td><?php echo $d->dept_name; ?></td>
							<th>
								<?php
								if ($d->dept_active=="Y")
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
								<input type="image" id="GO_FED_<?php echo$n;?>" src="<?php echo base_url().'images/icon/edit.png';?>">
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
				<input type="button" class="btn btn-primary gone" id="GO_FAD" value="New Data Department" onClick="openFAD()">
			</div>
			<!-- End Button New Data -->
			
			<!-- Form Edit Data -->
			<div class="Admin_dataForm" id="FED">
				<div class="alert alert-info tengah">
				<strong>Please update data correctly</strong>
				</div>
					<form method="POST" action="<?php echo site_url().'MD_department/c_dept/dept_update';?>">
					<table class="backend_form_100" style="width:66%;">
						<tr>
							<td>Dept. Name (NOW)</td>
							<td><span id="FED_dept_name_now"><?php echo $dept_name_now; ?></span></td>
						</tr>
						<tr>
							<td>Dept. Name (Revision)</td>
								<input type="hidden" name="FED_dept_id" id="FED_dept_id" value="<?php echo $dept_id_now;?>">
								<input type="hidden" name="FED_dept_name_compare" id="FED_dept_name_compare" value="<?php echo $dept_name_now; ?>">
							<td><input type="text" class="form" name="FED_dept_name" id="FED_dept_name" value="<?php echo set_value('FED_dept_name');?>"></td>
						</tr>
						<tr>
							<td colspan=2 align="center">
								<input type="button" class="btn btn-danger" id="cancel_FED_dept" value="CANCEL" onClick="closeFED()"> <input type="submit" class="btn btn-success" value="UPDATE">
							</td>							
						</tr>
					</table>
					</form>
				
			</div>
			<!-- End Form Edit Data -->	
	
			<!-- Form New / Add Data -->
			<?php
			
			?>
			<div class="Admin_dataForm gone" id="FAD_dept">
				<form method="POST" action="<?php echo site_url().'MD_department/c_dept/dept_new';?>">
				<table class="backend_form_100" style="width:50%;">
					<tr>
						<td>Dept. Name</td>
						<td><input type="text" class="form" name="new_dept_name" id="new_dept_name" value="<?php echo set_value('new_dept_name');?>"></td>
					</tr>
					<tr>
						<td colspan=2 align="center">
							<input type="button" class="btn btn-danger" id="cancel_FAD_dept" value="CANCEL" onClick="closeFAD()"> <input type="submit" class="btn btn-success" value="INSERT">
						</td>							
					</tr>
				</table>
				</form>
			</div>
			<!-- End Form New / Add Data -->
			
		
		</div>
	</div>
	<!-- End Data and Form -->