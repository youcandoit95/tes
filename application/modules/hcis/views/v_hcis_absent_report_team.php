<?php
if (isset($post_generate))
{
	?>
	<div class="row">
		<div class="col-lg-5">
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-pencil-square-o"></i><span class="panel_break"></span> Form Generate Report</h3>
					</div>
					<div class="panel-body">
						<div class="col-lg-12">
							<form class="form-horizontal" role="form" method="POST" action="#">
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left">Date From</label>
										<div class="col-lg-6">
											<input type="text" name="date_from" id="date_from" class="form-control datepicker" autocomplete="off" required value="<?php echo isset($p_date_from) ? $p_date_from : "" ?>" disabled>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left">Date Thru</label>
										<div class="col-lg-6">
											<input type="text" name="date_thru" id="date_thru" class="form-control datepicker" autocomplete="off" required value="<?php echo isset($p_date_thru) ? $p_date_thru : "" ?>" disabled>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left">Division</label>
										<div class="col-lg-6">
											<input type="hidden" name="cmb_karyawan_div_no" id="cmb_karyawan_div_no" class="form-control datepicker" autocomplete="off" required value="<?php echo $post_div_no; ?>">
											<input type="text" class="form-control" value="<?php echo $post_div_name; ?>" disabled>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left">Departement</label>
										<div class="col-lg-6">
											<input type="hidden" name="cmb_karyawan_dept_no" id="cmb_karyawan_dept_no" class="form-control datepicker" autocomplete="off" required value="<?php echo $post_dept_no; ?>">
											<input type="text" class="form-control" value="<?php echo $post_dept_name; ?>" disabled>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left">Bagian</label>
										<div class="col-lg-6">
											<input type="hidden" name="cmb_karyawan_bagian_no" id="cmb_karyawan_bagian_no" class="form-control datepicker" autocomplete="off" required value="<?php echo $post_bagian_no; ?>">
											<input type="text" class="form-control" value="<?php echo $post_bagian_name; ?>" disabled>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-lg-12 text-center">
											<a href="<?php echo site_url().'hcis/c_hcis_absent_report/index_team_absent'; ?>" class="btn btn-primary">New Generate</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
else
{
?>
	<div class="row">
		<div class="col-lg-5">
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-pencil-square-o"></i><span class="panel_break"></span> Form Generate Report</h3>
					</div>
					<div class="panel-body">
						<div class="col-lg-12">
							<form class="form-horizontal" role="form" method="POST" action="<?php echo site_url().'hcis/c_hcis_absent_report/generate_team_absent';?>" onSubmit="return confirm('Are you sure want to request ?');">
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left" >Date From</label>
										<div class="col-lg-6" >
											<input type="text" name="date_from" id="date_from" class="form-control datepicker" autocomplete="off" required value="<?php echo isset($p_date_from) ? $p_date_from : "" ?>">
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left">Date Thru</label>
										<div class="col-lg-6">
											<input type="text" name="date_thru" id="date_thru" class="form-control datepicker" autocomplete="off" required value="<?php echo isset($p_date_thru) ? $p_date_thru : "" ?>">
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left">Division</label>
										<div class="col-lg-6">
											<?php
											if ($p_jabatan==1 || $karyawan_hrd==1) // top & HRD
											{
												?>
												<select name="cmb_karyawan_div_no" id="cmb_karyawan_div_no" class="form-control"  onChange="get_md_dept(this.value)" required>
													<option value="">Pilih</option>
													<option value="888">Semua Divisi</option>
												<?php
												foreach ($md_division as $l)
												{
													?><option value="<?php echo $l['div_no']; ?>"><?php echo $l['div_name']; ?></option><?php
												}
											}
											else // director kebawah
											{
												?>
												<select name="cmb_karyawan_div_no" id="cmb_karyawan_div_no" class="form-control"  required>
													<option value="<?php echo $p_div_no; ?>"><?php echo $p_div_name; ?></option>
												<?php
											}
											?>
												</select>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left">Departement</label>
										<div class="col-lg-6">
											<?php
											if ($p_jabatan==1 || $karyawan_hrd==1) // top & HRD
											{
												?>
												<select name="cmb_karyawan_dept_no" id="cmb_karyawan_dept_no" class="form-control"  onChange="get_md_bagian(this.value)" required>
													<option value="">Pilih Divisi</option>
												<?php
											}
											else if ($p_jabatan==2 || $p_jabatan==3)  //  director , gm
											{
												?>
												<select name="cmb_karyawan_dept_no" id="cmb_karyawan_dept_no" class="form-control"  onChange="get_md_bagian(this.value)" required>
													<option value="">Pilih Departement</option>
													<option value="888">Semua Departement</option>
												<?php
												foreach ($md_dept as $l)
												{
													?><option value="<?php echo $l['dept_no']; ?>"><?php echo $l['dept_name']; ?></option><?php
												}
											}
											else // manager
											{
												?>
												<select name="cmb_karyawan_dept_no" id="cmb_karyawan_dept_no" class="form-control"  required>
													<option value="<?php echo $p_dept_no; ?>"><?php echo $p_dept_name; ?></option>
												<?php
											}
											?>
												</select>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-4 control-label-left" >Bagian</label>
										<div class="col-lg-6">
											<?php
											if ($p_jabatan==4) // manager,
											{
												if ($karyawan_hrd==1)
												{
													?>
													<select name="cmb_karyawan_bagian_no" id="cmb_karyawan_bagian_no" class="form-control"  required>
														<option value="">Pilih Bagian</option>
													<?php
												}
												else
												{
													?>
													<select name="cmb_karyawan_bagian_no" id="cmb_karyawan_bagian_no" class="form-control"  required>
														<option value="">Pilih Bagian</option>
														<option value="888">Semua Bagian</option>
													<?php
													foreach ($md_bagian as $l)
													{
														?><option value="<?php echo $l['bagian_no']; ?>"><?php echo $l['bagian_name']; ?></option><?php
													}
												}
											}
											else
											{
												?>
												<select name="cmb_karyawan_bagian_no" id="cmb_karyawan_bagian_no" class="form-control"  required>
													<?php
													if (!isset($post_bagian_no))
													{
														?>
														<option value="">Pilih Departemen</option>
														<?php
													}
													else
													{
														if ($post_bagian_no==888)
														{
															echo "<option value='888'>Semua Bagian</option>";
														}
													}
											}
											?>
											</select>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-lg-12 text-center">
											<input type="submit" class="btn btn-primary" name="generate" value="Generate">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>

<?php
if (isset($data_absent))
{
	?>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-list"></i><span class="panel_break"></span> Result Generate Report</h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-striped table-bordered font-11" id="example">
					<thead>
						<tr>
							<th style="text-align:center;" class="col-md-1">No.</th>
							<th style="text-align:center;">NIK</th>
							<th style="text-align:center;">Nama Lengkap</th>
							<th style="text-align:center;">Date</th>
							<th style="text-align:center;">Punch In Time</th>
							<th style="text-align:center;">Punch Out Time</th>
							<th style="text-align:center;">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$n = 1;
						foreach ($data_absent as $d)
						{
							?>
							<tr>
								<th style="text-align:center"><?php echo $n;?></th>
								<td style="text-align:center"><?php echo $d['absen_karyawan_nik']; ?></td>
								<td style="text-align:center"><?php echo $d['karyawan_fullname']; ?></td>
								<td style="text-align:center"><?php echo $d['absen_date']; ?></td>
								<td style="text-align:center">
									<?php 
									if ($d['pi_late_flag']==1)
									{
										?>
										<span class="ttip" data-placement="top" title="<?php echo $d['pi_late_reason']; ?>">
											<?php echo $d['absen_punch_in_time']; ?>
										</span>
										<?php
									}
									else
									{
										echo $d['absen_punch_in_time']=="" ? "&nbsp;" : $d['absen_punch_in_time']; 
									}
									?>
								</td>
								<td style="text-align:center">
									<?php 
									if ($d['po_early_flag']==1)
									{
										?>
										<span class="ttip" data-placement="top" title="<?php echo $d['po_early_reason']; ?>">
											<?php echo $d['absen_punch_out_time']; ?>
										</span>
										<?php
									}
									else
									{
										echo $d['absen_punch_out_time']=="" ? "&nbsp;" : $d['absen_punch_out_time']; 
									}
									?>
								</td>
								<td style="text-align:center"><?php echo $d['absen_status']; ?></td>
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