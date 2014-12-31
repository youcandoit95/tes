<?PHP
/* Error Form */ 
$VE = validation_errors();
if (!empty($VE))
{$VE_gone = "";}
else
{$VE_gone = "gone";}
/* End Error Form */

$sess_dml = $this->session->flashdata('status_dml_dept');
$msg_sess_dml = $this->session->flashdata('msg_status_dml_dept');
if (($sess_dml=="Y") AND (!empty($msg_sess_dml)))
{$class_dml = "";}
else
{$class_dml = "gone";}
?>

<div class="FE_95 FE_border FE_form" id="FAD_UR" style="margin-top:10px;">
	<div class="alert alert-warning <?php echo $VE_gone; ?>" id="error_frm" >
		<h4>Warning!</h4>
		<?php echo validation_errors(); ?>
	</div>
	
	<div class="alert alert-success <?php echo $class_dml; ?>" id="successFrm">
		<button type="button" class="close" id="close_successFrm" data-dismiss="alert">&times;</button>
		<strong><?php echo substr($msg_sess_dml,0,8);?></strong> <?php echo substr($msg_sess_dml,8);?>
	</div>
	
	<div class="FE_95">
		<fieldset>
			<legend>Form Generate Report Request</legend>
			<form method="POST" action="<?PHP echo site_url().'uh_report_request/c_report_request/generate_report';?>">
				<table class="table-hover table table-bordered">
					<tr>
						<td class="span3">Date Period</td>
						<td>
							<input type="text" name="date_from" class="form dtpicker" required="" placeholder="Date From">
							<input type="text" name="date_thru" class="form dtpicker" required="" placeholder="Date Thru">
						</td>
					</tr>
					<tr>
						<td>Request Type</td>
						<td>
							<select name="req_type">
								<option value="">ALL</option>
								<?php 
								foreach ($req_type as $rt)
								{
									?><option value="<?php echo $rt['TYPE_NO']; ?>"><?php echo $rt['TYPE_NAME']; ?></option><?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Request Category</td>
						<td>
							<select name="req_category">
								<option value="">ALL</option>
								<?php 
								foreach ($req_category as $rc)
								{
									?><option value="<?php echo $rc['CATEGORY_NO']; ?>"><?php echo $rc['CATEGORY_NAME']; ?></option><?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr id="FAD_BTN_submit" style="padding-top:1%;">
						<td colspan=2 style="text-align:center;">
							<input type="submit" class="btn btn-success" value="Generate">
						</td>
					</tr>
				</table>
			</form>
		</fieldset>
	</div>
</div>