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
 $class_E_modal = "gone";
}
?>
<script type="text/javascript" src="<?php echo base_url().'js/SD/js_sd_home.js';?>"></script>
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

var url_CCR = "<?php echo site_url().'sd_home/c_sd_home/SDH_CR';?>";
var url_CDR = "<?php echo site_url().'sd_home/c_sd_home/SDH_DR';?>";
var url_CRR = "<?php echo site_url().'sd_home/c_sd_home/SDH_RR';?>";
var url_CWD = "<?php echo site_url().'sd_home/c_sd_home/SDH_WD';?>";
var url_CNR = "<?php echo site_url().'sd_home/c_sd_home/SDH_NR';?>";
var url_CWR = "<?php echo site_url().'sd_home/c_sd_home/SDH_WR';?>";
var url_FTR = "<?php echo site_url().'sd_home/c_sd_home/SDH_FTR';?>";
var url_CTR = "<?php echo site_url().'sd_home/c_sd_home/SDH_CTR';?>";
var url_CHR = "<?php echo site_url().'sd_home/c_sd_home/SDH_CHR';?>";
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
	
	<div class="FE_98 gone" id="NNR">
		<div class="alert alert-block tengah">
			<strong>Hey , we have <a href="<?php echo site_url().'sd_home/c_sd_home/SDH_index/WR'; ?>"><span class="btn btn-danger BTN_WR_SDH" id="NNR_COUNT"></span></a> New Requested</strong>
		</div>
	</div>
</div>

<!--  Data WR -->
<div class="FE_95 FE_border FE_form FE_datatable DATA_WR_SDH" id="DATA_WR_SDH" style="margin-top:10px;">
	<div class="FE_100 FE_datatable">
		<div class="FE_100 FE_datatable">
			<h4>Data - Waiting Respond Requested</h4>
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
			$NO_WR_UR = 1;
			foreach ($DATA_WR_SDH as $DWR_SDH)
			{
				$REQ_ID_RPL = str_replace('/','_',$DWR_SDH->request_id);
				$REQ_ID_RPLC = str_replace('-','_',$REQ_ID_RPL);
				?>
				<script type="text/javascript">
					var GR_<?php echo $NO_WR_UR; ?> = "<?php echo $DWR_SDH->request_id; ?>";
				</script>
				<tr>
					<th><?PHP echo$NO_WR_UR; ?></th>
						<input type="hidden" id="DATA_WR_UR_<?php echo $NO_WR_UR; ?>" value="<?php echo$DWR_SDH->request_id; ?>">
					<td><?PHP echo$DWR_SDH->request_id; ?></td>
					<td><?PHP echo$DWR_SDH->request_based; ?></td>
					<td><?PHP echo$DWR_SDH->request_type; ?></td>
					<td><?PHP echo$DWR_SDH->request_case; ?></td>
					<td><?PHP echo$DWR_SDH->request_modul; ?></td>
					<td><?PHP echo$DWR_SDH->request_desc; ?></td>
					<td><?PHP echo$DWR_SDH->request_reason; ?></td>
					<td><?PHP echo$DWR_SDH->request_status; ?></td>
					<td><?PHP echo $DWR_SDH->request_dateCreated ; ?></td>
					<th><i class="icon-list ttip" id="BTN_ACT_GR_<?php echo$REQ_ID_RPLC; ?>" onClick="openTR(GR_<?php echo $NO_WR_UR; ?>)" data-toggle="tooltip" data-placement="top" title="Detail & Action"></i></th>
				</tr>
				<?php
				$NO_WR_UR++;
			}
			?>
			</tbody>
		</table>
	</div>
</div>

<div id="Modal_FTR" class="modal hide fade">
	<form method="POST" action="<?php echo site_url().'sd_home/c_sd_home/SDH_TR';?>">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<span style="font-size:21px">Take Request</span>
	</div>
	<div class="modal-body">
		<div class="alert alert-block <?php echo$class_E_modal;?>">
			<h4>Warning!</h4>
			<?php echo$VE;?>
		</div>
		<table class="FE_modal">
			<tr>
				<td>Status</td>
				<td>
					<select name="status" id="status">
						<option value="">Choose</option>
						<option value="On Process">On Process</option>
						<option value="Hold">Hold</option>
					</select>
				</td>
			</tr>
			<tr class="gone" id="SET">
				<td>Set Estimate Time</td>
				<td><input type="text" class="form datetimepicker" id="FTR_REQ_EST" name="FTR_REQ_EST"></td>
			</tr>
			<tr class="gone" id="STAT_REASON">
				<td>Reason</td>
				<td><input type="text" class="form" id="FTR_REQ_Reason" name="FTR_REQ_Reason"></td>
			</tr>
			<tr class="gone" id="SET_DONE">
				<td>Set Estimate Time</td>
				<td><input type="text" class="form datetimepicker" id="FTR_REQ_EST_DONE" name="FTR_REQ_EST_DONE"></td>
			</tr>
				<input type="hidden" name="FTR_REQID" id="FTR_REQID">
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
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
				<td>Request Reason</td>
				<td><span id="FTR_REQReason"></span></td>
			</tr>
			<tr>
				<td>Request Username</td>
				<td><span id="FTR_REQ_Username"></span></td>
			</tr>
			<tr class="FE_modal_even">
				<td>Request User Phone Personal</td>
				<td><span id="FTR_REQ_UserPP"></span></td>
			</tr>
			<tr>
				<td>Request User Phone Office</td>
				<td><span id="FTR_REQ_UserPO"></span></td>
			</tr>
			<tr class="FE_modal_even">
				<td>Request Created</td>
				<td><span id="FTR_REQ_Created"></span></td>
			</tr>
			<tr>
				<td>Request Status</td>
				<td><span id="FTR_REQ_Status"></span></td>
			</tr>
			<tr class="FE_modal_even">
				<td>Status Reason</td>
				<td><span id="FTR_REQ_StatusReason"></span></td>
			</tr>
			<tr>
				<td>Status Created</td>
				<td><span id="FTR_REQ_StatusCreated"></span></td>
			</tr>
		</table>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Cancel</a>
		<input type="submit" class="btn btn-success FE_btn_take" value="SET IT!">
	</div>
</div>