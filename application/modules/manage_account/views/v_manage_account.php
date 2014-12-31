<?PHP 
$type_alert = $this->session->flashdata('type_alert')=="" ? "" : $this->session->flashdata('type_alert');
$visible_alert = $this->session->flashdata('type_alert')=="" ? "gone" : "";
$message_alert = $this->session->flashdata('message_alert');

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
<script type="text/javascript" src="<?php echo base_url().'js/SD/js_sd_home.js';?>"></script>
<script type="text/javascript" src="<?php echo base_url().'js/attribute.js';?>"></script>
<script type="text/javascript">
var img_url = "<?php echo base_url().'images/ext/'?>";
var file_url = "<?php echo base_url().'uploads/'?>";
var url_CCR = "<?php echo site_url().'sd_home/c_sd_home/SDH_CR';?>";
var url_CDR = "<?php echo site_url().'sd_home/c_sd_home/SDH_DR';?>";
var url_CRR = "<?php echo site_url().'sd_home/c_sd_home/SDH_RR';?>";
var url_CWD = "<?php echo site_url().'sd_home/c_sd_home/SDH_WD';?>";
var url_CNR = "<?php echo site_url().'sd_home/c_sd_home/SDH_NR';?>";
var url_CWR = "<?php echo site_url().'sd_home/c_sd_home/SDH_WR';?>";
var url_CTR = "<?php echo site_url().'sd_home/c_sd_home/SDH_CTR';?>";
var url_CHR = "<?php echo site_url().'sd_home/c_sd_home/SDH_CHR';?>";
var url_DAR = "<?php echo site_url().'status_request/c_sr/AR_detail';?>";
var url_VN = "<?php echo site_url().'status_request/c_sr/SR_VN';?>";
var id_user = "<?php echo $this->session->userdata('login_id');?>";
</script>

<div class="FE_95 FE_form" id="FAD_UR" style="margin-top:10px;">
	<div class="alert alert-warning <?php echo $VE_gone; ?>" id="error_frm" >
		<h4>Warning!</h4>
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
	
	<div class="alert <?php echo $type_alert." ".$visible_alert;  ?>">
		<?php echo $message_alert; ?>
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

<div class="FE_95 FE_border FE_form" id="DATA_OP_SDH">
	<div class="FE_100 FE_datatable">
		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#change_password">Change Password</a></li>
			<?php // <li><a href="#courier_data">Data Courier</a></li> ?>
		</ul>
 
		<div class="tab-content" style="margin-top: -20; background: white;padding: 10;">
			<div class="tab-pane active" id="change_password">
				<form method="POST" action="<?php echo site_url().'manage_account/c_manage_account/change_password'; ?>">
				<table class="table-hover" width="100%">
					<tr>
						<td width="25%">Current Password</td>
						<td><input type="password" name="old_pass" class="span3" style="margin-bottom:0px;"></td>
					</tr>
					<tr>
						<td>New Password</td>
						<td><input type="password" name="new_pass" class="span5" style="margin-bottom:0px;"></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td><input type="password" name="conf_pass" class="span5" style="margin-bottom:0px;"></td>
					</tr>
					<tr>
						<td colspan=2 align="center" style="padding-top:10;">
							<input type="submit" value="Submit" class="btn btn-primary">
						</td>
					</tr>
				</table>
				</form>
			</div>
			<?php
			/*
			<div class="tab-pane" id="courier_data">
				<form method="POST" action="#">
				<table class="table-hover" width="100%">
					<tr>
						<td width="25%">Label Input</td>
						<td><input type="text" class="span3" style="margin-bottom:0px;"> <button class="btn btn-primary">Find</button></td>
					</tr>
					<tr>
						<td>Label Input</td>
						<td><input type="text" class="span5" style="margin-bottom:0px;" disabled="disabled"></td>
					</tr>
					<tr>
						<td>Label Input</td>
						<td><input type="text" class="span5" style="margin-bottom:0px;" disabled="disabled"></td>
					</tr>
					<tr>
						<td>Label Input</td>
						<td><input type="text" class="span5" style="margin-bottom:0px;" disabled="disabled"></td>
					</tr>
				</table>
				</form>
			</div>
			*/
			?>
		</div>
	</div>
</div>
<!-- End Data OP -->