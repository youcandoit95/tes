<div class="row-fluid">
	<div class="span12">
		<h2>Generate Report Request</h2>
	</div>
</div>

<div class="row-fluid">
	<div class="span4">
		<table class="table table-striped table-bordered font-12">
			<tr>
				<td>Date Period</td>
				<td><?php echo $p_date_from." s/d ".$p_date_thru; ?></td>
					<input type="hidden" id="date_from" value="<?php echo $p_date_from; ?>">
					<input type="hidden" id="date_thru" value="<?php echo $p_date_thru; ?>">
			</tr>
			<tr>
				<td>Request Type</td>
				<td><?php echo empty($p_req_type) ? "ALL" : $p_req_type; ?></td>
					<input type="hidden" id="req_type" value="<?php echo $p_req_type; ?>">
			</tr>
			<tr>
				<td>Request Category</td>
				<td><?php echo empty($p_req_category) ? "ALL" : $p_req_category; ?></td>
					<input type="hidden" id="req_category" value="<?php echo $p_req_category; ?>">
			</tr>
		</table>
	</div>
	<div class="span8">	
		<a href="#" onClick="print_report_request()">
			<img class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Print" align="right" src="<?php echo base_url().'images/printer-icon.png';?>" valign="top" width=30>
		</a>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped table-bordered font-12" id="example">
			<thead>
				<tr>
					<th style="text-align:center" width=14%>Request No #</th>
					<th style="text-align:center">Request Name</th>
					<th style="text-align:center" width=9%>Request Type</th>
					<th style="text-align:center" width=9%>Request Category</th>
					<th style="text-align:center" width=8%>Ref No #</th>
					<th style="text-align:center">PIC</th>
					<th style="text-align:center">Priority</th>
					<th style="text-align:center">Status</th>
					<th style="text-align:center">Request Created</th>
					<th style="text-align:center">Request Estimated</th>
					<th style="text-align:center">Last Updated</th>
					<th style="text-align:center" width=5%>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($result_generate as $d)
				{
					?>
					<tr>
						<td style="text-align:center"><?php echo $d['REQ_NO']; ?></td>
						<td><?php echo $d['REQ_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_TYPE']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CATEGORY']; ?></td>
						<td><?php echo $d['REF_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_PIC']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_PRIORITY']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_LSTATUS']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CREATED']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_EST_TIME']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_LUPDATED']; ?></td>
						<td style="text-align:center;">
							<a href="#" class="ttip" data-toggle="tooltip" id="<?php echo $d['REQ_NO']; ?>" data-placement="top" data-original-title="Details" onClick="">
								<i class="icon-list"></i>
							</a>
							<a href="#" id="<?php echo str_replace("/","_",$d['REQ_NO']); ?>" onclick="print_request(this.id)" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Print this request"><i class="icon-print"></i></a>
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