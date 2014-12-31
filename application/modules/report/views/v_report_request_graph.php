<?php
$sess_msg_status_dml_dept = $this->session->flashdata('msg_status_dml_dept');
$sess_status_dml_dept = $this->session->flashdata('status_dml_dept');
$validation_error = validation_errors();
$hide_html = $generate_report_request!="Y" ? "hide" : "";
$show_new = $generate_report_request!="Y" ? "" : "hide";
$show_recent = $generate_report_request!="Y" ? "hide" : "";
?>

<!-- JS Modules -->	
<script type="text/javascript" src="<?php echo base_url().'js/administrator/js_report.js';?>"></script>
<script type="text/javascript" src="<?php echo base_url().'js/jquery.mtz.monthpicker.js';?>"></script>
<script src="<?php echo base_url().'graph/vendors/modernizr-2.6.2-respond-1.1.0.min.js'; ?>"></script>
<script>
	$(document).ready(function(){
		$(".monthpicker").monthpicker({"pattern" : "yyyy-mm","startYear" : 2012, "finalYear" : 2013, "selectedYear" : 2013});
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
	<div class="span12 <?php echo $show_new; ?> " id="div_new_generate">
		<div class="span6">
			<fieldset>
				<legend>Generate Report Request in Graphic <span class="pull-right"><input type="button" id="recent_generate" class="btn <?php echo $hide_html; ?>" value="Recent Generate"></span></legend>
				<form method="POST" action="<?PHP echo site_url().'report/c_report_request/generate_report_graphic';?>">
				<table style="width:100%" class="table-hover">
					<tr>
						<td>Date Period</td>
						<td><input type="text" name="date_from" placeholder="from" class="monthpicker form" required="">-<input type="text" name="date_thru" placeholder="thru" class="monthpicker form" required=""></td>
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
	
	
	
	
	<!-- Form -->
	
	<!-- Data -->
	<?php
	if ($generate_report_request=="Y")
	{
	?>
	
	<div class="container-fluid <?php echo $show_recent; ?>" id="div_recent_generate">
		<div class="row-fluid">
			<div class="span12" id="content">
				<div class="row-fluid section">
					 <!-- block -->
					<div class="block">
						<div class="navbar navbar-inner block-header">
							<div class="muted pull-left">Graphic Request Period <?php echo set_value("date_from")." - ".set_value("date_thru"); ?></div>
							<div class="pull-right">
								<input type="button" id="new_generate" class="btn btn-success" style="margin:0px;" value="New Generate">
							</div>
						</div>
						<div class="block-content collapse in">
							<div class="span12">
								<div id="hero-graph" style="height: 230px;"></div>
							</div>
						</div>
					</div>
					<!-- /block -->
				</div>
			</div>
		</div>
	</div>
	
	<?php
	}
	?>
	<!-- End Data -->
	<link rel="stylesheet" href="<?php echo base_url().'graph/vendors/morris/morris.css';?>">
	<script src="<?php echo base_url().'graph/vendors/jquery.knob.js';?>"></script>
	<script src="<?php echo base_url().'graph/vendors/raphael-min.js';?>"></script>
	<script src="<?php echo base_url().'graph/vendors/morris/morris.min.js';?>"></script>
	<script src="<?php echo base_url().'graph/vendors/flot/jquery.flot.js';?>"></script>
	<script src="<?php echo base_url().'graph/vendors/flot/jquery.flot.categories.js';?>"></script>
	<script src="<?php echo base_url().'graph/vendors/flot/jquery.flot.pie.js';?>"></script>
	<script src="<?php echo base_url().'graph/vendors/flot/jquery.flot.time.js';?>"></script>
	<script src="<?php echo base_url().'graph/vendors/flot/jquery.flot.stack.js';?>"></script>
	<script src="<?php echo base_url().'graph/vendors/flot/jquery.flot.resize.js';?>"></script>
	<script src="<?php echo base_url().'graph/assets/scripts.js';?>"></script>
	<script>
		// Morris Line Chart
		var tax_data = [
		<?php
		foreach ($report as $r)
		{
			echo"
				{'period': '".date('Y-m',strtotime($r->THN_BLN))."', 'Done': ".$r->JML_DONE.", 'Cancel': ".$r->JML_CANCEL.", 'WCD': ".$r->JML_WCD."},
			";
		}
		?>
		];
		Morris.Line({
			element: 'hero-graph',
			data: tax_data,
			xkey: 'period',
			xLabels: "month",
			ykeys: ['Done', 'Cancel', 'WCD'],
			labels: ['Done', 'Cancel', 'WCD'],
			lineColors: ["#81d5d9", "#a6e182", "#0b62a4"]
		});
		
	</script>