<?php
$sess_msg_status_dml_dept = $this->session->flashdata('msg_status_dml_dept');
$sess_status_dml_dept = $this->session->flashdata('status_dml_dept');
$validation_error = validation_errors();
?>

<!-- JS Modules -->	
<script type="text/javascript" src="<?php echo base_url().'js/js_modules/md_status.js';?>"></script>
<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>"
var url_FED = "<?php echo site_url().'md_status/c_status/GO_FED';?>";
var url_DEL = "<?php echo site_url().'md_status/c_status/status_delete';?>";
var url_ACTV = "<?php echo site_url().'md_status/c_status/status_activate_ajax';?>";
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
			<a class="close" data-dismiss="alert" href="#successFrm">&times;</a>
			<strong><?php echo substr($sess_msg_status_dml_dept,0,8);?></strong> <?php echo substr($sess_msg_status_dml_dept,8);?>
		</div>
		
		<!-- Status Error / Delete -->
		<div class="alert alert-danger tengah gone" id="delete_container">
			<strong>Whoaa!</strong> Department <span id="delete_text"></span> was deleted
		</div>
		
		<div class="alert alert-warning tengah gone" id="error_ajax">
			<span id="txt_error_ajax"></span>
		</div>
		
		<?php
		if (isset($error_msg)!="" || $this->session->flashdata('error_msg')!="")
		{
		?>
		<div class="alert alert-danger tengah" id="deleteDept">
			<a class="close" data-dismiss="alert" href="#deleteDept">&times;</a><?php echo isset($error_msg)!="" ? $error_msg : $this->session->flashdata('error_msg'); ?>
		</div>
		<?php
		}
		?>
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
		<div class="row-fluid">
		<div class="span12">
		
			<!-- Button New Data -->
			<div class="Admin_dataButtonAdd <?php echo isset($error_msg)!="" ? "gone" : ""; ?>" style="text-align:left">
				<input type="button" class="btn btn-primary" id="GO_FAD" value="New Status">
			</div>
			<!-- End Button New Data -->
			
			<!-- Form Edit Data -->
			<div class="Admin_dataForm gone" id="FED">
				<div class="alert alert-info tengah">
				<strong>Please update data correctly</strong>
				</div>
					<form method="POST" action="<?php echo site_url().'md_status/c_status/status_update';?>">
					<table class="backend_form_100 span4" >
						<tr>
							<td colspan=2><h3><u>Edit Data Status</u></h3></td>
						</tr>
						<tr>
							<td>Status Name</td><input type="hidden" name="status_no" id="fed_status_no">
							<td><input type="text" class="form" name="status_name" id="fed_status_name" value="<?php echo set_value('status_name');?>" required=""></td>
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
			<div class="Admin_dataForm <?php echo isset($error_msg)!="" ? "" : "gone"?>" id="FAD_dept">
				<div class="span12">
				<form method="POST" action="<?php echo site_url().'md_status/c_status/status_new';?>">
				<table class="backend_form_100 span4" >
					<tr>
						<td colspan=2><h3><u>New Status</u></h3></td>
					</tr>
					<tr>
						<td>Status Name</td>
						<td><input type="text" class="form" name="status_name" id="status_name" value="<?php echo set_value('status_name');?>" required=""></td>
					</tr>
					<tr>
						<td colspan=2 align="center">
							<input type="button" class="btn btn-danger" id="cancel_FAD_dept" value="CANCEL" onClick="closeFAD()"> <input type="submit" class="btn btn-success" value="INSERT">
						</td>							
					</tr>
				</table>
				</form>
				</div>
			</div>
			<!-- End Form New / Add Data -->
			
		
		</div>
		</div>
		
		<!-- left side (Data / Record Modules) -->
		
		<div class="row-fluid">
			<div class="span12">
				<table class="table table-striped table-bordered font-12 span5" id="example">
					<thead>
						<tr>
							<th style="text-align:center">Status No.</th>
							<th style="text-align:center">Status Name</th>
							<th style="text-align:center">Active</th>
							<th style="text-align:center">Action</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
						$n = 1;
						foreach ($data as $d)
						{
							?>
							<tr id="data_row_<?php echo$n; ?>">
								<th style="text-align:center"><?php echo $d['STATUS_NO']==888 ? $d['STATUS_NO'] : $d['STATUS_NO'];?></th>
								
									<input type="hidden" id="data_record_<?php echo$n; ?>" value="<?php echo $d['STATUS_NO'];?>">
									<input type="hidden" id="data_delete_name_<?php echo$n; ?>" value="<?php echo $d['STATUS_NAME'];?>">
									
								<td><?php echo $d['STATUS_NAME']; ?></td>
								<td style="text-align:center">
									<?php
									if ($d['STATUS_ACTIVE']==1)
									{
										?><span class="ACTV" id="GO_ACTV_<?php echo$n;?>"><img src="<?php echo base_url().'images/icon/true.png';?>"></span><?php
									}
									else
									{
										?><span class="ACTV" id="GO_ACTV_<?php echo$n;?>"><img src="<?php echo base_url().'images/icon/false.png';?>"></span><?php
									}
									?>
								</td>
								<td style="text-align:center">
									<input type="image" id="GO_FED_<?php echo$n;?>" src="<?php echo base_url().'images/icon/edit.png';?>">
									<a onClick="return confirm('are you sure want to delete ?');" href="<?php echo site_url().'md_status/c_status/status_delete/'.$d['STATUS_NO']; ?>"><img src="<?php echo base_url().'images/icon/delete.png';?>"></a>
								</td>
							</tr>
							<?php
							$n++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- End left side (Data / Record Modules) -->
		
	</div>
	<!-- End Data and Form -->