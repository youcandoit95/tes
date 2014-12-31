<?php
$run = 99;
?>
	<div class="row">
		<div class="col-lg-3">
			<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-info-circle"></i><span class="panel_break"></span> Informasi Sisa Cuti</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover text-center font-12">
					<thead>
						<tr>
							<th style="text-align:center">Periode Cuti</th>
							<th style="text-align:center">Sisa Cuti</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total_sisa_cuti = 0;
						if (empty($info_sisa_cuti))
						{
							?>
							<tr>
								<td colspan=2 style="text-align:center"><b>Maaf , anda tidak memiliki hak cuti</b></td>
							</tr>
							<?php
						}
						else
						{
							foreach ($info_sisa_cuti as $d)
							{
								$run = 1;
								?>
								<tr>
									<td><?php echo $d['mcuti_period_year']; ?></td>
									<td><?php echo $d['mcuti_available']; ?> Hari</td>
								</tr>
								<?php
								$total_sisa_cuti = intval($total_sisa_cuti) + $d['mcuti_available'];
							}
						}
						?>
					</tbody>
					<?php
					if ($run==1)
					{
					?>
					<tfoot>
						<tr>
							<th style="text-align:right">Total</th>
							<th style="text-align:center">	<?php echo $total_sisa_cuti; ?> Hari</th>
						</tr>
					</tfoot>
					<?php
					}
					?>
				</table>
				</div>
			</div>
			</div>
		</div>
		
		<?php
		if ($run==1)
		{
			?>	
			<div class="col-lg-8 col-lg-offset-1">
				<div class="row">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-pencil-square-o"></i><span class="panel_break"></span> Form Pengajuan Cuti</h3>
						</div>
						<div class="panel-body">
							<div class="row text-center">
								<div class="alert alert-danger" id="txt_error_tidak_cukup" style="display:none;">
									<span class="text-danger"><b>Error : Jumlah cuti tidak mencukupi</b></span>
								</div>
							</div>
						
							<div class="col-lg-12">
								<form class="form-horizontal" role="form" method="POST" action="<?php echo site_url().'hcis/c_hcis_cuti/ambil_cuti'; ?>" onSubmit="return cek_cuti_mencukupi();">
									<input type="hidden" name="available_cuti" id="available_cuti">
									<input type="hidden" name="lama_cuti" id="lama_cuti">
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2 control-label-left">Periode Cuti</label>
											<div class="col-lg-3">
												<select name="cmb_periode_cuti" id="cmb_periode_cuti" class="form-control" required onChange="give_value_cuti(this.value)">
													<option value="">Pilih</option>
													<?php
													foreach ($info_sisa_cuti as $l)
													{
														?><option value="<?php echo $l['mcuti_period_year'].":".$l['mcuti_no'].":".$l['mcuti_available']; ?>"><?php echo $l['mcuti_period_year']; ?></option><?php
													}
													?>
												</select>
											</div>
										</div>
									</div>
								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2 control-label-left">Date From</label>
											<div class="col-lg-3">
												<input type="text" name="date_from" id="date_from" class="form-control datepicker_disabled_before" autocomplete="off" required value="<?php echo isset($p_date_from) ? $p_date_from : "" ?>" disabled>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2 control-label-left">Date Thru</label>
											<div class="col-lg-3">
												<input type="text" name="date_thru" id="date_thru" class="form-control datepicker_disabled_before" autocomplete="off" required value="<?php echo isset($p_date_thru) ? $p_date_thru : "" ?>" disabled>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2 control-label-left">Alasan</label>
											<div class="col-lg-8">
												<textarea name="txt_alasan" id="txt_alasan" class="form-control animated" rows=2 required></textarea>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-md-12 text-center" style="padding:0">
												<input type="submit" class="btn btn-primary" name="submit" value="Submit">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>			
					</div>
				</div>
			</div>
		<?php
	}
	?>	
	</div>

<?php
if (!empty($data_ambil_cuti_no_action))
{
	?>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-list"></i><span class="panel_break"></span> Menunggu Persetujuan</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered font-11 datatables" id="data_ambil_cuti_no_action">
					<thead>
						<tr>
							<th style="text-align:center; width:4%;">No.</th>
							<th style="text-align:center;">Periode Cuti</th>
							<th style="text-align:center;">Lama Cuti</th>
							<th style="text-align:center;">Tanggal Cuti</th>
							<th style="text-align:center;" class="col-md-4">Reason</th>
							<th style="text-align:center;">Created Date</th>
							<th style="text-align:center;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$n = 1;
						foreach ($data_ambil_cuti_no_action as $d)
						{
							?>
							<tr>
								<th style="text-align:center;"><?php echo $n;?></th>
								<td style="text-align:center">
									<?php echo $d['mcuti_period_year']; ?>
								</td>
								<td style="text-align:center"><?php echo $d['rcuti_lama_hari']; ?> Hari</td>
								<td style="text-align:center"><?php echo $d['rcuti_date_from']." s/d ".$d['rcuti_date_thru']; ?></td>
								<td style="text-align:left"><?php echo $d['rcuti_reason']; ?></td>
								<td style="text-align:center"><?php echo $d['rcuti_created_date']; ?></td>
								<td style="text-align:center;">
									<a href="#data_ambil_cuti_no_action" onClick="cancel_cuti(this.id)" id="<?php echo $d['rcuti_no']; ?>" class="btn btn-xs btn-danger">
										Cancel
									</a>
								</td>
							</tr>
							<?php
							$n++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php
}
?>