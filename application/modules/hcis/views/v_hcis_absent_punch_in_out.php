<div class="row">
	<div class="col-lg-6 con-datatables" style="padding-bottom: 10px;">
		<button class="btn btn-lg btn-success col-lg-12" type="button" style="font-size: 40px; width:100%;" onClick="absent_punch_in(this.value)" value="<?php echo $p_nik; ?>" <?php echo $enabled_punch_in; ?>>
			<i class="fa fa-sign-in"></i> Punch In
		</button>
	</div>
	<div class="col-lg-6 con-datatables" style="padding-bottom: 10px;">
		<button class="btn btn-lg btn-danger col-lg-12" type="button" style="font-size: 40px; width:100%;" onClick="absent_punch_out(this.value)" value="<?php echo $p_nik; ?>" <?php echo $enabled_punch_out; ?>>
			<i class="fa fa-sign-out"></i> Punch Out
		</button>
	</div>
</div>

<div class="row text-center" id="pi_late" style="display:none">
	<form method="POST" action="<?php echo site_url().'hcis/c_hcis_absent_punch_in_out/punch_in_late'; ?>">
		<div class="col-lg-12 con-datatables">
			<div class="form-group">
				<label>Alasan Datang Terlambat</label>
				<textarea name="pi_late_reason" id="pi_late_reason" class="form-control animated" rows=2 required></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-lg-12 text-center">
					<button type="submit" class="btn btn-primary" id="btn_submit_form">Submit</button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="row text-center" id="po_early" style="display:none">
	<form method="POST" action="<?php echo site_url().'hcis/c_hcis_absent_punch_in_out/punch_out_early'; ?>">
		<div class="col-sm-12 con-datatables" style="padding-bottom: 10px;">
			<div class="form-group">
				<label>Alasan Pulang Lebih Awal</label>
				<textarea name="po_early_reason" id="po_early_reason" class="form-control animated" rows=2 required></textarea>
			</div>
		</div>
	
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 text-center" style="padding:0">
					<button type="submit" class="btn btn-primary" id="btn_submit_form">Submit</button>
				</div>
			</div>
		</div>
	</form>
</div>

<?php
foreach ($data_absen_today as $d)
{
	switch ($d['po_early_approve_up_level'])
	{
		case 1:
		$status_po_early_approval = "Approved";
		$style_hide_reason = "display:none";
		$class_alert = "success";
		break;
		
		case 2:
		$status_po_early_approval = "Rejected";
		$style_hide_reason = "";
		$class_alert = "danger";
		break;
		
		case 3:
		$status_po_early_approval = "Waiting Approval";
		$style_hide_reason = "display:none";
		$class_alert = "info";
		break;
		
		default:
		$status_po_early_approval = "";
		$style_hide_reason = "display:none";
		$class_alert = "info";
		break;
	}
	
	switch ($d['po_early_approve_hrd'])
	{
		case 1:
		$status_po_early_approval_hrd = "Approved";
		$style_hide_reason_hrd = "display:none";
		$class_alert_hrd = "success";
		break;
		
		case 2:
		$status_po_early_approval_hrd = "Rejected";
		$style_hide_reason_hrd = "";
		$class_alert_hrd = "danger";
		break;
		
		case 3:
		$status_po_early_approval_hrd = "Waiting Approval";
		$style_hide_reason_hrd = "display:none";
		$class_alert_hrd = "info";
		break;
		
		default:
		$status_po_early_approval_hrd = $d['po_early_approve_up_level']==3 ? "Waiting Response From Up Level" : "" ;
		$style_hide_reason_hrd = "display:none";
		$class_alert_hrd = "info";
		break;
	}
	
	$text_title = $cek_hari_ini_cuti==0 ? "Data Absen Hari Ini" : "Hari Ini Anda Cuti";
	$text_title_show = $cek_hari_ini_cuti==0 ? "display:none;" : "Hari Ini Anda Cuti";
?>
	<div class="row bg-white" style="margin-top:3%;">
		<div class="col-lg-12 text-center" style="margin-top:1%;<?php echo $text_title_show; ?>">
			<b style="font-size:20px;"><u><?php echo $text_title; ?></u></b>
		</div>
		<?php 
		if ($cek_hari_ini_cuti==0)
		{
		?>
			<div class="col-lg-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-info"></i><span class="panel_break"></span> Punch In Information</h3>
					</div>
					<div class="panel-body">
						<table class="table table-hover table-striped table-bordered font-12">
							<tbody>
								<tr>
									<th class="col-md-4">Punch In Time</th>
									<td><b><?php echo $d['absen_punch_in_time']=="" ? "&nbsp;" : $d['absen_punch_in_time']; ?></b></td>
								</tr>
								<tr>
									<th>Reason</th>
									<td><?php echo $d['pi_late_flag']=="99" || $d['pi_late_flag']=="" ? "&nbsp;" : $d['pi_late_reason']; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		
			<div class="col-lg-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-info"></i><span class="panel_break"></span> Punch Out Information</h3>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-hover table-bordered font-12 col-sm-6">
							<tr>
								<th class="col-md-4">Punch Out Time</th>
								<td><b><?php echo $d['absen_punch_out_time']=="" ? "&nbsp;" : $d['absen_punch_out_time']; ?></b></td>
							</tr>
						</table>
						
						<table class="table table-striped table-hover table-bordered font-12 col-sm-6">
							<tr>
								<th class="col-md-4">Early Punch Out Time</th>
								<td><b><?php echo $d['po_early_time']=="" ? "&nbsp;" : $d['po_early_time']; ?></b></td>
							</tr>
							<tr>
								<th>Reason</th>
								<td><?php echo $d['po_early_flag']=="99" || $d['po_early_flag']=="" ? "&nbsp;" : $d['po_early_reason']; ?></td>
							</tr>
						</table>	
					</div>
				</div>
			</div>
						
			<?php
			if ($d['po_early_flag']==1 || $d['po_early_flag']==2)
			{
				?>
				<div class="col-sm-12 con-datatables">
					<fieldset>
						<legend>Early Punch Out Approval Information</legend>	
							<div class="row">						
								<div class="col-md-6">
									<div class="alert alert-<?php echo $class_alert; ?> title_inside_alert">Approval Up Level</div>
									<table class="table table-striped table-hover table-bordered font-12">
										<tr>
											<th class="col-md-3">Status</th>
											<td class=""><?php echo $status_po_early_approval; ?></td>
										</tr>
										<tr>
											<th class="col-md-3">Status By</th>
											<td class=""><?php echo $d['nama_atasan_approve']; ?></td>
										</tr>
										<tr>
											<th class="col-md-3">Status Date</th>
											<td class=""><?php echo $d['approve_up_level_date']; ?></td>
										</tr>
										<tr style="<?php echo $style_hide_reason; ?>">
											<th class="col-md-3">Status Reason</th>
											<td class=""><?php echo $d['reject_up_level_reason']; ?></td>
										</tr>
									</table>
								</div>
								
								<div class="col-md-6">
									<div class="alert alert-<?php echo $class_alert_hrd; ?> title_inside_alert">Approval HRD</div>
									<table class="table table-striped table-hover table-bordered font-12">
										<tr>
											<th class="col-md-3">Status</th>
											<td class=""><?php echo $status_po_early_approval_hrd; ?></td>
										</tr>
										<tr>
											<th class="col-md-3">Status By</th>
											<td class=""><?php echo $d['nama_hrd_approve']; ?></td>
										</tr>
										<tr>
											<th class="col-md-3">Status Date</th>
											<td class=""><?php echo $d['approve_hrd_date']; ?></td>
										</tr>
										<tr style="<?php echo $style_hide_reason_hrd; ?>">
											<th class="col-md-3">Status Reason</th>
											<td class=""><?php echo $d['reject_hrd_reason']; ?></td>
										</tr>
									</table>
								</div>
							</div>
					</fieldset>
				</div>
				<?php
			}
		}
}
?>

<script type="text/javascript">
	var url_punch_in = "<?php echo site_url().'hcis/c_hcis_absent_punch_in_out/punch_in'; ?>";
	var url_punch_out = "<?php echo site_url().'hcis/c_hcis_absent_punch_in_out/punch_out'; ?>";
</script>