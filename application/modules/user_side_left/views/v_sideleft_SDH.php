<?php
/** View sideleft SDH
 * created by yansen April 2013
 * SDH = Staff dev Home WR = waiting respond , SR = status request
 *
 *
 *
 */

foreach ($SR_WR as $d_SR_WR)
{$WR = $d_SR_WR->new_req;}
foreach ($SR_OP as $D_SR_OP)
{$OP = $D_SR_OP->COUNT_OP;}
foreach ($SR_AR as $D_SR_AR)
{$AR = $D_SR_AR->jml_AR;}
foreach ($SR_HR as $D_SR_HR)
{$HR = $D_SR_HR->HR;}
foreach ($SR_CR as $D_SR_CR)
{$CR = $D_SR_CR->CR;}
foreach ($SR_WD as $D_SR_WD)
{$WD = $D_SR_WD->WD;}
foreach ($SR_RR as $D_SR_RR)
{$RR = $D_SR_RR->RR;}
foreach ($SR_DR as $D_SR_DR)
{$DR = $D_SR_DR->DR;}

$sl_active = $this->session->userdata('SL_Active');
if (!empty($sl_active))
{
	if ($sl_active=="OP")
	{
		$active_OP=" class='FE_SL_hover' ";
		$active_WR="";
		$active_AR ="";
		$active_HR ="";
		$active_CR ="";
		$active_WD ="";
		$active_RR ="";
		$active_DR ="";
		$active_PM = "";
		$active_link_PM = "";
		$active_message="";
		$active_request="in";
	}
	else if ($sl_active=="WR")
	{
		$active_OP="";
		$active_WR=" class='FE_SL_hover' ";
		$active_AR ="";
		$active_HR ="";
		$active_CR ="";
		$active_WD ="";
		$active_RR ="";
		$active_DR ="";
		$active_PM = "";
		$active_link_PM = "";
		$active_message="";
		$active_request="in";
	}
	else if ($sl_active=="AR")
	{
		$active_OP="";
		$active_WR="";
		$active_AR = "class='FE_SL_hover'";
		$active_HR ="";
		$active_CR ="";
		$active_WD ="";
		$active_RR ="";
		$active_DR ="";
		$active_PM = "";
		$active_link_PM = "";
		$active_message="";
		$active_request="in";
	}
	else if ($sl_active=="HR")
	{
		$active_OP="";
		$active_WR="";
		$active_AR ="";
		$active_HR =" class='FE_SL_hover' ";
		$active_CR ="";
		$active_WD ="";
		$active_RR ="";
		$active_DR ="";
		$active_PM = "";
		$active_link_PM = "";
		$active_message="";
		$active_request="in";
	}
	else if ($sl_active=="CR")
	{
		$active_OP="";
		$active_WR="";
		$active_AR ="";
		$active_HR ="";
		$active_CR =" class='FE_SL_hover' ";
		$active_WD ="";
		$active_RR ="";
		$active_DR ="";
		$active_PM = "";
		$active_link_PM = "";
		$active_message="";
		$active_request="in";
	}
	else if ($sl_active=="WD")
	{
		$active_OP="";
		$active_WR="";
		$active_AR ="";
		$active_HR ="";
		$active_CR ="";
		$active_WD =" class='FE_SL_hover' ";
		$active_RR ="";
		$active_DR ="";
		$active_PM = "";
		$active_link_PM = "";
		$active_message="";
		$active_request="in";
	}
	else if ($sl_active=="RR")
	{
		$active_OP="";
		$active_WR="";
		$active_AR ="";
		$active_HR ="";
		$active_CR ="";
		$active_WD ="";
		$active_RR ="class='FE_SL_hover'";
		$active_DR ="";
		$active_PM = "";
		$active_link_PM = "";
		$active_message="";
		$active_request="in";
	}
	else if ($sl_active=="DR")
	{
		$active_OP="";
		$active_WR="";
		$active_AR ="";
		$active_HR ="";
		$active_CR ="";
		$active_WD ="";
		$active_RR ="";
		$active_DR ="class='FE_SL_hover'";
		$active_PM = "";
		$active_link_PM = "";
		$active_message="";
		$active_request="in";
	}
	else if ($sl_active=="PM")
	{
		$active_OP="";
		$active_WR="";
		$active_AR ="";
		$active_HR ="";
		$active_CR ="";
		$active_WD ="";
		$active_RR ="";
		$active_DR ="";
		$active_PM = "btn-primary";
		$active_link_PM = "text-white";
		$active_message="";
		$active_request="";
	}
}
else if ($NR=="Y")
{
	$active_OP="";
	$active_WR="";
	$active_HR ="";
	$active_AR="";
	$active_CR ="";
	$active_WD ="";
	$active_RR ="";
	$active_PM = "";
	$active_link_PM = "";
	$active_message="";
	$active_request="";
}
else
{
	$active_OP="";
	$active_WR="";
	$active_HR ="";
	$active_AR="";
	$active_CR ="";
	$active_WD ="";
	$active_RR ="";
	$active_DR ="";
	$active_PM = "";
	$active_link_PM = "";
	$active_message="";
	$active_request="in";
}
?>
<script type="text/javascript">					
$(document).ready(function(){
	$("a").tooltip();
});
</script>
					<div class="well_y sidebar-nav">
			
						<div class="accordion" id="accordion2">
							
							<div class="accordion-group <?php echo $active_PM; ?>">
								<div class="accordion-heading">
									<a class="accordion-toggle nav-header <?php echo $active_link_PM; ?>" href="<?php echo site_url().'personal_message/c_personal_message/conversation'; ?>">
										Personal Message
									</a>
								</div>
								<?php
								/*
								<div id="collapseOne" class="accordion-body collapse <?php echo $active_message; ?>">
									<div class="accordion-inner">
										<ul class="nav nav-list ">
											<li><a href="#">New Conversation</a></li>
											<li class="hide"><a href="#"><span class="btn btn_notif btn-danger">0</span> Unread Message</a></li>
											<li><a href="#">View All Conversation</a></li>
										</ul>
									</div>
								</div>
								*/?>
							</div> 
							
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle nav-header" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Your Requested</a>
								</div>
								<div id="collapseTwo" class="accordion-body collapse <?php echo $active_request; ?>">
									<div class="accordion-inner">
										<ul class="nav nav-list">
											<li><a href="<?php echo site_url().'sdh_ar/c_AR'; ?>" <?php echo $active_AR; ?>><span class="btn btn_notif btn-danger BTN_AR_SDH" id="SL_CAR"><?php echo $AR; ?></span> All Request</a></li>
											<li><a href="<?php echo site_url().'sd_home/c_sd_home/SDH_index/WR'; ?>" <?php echo $active_WR; ?>><span class="btn btn_notif btn-danger BTN_WR_SDH" id="SL_CWR"><?php echo $WR; ?></span> Waiting Respond</a></li>
											<li><a href="<?php echo site_url().'sdh_op/c_sdh_op/SDHOP_Index'; ?>" <?php echo $active_OP; ?>><span class="btn btn_notif btn-danger BTN_OP_SDH" id="SL_OP"><?php echo $OP;?></span> On Process </a></li>
											<li><a href="<?php echo site_url().'sdh_hr/c_HR';?>" <?php echo $active_HR; ?>><span class="btn btn_notif btn-danger" id="SL_HR"><?php echo $HR; ?></span> Hold </a></li>
											<li><a href="<?php echo site_url().'sdh_wd/c_WD'; ?>" <?php echo $active_WD; ?> data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Request that waiting confirmation DONE from user"><span class="btn btn_notif btn-danger" id="SL_WD"><?php echo $WD; ?></span> Wating Done Confirmation</a></li>
											<li><a href="<?php echo site_url().'sdh_rr/c_RR/';?>" <?php echo $active_RR; ?>><span class="btn btn_notif btn-danger" id="SL_RR"><?php echo $RR; ?></span> Revision </a></li>
											<li><a href="<?php echo site_url().'sdh_dr/c_DR/'; ?>" <?php echo $active_DR; ?>><span class="btn btn_notif btn-danger" id="SL_DR"><?php echo $DR; ?></span> Done </a></li>
											<li><a href="<?php echo site_url().'sdh_cr/c_CR'; ?>" <?php echo $active_CR; ?>><span class="btn btn_notif btn-danger" id="SL_CR"><?php echo $CR; ?></span> Cancel</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						
					</div>