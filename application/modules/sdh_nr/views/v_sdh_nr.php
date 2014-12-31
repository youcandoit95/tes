<?PHP
/* Error Form */ 
$VE = validation_errors();
if (!empty($VE) AND empty($status_openFTR))
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
<input type="hidden" id="p_menu_active" value="new_req">
<input type="hidden" id="p_view_content" value="v_sdh_detail_req">
<input type="hidden" id="p_view_sub_content" value="v_sdh_detail_req_take_it">

<div class="row">
	<div class="col-sm-12 bg-white con-datatables">
		<table class="table table-hover table-striped table-bordered font-12 datatables">
			<thead>
				<tr>
					<th style="text-align:center">Req. No #</th>
					<th style="text-align:center">Req. Name</th>
					<th style="text-align:center">Req. Type</th>
					<th style="text-align:center">Req. Category</th>
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
						<td><?php echo $d['REQ_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['TYPE_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['CATEGORY_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CREATED']; ?></td>
						<td style="text-align:center;">
							<a href="#" class="ttip" data-toggle="tooltip" id="<?php echo $d['REQ_NO']; ?>" data-placement="top" data-original-title="Take It" onClick="modal_request_detail_follow_up(this.id)"><i class="glyphicon glyphicon-plus"></i></a>
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
	<form method="POST" action="<?php echo site_url().'sdh_nr/c_sdh_nr/take_request';?>">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<span style="font-size:21px">Take Request</span>
		</div>
		<div class="modal-body">
			<table class="table table-bordered table-striped font-12">
				<tr>
					<td>Estimate Time</td>
					<td>
						<input type="text" name="req_est_time" class="form datetimepicker" required="" style="margin:0;">
					</td>
				</tr>
				<tr>
					<td>Priority</td>
					<td>
						<?php
						foreach ($req_priority as $rp)
						{
							?><label class="radio inline"><input type="radio" name="req_priority" value="<?php echo $rp['PRIORITY_NO'];?>" required=""><?php echo $rp['PRIORITY_NAME'];?></label><?php
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Priority Reason</td>
					<td>
						<textarea name="req_priority_reason" class="span12" required="" style="margin:0;"></textarea>
					</td>
				</tr>
				<tr>
					<td class="span3">Request No #</td>
					<input type="hidden" name="req_no" id="take_req_no">
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
					<td>Request Reason</td>
					<td><span id="modal_req_reason"></span></td>
				</tr>
				<tr>
					<td>Request Note</td>
					<td><span id="modal_req_note"></span></td>
				</tr>
				<tr>
					<td>Request By</td>
					<td><span id="modal_req_by"></span></td>
				</tr>
			</table>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="TAKE IT">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
	</form>
</div>