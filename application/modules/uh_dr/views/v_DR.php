<?PHP
/** View SD Home
 * UR = user request , SD = Staff Dev , NNR = Notification New Request , CNR = Check New Request, DWR = Data Waiting Respond , SDH = 
 * VE = validation / warning error form
 *
 *
 *
 */
 
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


if(!empty($openFTR) AND !empty($status_openFTR))
{
	if ($status_openFTR=="YH")
	{
		$show_hold_reason = "";
		$choose_hold = "selected='selected' ";
		$choose_cancel = "";
		
		$show_EST_time = "gone";
		$choose_OP = "" ;
	}
	else if ($status_openFTR=="YOP")
	{
		$show_hold_reason ="gone";
		$choose_hold = "";
		$choose_cancel = "";
		
		$show_EST_time = "";
		$choose_OP = " selected='selected' " ;
	}
	else if ($status_openFTR=="YC")
	{
		$show_hold_reason ="";
		$choose_hold = "";
		$choose_cancel = " selected='selected' ";
		
		$show_EST_time = "gone";
		$choose_OP = "" ;
	}
	else
	{
		$show_hold_reason ="gone";
		$choose_hold = "";
		$choose_cancel = "";
		
		$show_EST_time = "gone";
		$choose_OP = "";
	}
	$class_E_modal = "";
	?>
	<script type="text/javascript">
	
		$(document).ready(function(){
			var BTN_F_FTR = "<?php echo$openFTR; ?>";
			$(document).ready(function(){
				setTimeout(function(){
					$("#"+BTN_F_FTR).trigger('click');
			},10);
			});
		});
	</script>
	<?php
}
else
{
	$show_hold_reason ="gone";
	$choose_hold = "";
	$choose_cancel = "";
	$show_EST_time = "gone";
	$choose_OP = "";
	$class_E_modal = "gone";
}
?>
<script type="text/javascript" src="<?php echo base_url().'js/SD/js_UH.js';?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.datatable').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
	});
	$('sup').tooltip();
	$('input.act').tooltip();
	$('button.act').tooltip();
});

var url_CAR = "<?php echo site_url().'status_request/c_SR_UH/AR';?>";
var url_CDR = "<?php echo site_url().'status_request/c_SR_UH/DR'; ?>";
var url_DAR = "<?php echo site_url().'status_request/c_SR/AR_detail';?>";
var url_CWR = "<?php echo site_url().'status_request/c_SR_UH/WR'; ?>";
var url_COP = "<?php echo site_url().'status_request/c_SR_UH/OP'; ?>";
var url_CRR = "<?php echo site_url().'status_request/c_SR_UH/RR';?>";
var url_CWD = "<?php echo site_url().'status_request/c_SR_UH/WD';?>";
var url_CHR = "<?php echo site_url().'status_request/c_SR_UH/HR';?>";
var url_CTR = "<?php echo site_url().'status_request/c_SR_UH/UH_CTR';?>";
var url_FTR = "<?php echo site_url().'status_request/c_SR_UH/FTR';?>";
var url_CCR = "<?php echo site_url().'status_request/c_SR_UH/CR';?>";
var url_DAR = "<?php echo site_url().'status_request/c_sr/AR_detail';?>";
var url_VN = "<?php echo site_url().'status_request/c_sr/SR_VN';?>";
var id_user = "<?php echo $this->session->userdata('login_id');?>";
</script>

<div class="FE_95 FE_form" id="FAD_UR" style="margin-top:10px;">
	<div class="alert alert-warning <?php echo $VE_gone; ?>" id="error_frm" >
		<h4>Warning!</h4> <?php echo $openFTR;?> <br>
		<?php echo validation_errors(); ?>
	</div>
	
	<div class="alert alert-success <?php echo $class_dml; ?>" id="Was_TR">
		<button type="button" class="close" >&times;</button>
		<strong><?php echo substr($msg_sess_dml,0,8);?></strong> <?php echo substr($msg_sess_dml,8);?>
	</div>
	
	<div class="alert alert-success gone" id="tryyy">
		<input type="hidden" name="VN_YTR" id="VN_YTR"> 
		<button type="button" class="close viewed_notif" >&times;</button>
		<div id="TR_data">
			
		</div>
	</div>
	
	<div class="alert alert-success gone" id="NHR">
		<input type="hidden" name="VN_YHR" id="VN_YHR"> 
		<button type="button" class="close viewed_notif" >&times;</button>
		<div id="NHR_D">
		
		</div>
	</div>
	
	<?php
	/* for admin
	<div class="FE_98 gone" id="NNR">
		<div class="alert alert-block tengah">
			<strong>Hey , we have <a href="<?php echo site_url().'sd_home/c_sd_home/SDH_index/WR'; ?>"><span class="btn btn-danger BTN_WR_SDH" id="NNR_COUNT"></span></a> New Requested</strong>
		</div>
	</div>
	*/
	?>
</div>

<!-- Data OP -->
<div class="FE_95 FE_border FE_form FE_datatable" id="DATA_OP_SDH" style="margin-top:10px;">
	<div class="FE_100 FE_datatable">
		<div class="FE_100 FE_datatable">
			<h4>Done Request</h4>
		</div>
		<table style="font-size:11px;" class="datatable">
			<thead>
				<tr>
					<th>No</th>
					<th>Request ID#</th>
					<th>Request Based</th>
					<th>Request Type</th>
					<th>Request Case</th>
					<th>Request Modul</th>
					<th>Request Desc</th>
					<th>Request Reason</th>
					<th>Request Status</th>
					<th>Request Created</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$N = 1;
			foreach ($DR_DATA as $DR)
			{
				$REQID_WT_SLASH = str_replace('/','_',$DR->request_id);
				$REQID_WT_DASH = str_replace('-','_',$REQID_WT_SLASH);
				?>
				<script type="text/javascript">
					var DR_<?php echo $N; ?> = "<?php echo $DR->request_id; ?>";
				</script>
				<tr>
					<th><?PHP echo$N; ?></th>
						<input type="hidden" id="DATA_WR_UR_<?php echo $N; ?>" value="<?php echo$DR->request_id; ?>">
					<td><?PHP echo$DR->request_id; ?></td>
					<td><?PHP echo$DR->request_based; ?></td>
					<td><?PHP echo$DR->request_type; ?></td>
					<td><?PHP echo$DR->request_case; ?></td>
					<td><?PHP echo$DR->request_modul; ?></td>
					<td><?PHP echo$DR->request_desc; ?></td>
					<td><?PHP echo$DR->request_statusReason; ?></td>
					<td><?PHP echo$DR->request_status; ?></td>
					<td><?PHP echo $DR->request_dateCreated ; ?></td>
					<th><i class="icon-list ttip" id="BTN_ACT_GR_<?php echo $REQID_WT_DASH; ?>" onClick="openMdl(DR_<?php echo $N; ?>)" data-toggle="tooltip" data-placement="top" title="Detail & Action">i</i> <a href="<?php echo $rep1.$rep2.$DR->request_id ?>" target="_blank"><i class="icon-print ttip" data-toggle="tooltip" data-placement="top" title="Print"></i></a></th>
				</tr>
				<?php
				$N++;
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<!-- End Data OP -->

<div id="Modal_FTR" class="modal hide fade">
	<form method="POST" action="<?php echo site_url().'sd_home/c_sd_home/SDH_TR';?>">
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
			<tr class="gone">
				<td>Status Reason</td>
				<td><span id="D_REQStatusReason"></span></td>
			</tr>
			<tr>
				<td>Status Created Date</td>
				<td><span id="D_REQStatusDate"></span></td>
			</tr>
		</table>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Close</a>
	</div>
</div>

<?php
/*
<div id="Modal_FTR" class="modal hide fade">
	<form method="POST" action="<?php echo site_url().'sd_home/c_sd_home/SDH_TR';?>">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<span style="font-size:21px">Detail Request</span>
	</div>
	<div class="modal-body">
		<div class="alert alert-block <?php echo$class_E_modal;?>">
			<h4>Warning!</h4>
			<?php echo$VE;?>
		</div>
		<table class="FE_modal">
			<?php
			/*
			<tr>
				<td>Status</td>
				<td>
					<select name="status" id="status">
						<option value="">Choose</option>
						<option value="Cancel" <?php echo $choose_cancel; ?>>Cancel</option>
						<option value="Done">Done</option>
					</select>
				</td>
			</tr>
			<tr class="<?php echo $show_EST_time; ?>" id="SET">
				<td>Set Estimate Time</td>
				<td><input type="text" class="form datetimepicker" id="FTR_REQ_EST" name="FTR_REQ_EST"></td>
			</tr>
			<tr class="<?php echo $show_hold_reason; ?>" id="STAT_REASON">
				<td>Reason</td>
				<td><input type="text" class="form" id="FTR_REQ_Reason" name="FTR_REQ_Reason"></td>
			</tr>
			<tr class="gone" id="SET_DONE">
				<td>Set Estimate Time</td>
				<td><input type="text" class="form datetimepicker" id="FTR_REQ_EST_DONE" name="FTR_REQ_EST_DONE"></td>
			</tr>
				<input type="hidden" name="UH" value="Y">
				<input type="hidden" name="FTR_REQID" id="FTR_REQID">
				<input type="hidden" name="addr_from" value="hold">
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			*/
			?>
			<?php
			/*
			<tr class="FE_modal_even">
				<td>Request ID#</td>
				<td><span id="FTR_REQ_ID"></span></td>
			</tr>
			<tr>
				<td>Request Based</td>
				<td><span id="FTR_REQ_Based"></span></td>
			</tr>
			<tr class="FE_modal_even">
				<td>Request Type</td>
				<td><span id="FTR_REQ_Type"></span></td>
			</tr>
			<tr>
				<td>Request Case</td>
				<td><span id="FTR_REQ_Case"></span></td>
			</tr>
			<tr class="FE_modal_even">
				<td>Request Modul</td>
				<td><span id="FTR_REQ_Modul"></span></td>
			</tr>
			<tr>
				<td>Request Desc</td>
				<td><span id="FTR_REQ_Desc"></span></td>
			</tr>
			<tr class="FE_modal_even">
				<td>PIC Dev</td>
				<td><span id="FTR_PIC_Username"></span> As <span id="FTR_PIC_Fullname"></span></td>
			</tr>
			<tr>
				<td>PIC Phone Personal</td>
				<td><span id="FTR_REQ_PICPP"></span></td>
			</tr>
			<tr class="FE_modal_even">
				<td>PIC Phone Office</td>
				<td><span id="FTR_REQ_PICPO"></span></td>
			</tr>
			<tr>
				<td>Request Created</td>
				<td><span id="FTR_REQ_Created"></span></td>
			</tr>
			<tr class="FE_modal_even">
				<td>Request Status</td>
				<td><span id="FTR_REQ_Status"></span></td>
			</tr>
			<tr>
				<td>Request Reason</td>
				<td><span id="FTR_REQReason"></span></td>
			</tr>
		</table>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Close</a>
	</div>
</div>
*/
?>