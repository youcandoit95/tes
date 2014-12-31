<?php
$sess_login_level = $this->session->userdata('user_level');
if ($sess_login_level==2 || $sess_login_level==4)
{
	$function_detail = "modal_request_detail_uh";
	?>
	<input type="hidden" id="p_view_content" value="v_sdh_detail_req"> 
	<?php
}
else if ($sess_login_level==1 || $sess_login_level==3)
{
	$function_detail = "modal_request_detail";
	?>
	<input type="hidden" id="p_view_content" value="v_sdh_detail_req">
	<?php
}
?>

	<input type="hidden" id="p_menu_active" value="report">

<div class="row">
	<div class="col-sm-5">
		<table class="table table-hover table-striped table-bordered font-12">
			<tr>
				<td>Date Period</td>
				<td><?php echo $p_date_from==""&&$p_date_thru=="" ? "ALL" : $p_date_from." s/d ".$p_date_thru; ?></td>
					<input type="hidden" id="date_from" value="<?php echo $p_date_from; ?>">
					<input type="hidden" id="date_thru" value="<?php echo $p_date_thru; ?>">
			</tr>
			<tr>
				<td>Request Type</td>
				<td><?php echo empty($p_req_type) ? "ALL" : $p_req_type; ?></td>
					<input type="hidden" id="req_type" value="<?php echo $p_req_type_id; ?>">
			</tr>
			<tr>
				<td>Request Category</td>
				<td><?php echo empty($p_req_category) ? "ALL" : $p_req_category; ?></td>
					<input type="hidden" id="req_category" value="<?php echo $p_req_category; ?>">
			</tr>
			<tr>
				<td>Request By</td>
				<td><?php echo $p_req_by_translate; ?></td>
					<input type="hidden" id="req_by" value="<?php echo $p_req_by; ?>">
			</tr>
			<tr>
				<td>Request PIC</td>
				<td><?php echo $p_req_pic_name; ?></td>
					<input type="hidden" id="req_pic" value="<?php echo $p_req_pic; ?>">
			</tr>
		</table>
	</div>
	<div class="span8">	
		<a href="#" onClick="print_report_request()">
			<img class="ttip img-circle img-print" data-toggle="tooltip" data-placement="top" data-original-title="Print" align="right" src="<?php echo base_url().'images/printer-icon.png';?>">
		</a>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 bg-white con-datatables">
		<table class="table table-hover table-striped table-bordered font-11 datatables">
			<thead>
				<tr>
					<th style="text-align:center">Req. No #</th>
					<th style="text-align:center">Ref No #</th>
					<th style="text-align:center">Req. Type</th>
					<th style="text-align:center">Req. Category</th>
					<th style="text-align:center">PIC</th>
					<th style="text-align:center">Status</th>
					<th style="text-align:center">Date Created</th>
					<th style="text-align:center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($result_generate as $d)
				{
					?>
					<tr>
						<td style="text-align:center"><?php echo $d['REQ_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['REF_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_TYPE']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CATEGORY']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_PIC']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_LSTATUS']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CREATED']; ?></td>
						<td style="text-align:center;">
							<a href="#" class="ttip" data-toggle="tooltip" id="<?php echo $d['REQ_NO']; ?>" data-placement="top" data-original-title="Details" onClick="<?php echo $function_detail;?>(this.id)">
								<i class="glyphicon glyphicon-th-list"></i>
							</a>
							<?php
							if ($d['REQ_LSTATUS']=="1")
							{
							?>
								<a href="#" id="<?php echo str_replace("/","_",$d['REQ_NO']); ?>" onclick="print_request(this.id)" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Print this request"><i class="glyphicon glyphicon-print"></i></a>
							<?php
							}
							?>
							<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['F_DOC_SUPPORT'];?>" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Download File Attachment"><i class="glyphicon glyphicon-download-alt"></i></a>
							<?php
							if ($d['FILE_UAT']!="N/A")
							{
							?>
								<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['FILE_UAT'];?>" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Download File UAT"><i class="glyphicon glyphicon-download"></i></a>
							<?php
							}
							?>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<div id="Modal_FTR" class="modal hide fade">
	<form method="POST" action="<?php echo site_url().'uh_cr/c_uh_cr/cancel_request';?>">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<span style="font-size:21px">Cancel Request</span>
		</div>
		<div class="modal-body">
			<table class="table table-bordered table-striped font-12">
				<tr>
					<td class="span3">Request No #</td>
					<input type="hidden" name="req_no" id="req_no">
					<td><span id="modal_req_no"></span></td>
				</tr>
				<tr>
					<td>Request Name</td>
					<td><span id="modal_req_name"></span></td>
				</tr>
				<tr>
					<td>Request Type</td>
					<td><span id="modal_req_type"></span></td>
				</tr>
				<tr>
					<td>Request Category</td>
					<td><span id="modal_req_category"></span></td>
				</tr>
				<tr>
					<td>Ref No #</td>
					<td><span id="modal_req_ref_no"></span></td>
				</tr>
				<tr>
					<td>Request PIC</td>
					<td><span id="modal_req_PIC"></span></td>
				</tr>
				<tr>
					<td>Request Est. Time</td>
					<td><span id="modal_req_est_time"></span></td>
				</tr>
				<tr>
					<td>Request Reason</td>
					<td><span id="modal_req_reason"></span></td>
				</tr>
				<tr>
					<td>Request Note</td>
					<td><span id="modal_req_note"></span></td>
				</tr>
				<tr>
					<td>Cancel Reason</td>
					<td>
						<textarea name="req_cancel_reason" class="span12" required="" style="margin:0;"></textarea>
					</td>
				</tr>
			</table>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-danger" value="CANCEL">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
	</form>
</div>

<script>var url_print_report = "<?php echo site_url().'sdh_report_request/c_report_request/print_report_request'; ?>";</script>