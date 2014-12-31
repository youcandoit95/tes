<?php
$sess_msg_status_dml_dept = $this->session->flashdata('msg_status_dml_dept');
$sess_status_dml_dept = $this->session->flashdata('status_dml_dept');
$validation_error = validation_errors();
$hide_html = isset($generate_report_request)!="Y" ? "hide" : "";
$show_new = isset($generate_report_request)!="Y" ? "" : "hide";
$show_recent = isset($generate_report_request)!="Y" ? "hide" : "";
?>

<!-- JS Modules -->	
<script type="text/javascript" src="<?php echo base_url().''?>js/administrator/js_report.js"></script>
<script type="text/javascript">
var url_RC = "<?php echo site_url().'report/c_report_request/ajax_request_case';?>";
var url_DAR = "<?php echo site_url().'status_request/c_sr/AR_detail';?>";
$(document).ready(function(){
	$('.datatable').dataTable({
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
	
	<!-- Form -->
	<div class="span12 <?php echo $show_new; ?>" id="div_new_generate">
		<div class="span6">
			<fieldset>
				<legend>Generate Report<span class="pull-right"><input type="button" id="recent_generate" class="btn <?php echo $hide_html; ?>" value="Recent Generate"></span></legend>
				<form method="POST" action="<?PHP echo site_url().'report/c_report_request/generate_report_request';?>">
				<table style="width:100%" class="table-hover">
					<tr>
						<td>Date Period</td>
						<td><input type="text" name="date_from" class="datepicker form" required="">-<input type="text" name="date_thru" class="datepicker form" required=""></td>
					</tr>
					<tr>
						<td>Request Status</td>
						<td>
							<select name="status" required="">
								<option value="">Choose</option>
								<option value="ALL">ALL</option>
								<option value="DONE">Done</option>
								<option value="Waiting_confirmation_DONE">Wating Done Confirmation</option>
								<option value="HOLD">Hold</option>
								<option value="On Process">On Process</option>
								<option value="Waiting_respond">Waiting Respond</option>
								<option value="CANCEL">Cancel</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Request Based</td>
						<td>
							<select name="based" id="FAD_UR_based" required="">
								<option value="">Choose</option>
								<option value="ALL">ALL</option>
								<option value="Orion">Orion</option>
								<option value="Website">Website</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Request Type</td>
						<td>
							<select name="type" id="FAD_UR_type" required="">
								<option value="">Choose</option>
								<option value="ALL:ALL">ALL</option>
								<?php
								foreach ($request_type as $rt)
								{
								?>
								<option value="<?php echo $rt->requestType_name.":".$rt->requestType_id; ?>"><?php echo $rt->requestType_name;?></option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Request Case</td>
						<td id="FAD_CMB_RC">
							<select name="case" id="FAD_UR_case" onChange="show_RM()" required=""><option value="">Choose</option><option value="ALL">ALL</option></select>
						</td>
					</tr>
					<tr>
						<td>Include request canceled</td>
						<td>
							<select name="canceled" class="ttip" data-toggle="tooltip" data-placement="right" title="Check this if you want include request was canceled">
								<option value="">Choose</option>
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan=2 align="center">
							<input type="submit" value="Generate" class="btn btn-primary">
						</td>
					</tr>
				</table>
				</form>
			</fieldset>
		</div>
	</div>

	<div class="span12 <?php echo $show_recent; ?>" id="div_recent_generate">
		<div class="span6">
			<fieldset>
				<legend>Recent Generate Report<span class="pull-right"><input type="button" id="new_generate" class="btn btn-success" value="New Generate"></span></legend>
				
				<table class="table table-hover table-bordered table-stripped span12">
					<tr>
						<td class="span3">Date Period</td>
						<td class="span6" id="recent_date_period"><?php echo set_value('date_from')." to ".set_value('date_thru');?></td>
					</tr>
					<tr>
						<td>Request Status</td>
						<td id="recent_status"><?php echo set_value('status'); ?></td>
					</tr>
					<tr>
						<td>Request Based</td>
						<td id="recent_based"><?php echo set_value('based'); ?></td>
					</tr>
					<tr>
						<td>Request Type</td>
						<td id="recent_type"><?php $r_type = explode(":",set_value('type')); echo $r_type[0]; ?></td>
					</tr>
					<tr>
						<td>Request Case</td>
						<td id="recent_case"><?php echo set_value('case'); ?></td>
					</tr>
					<tr>
						<td>Include Canceled</td>
						<td id="recent_cancel"><?php echo set_value('canceled')=="Y" ? "Y" : "N"; ?></td>
					</tr>
				</table>

			</fieldset>
		</div>
	</div>
	<!-- Form -->
	
	<!-- Data -->
	<?php
	if (isset($generate_report_request)=="Y")
	{
		$post_type = explode(":",set_value('type'));
		$recent_date_from = date('Y-m-d', strtotime(set_value('date_from')));
		$recent_date_thru = date('Y-m-d', strtotime(set_value('date_thru')));
		$recent_status = set_value('status')=="ALL" ? "" : set_value('status');
		$recent_based = set_value('based')=="ALL" ? "" : set_value('based');
		$recent_type = $post_type[0]=="ALL" ? "" : set_value('type');
		$recent_case = set_value('case')=="ALL" ? "" : set_value('case');
		$recent_cancel = set_value('canceled')=="Y" ? "null" : "Y";
		$data_get_print = "from=".$recent_date_from."&thru=".$recent_date_thru."&status=".$recent_status."&based=".$recent_based."&type=".$recent_type."&case=".$recent_case."&cancel=".$recent_cancel;
	?>
	<div class="span12" id="result_generate">
		<div class="FE_100">
			<div class="printer">
				<a target="_blank" href="<?php echo $rep_generate1.$rep_generate2.$data_get_print; ?>" class="ttip" data-toggle="tooltip" data-placement="top" title="Print">
					<img src="<?php echo base_url().'images/printer-icon.png'; ?>" width=30 height=30>
				</a>
			</div>
		</div>
		
		<div class="FE_95 FE_border FE_form FE_datatable" style="margin-top:10px;">
			<div class="FE_100 FE_datatable">
				
				<table style="font-size:11px;" class="datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Request ID#</th>
							<th>Request User</th>
							<th>Request Based</th>
							<th>Request Type</th>
							<th>PIC Dev</th>
							<th>Request Status</th>
							<th>Request Created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$N = 1;
					foreach ($result as $AR)
					{
						$REQID_WT_SLASH = str_replace('/','_',$AR->request_id);
						$REQID_WT_DASH = str_replace('-','_',$REQID_WT_SLASH);
						?>
						<script type="text/javascript">
							var DR_<?php echo $N; ?> = "<?php echo $AR->request_id; ?>";
						</script>
						<tr>
							<th><?PHP echo$N; ?></th>
								<input type="hidden" id="DATA_WR_UR_<?php echo $N; ?>" value="<?php echo$AR->request_id; ?>">
							<td><?PHP echo$AR->request_id; ?></td>
							<td><?PHP echo$AR->requested_FullName; ?></td>
							<td><?PHP echo$AR->request_based; ?></td>
							<td><?PHP echo$AR->request_type; ?></td>
							<td><?PHP echo$AR->PIC_fullname; ?></td>
							<td><?PHP echo$AR->request_status; ?></td>
							<th><?PHP echo $AR->request_dateCreated ; ?></th>
							<th><i class="icon-list ttip" onClick="openMdl(DR_<?php echo $N; ?>)" data-toggle="tooltip" data-placement="top" title="Detail this request"></i> <a href="<?php echo $rep_request1.$rep_request2.$AR->request_id ?>" target="_blank"><i class="icon-print ttip" data-toggle="tooltip" data-placement="top" title="Print"></i></a></th>
						</tr>
						<?php
						$N++;
					}
					?>
					</tbody>
				</table>
			</div>
		</div>

		<div id="Modal_FTR" class="modal hide fade">
			<form>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<span style="font-size:21px">Detail Request</span>
			</div>
			<div class="modal-body">
				<table class="FE_modal" border=1 cellpadding=3>
					<tr>
						<td width=30%>Request ID#</td>
						<td><span id="D_REQID"></span></td>
					</tr>
					<tr class="FE_modal_even">
						<td>Request Based</td>
						<td><span id="D_REQBased"></span></td>
					</tr>
					<tr>
						<td>Request Type</td>
						<td><span id="D_REQType"></span></td>
					</tr>
					<tr class="FE_modal_even">
						<td>Request Case</td>
						<td><span id="D_REQCase"></span></td>
					</tr>
					<tr>
						<td>Request Modul</td>
						<td><span id="D_REQModul"></span></td>
					</tr>
					<tr class="FE_modal_even">
						<td>Request Desc</td>
						<td><span id="D_REQDesc"></span></td>
					</tr>
					<tr>
						<td>Request Reason</td>
						<td><span id="D_REQReason"></span></td>
					</tr>
					<tr class="FE_modal_even">
						<td>User Requested</td>
						<td><span id="D_REQFname"></span></td>
					</tr>
					<tr>
						<td>Request Created</td>
						<td><span id="D_REQCreated"></span></td>
					</tr>
					<tr class="FE_modal_even">
						<td>PIC Dev</td>
						<td><span id="D_REQPICDev"></span></td>
					</tr>
					<tr>
						<td>Status</td>
						<td><span id="D_REQStatus"></span></td>
					</tr>
					<tr class="FE_modal_even">
						<td>Estimate Time</td>
						<td><span id="D_REQEST"></span></td>
					</tr>
					<tr>
						<td>Status Reason</td>
						<td><span id="D_REQStatusReason"></span></td>
					</tr>
					<tr class="FE_modal_even">
						<td>Status Created Date</td>
						<td><span id="D_REQStatusDate"></span></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
	<?php
	}
	?>
	<!-- End Data -->