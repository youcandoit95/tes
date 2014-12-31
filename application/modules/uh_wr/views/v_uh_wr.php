<input type="hidden" id="p_menu_active" value="on_process">
<input type="hidden" id="p_view_content" value="v_sdh_detail_req"> 
<input type="hidden" id="p_view_sub_content" value="v_uh_detail_req_follow_up">

<div class="row">
	<div class="col-sm-12 bg-white con-datatables">
		<table class="table table-hover table-striped table-bordered font-11 datatables">
			<thead>
				<tr>
					<th style="text-align:center" width="17%">Req. No #</th>
					<th style="text-align:center" width="17%">Ref No #</th>
					<th style="text-align:center">Req. Name</th>
					<th style="text-align:center">Req. Type</th>
					<th style="text-align:center">Req. Category</th>
					<?php
					if ($this->session->userdata('user_level')=="4")
					{
						?>
						<th style="text-align:center">Created By</th>
						<?php
					}
					?>
					<th style="text-align:center">Date Created</th>
					<th style="text-align:center" width=5%>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($data_table as $d)
				{
					?>
					<tr>
						<td style="text-align:center"><?php echo $d['REQ_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['REF_NO']; ?></td>
						<td><?php echo $d['REQ_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['TYPE_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['CATEGORY_NAME']; ?></td>
						<?php
						if ($this->session->userdata('user_level')=="4")
						{
							?>
							<td style="text-align:center"><?php echo $d['REQ_BY']; ?></td>
							<?php
						}
						?>
						<td style="text-align:center"><?php echo $d['REQ_CREATED']; ?></td>
						<td style="text-align:center;">
							<a href="#" class="ttip" data-toggle="tooltip" id="<?php echo $d['REQ_NO']; ?>" data-placement="top" data-original-title="Detail" onClick="modal_request_detail_uh(this.id)">
								<i class="glyphicon glyphicon-th-list"></i>
							</a>
							<a href="#" class="ttip" data-toggle="tooltip" id="<?php echo $d['REQ_NO']; ?>" data-placement="top" data-original-title="Cancel" onClick="modal_request_detail_follow_up_uh(this.id)">
								<i class="glyphicon glyphicon-trash"></i>
							</a>
							<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['FILE_DOC_SUPPORT'];?>" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Download Document Support"><i class="glyphicon glyphicon-download-alt"></i></a>
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