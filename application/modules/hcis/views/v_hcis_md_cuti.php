<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="myTab">
	<li class="active"><a href="#new_user" role="tab" data-toggle="tab">Master Data Cuti Baru</a></li>
	<li><a href="#data_user" role="tab" data-toggle="tab">Data Master Data Cuti</a></li>
</ul>

<!-- Tab panes -->

<div class="tab-content">
	
	<div class="tab-pane fade in active" id="new_user" style="padding:20px 0px 0px 40px;">
		
		<div class="row">
			<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'hcis/c_hcis_md_cuti/md_cuti_baru';?>" onSubmit="return confirm('Are you sure want to request ?');">
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">NIK</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="cmb_nik" id="cmb_nik" class="form-control combobox" onChange="data_karyawan_mdl_md_cuti(this.value)" required>
								<option value="">Pilih NIK</option>
								<?php
								foreach ($data_karyawan as $l)
								{
									?><option value="<?php echo $l['karyawan_nik']; ?>"><?php echo $l['karyawan_nik']." - ".$l['karyawan_fullname']; ?></option><?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Jabatan</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" id="txt_jabatan" class="form-control" disabled>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Division</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" id="txt_division" class="form-control" disabled>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Departement</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" id="txt_dept" class="form-control" disabled>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Bagian</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" id="txt_bagian" class="form-control" disabled>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Nama Lengkap</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" id="txt_nama_lengkap" class="form-control" disabled>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Periode Tahun</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="cmb_periode_tahun" id="cmb_periode_tahun" class="form-control" style="width:auto;">
								<option value="">Pilih Periode</option>
								<option value="<?php echo intval($periode_tahun) - 1; ?>"><?php echo intval($periode_tahun) - 1; ?></option>
								<option value="<?php echo intval($periode_tahun); ?>"><?php echo intval($periode_tahun); ?></option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Jumlah Cuti</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="number" name="txt_jumlah_cuti" id="txt_jumlah_cuti" class="form-control" autocomplete="off" required>
						</div>
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
		
	</div>

	<div class="tab-pane fade in" id="data_user" style="padding:10px 0px 0px 18px;">
		<div class="row">
			<div class="col-sm-12 bg-white con-datatables">
				<table class="table table-hover table-striped table-bordered font-11 datatables">
					<thead>
						<tr>
							<th style="text-align:center;">No.</th>
							<th style="text-align:center;">NIK</th>
							<th style="text-align:center;">Nama Lengkap</th>
							<th style="text-align:center;">Period</th>
							<th style="text-align:center;">Jumlah Cuti</th>
							<th style="text-align:center;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$n = 1;
						foreach ($data_mcuti as $d)
						{
							?>
							<tr>
								<th style="text-align:center"><?php echo $n;?></th>
								<td style="text-align:center">
									<a href="#" onClick="view_detail(this.id)" id="<?php echo $d['mcuti_karyawan_nik']; ?>">
										<span class="ttip" data-placement="top" title="Klik untuk melihat detail"><?php echo $d['mcuti_karyawan_nik']; ?></span>
									</a>
								</td>
								<td style="text-align:center"><?php echo $d['karyawan_fullname']; ?></td>
								<td style="text-align:center"><?php echo $d['mcuti_period_year']; ?></td>
								<td style="text-align:center"><?php echo $d['mcuti_available']; ?></td>
								<td style="text-align:center">
									<?php
									if ($d['mcuti_change_md']==1)
									{
										?>
										<button type="button" class="btn btn-xs btn-primary" id="<?php echo $d['mcuti_no'].":".$d['mcuti_available'].":".$d['mcuti_karyawan_nik']; ?>" onClick="open_edit_md_cuti(this.id)">
											EDIT
										</button>
										<?php
									}
									?>
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
	
	<!-- Modal Detail Karyawan-->
	<div id="modal_detail_karyawan" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Detail Karyawan</h4>
				</div>
				<div class="modal-body">
					<table class="table col-md-12 table-bordered table-hover table-striped" style="font-size:12px;">
						<tr>
							<td class="col-md-3">NIK</td>
							<td id="detail_karyawan_nik">&nbsp;</td>
						</tr>
						<tr>
							<td>Divisi</td>
							<td id="detail_karyawan_divisi">&nbsp;</td>
						</tr>
						<tr>
							<td>Departement</td>
							<td id="detail_karyawan_dept">&nbsp;</td>
						</tr>
						<tr>
							<td>Bagian</td>
							<td id="detail_karyawan_bagian">&nbsp;</td>
						</tr>
						<tr>
							<td>Jabatan</td>
							<td id="detail_karyawan_jabatan">&nbsp;</td>
						</tr>
						<tr>
							<td>Nama Lengkap</td>
							<td id="detail_karyawan_fname">&nbsp;</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td id="detail_karyawan_address">&nbsp;</td>
						</tr>
						<tr>
							<td>Telepon</td>
							<td id="detail_karyawan_telepon">&nbsp;</td>
						</tr>
						<tr>
							<td>Email</td>
							<td id="detail_karyawan_email">&nbsp;</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- Modal Edit MD cuti -->
	<div id="modal_edit_md_cuti" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<form  method="POST" action="<?php echo site_url().'hcis/c_hcis_md_cuti/md_cuti_ubah';?>" onSubmit="return confirm('Are you sure want to request ?');">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit Master Data Cuti</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="mcuti_no" id="mcuti_no">
					<input type="hidden" name="karyawan_nik" id="karyawan_nik">
					<div class="row">
						<div class="col-md-5">
						<table class="table col-md-5 table-bordered table-hover table-striped" style="font-size:12px;">
							<tr>
								<td style="   padding-top: 9%;    font-size: 14px;    font-weight: bolder;">Jumlah Cuti</td>
								<td class="col-md-6"><input type="number" name="txt_jumlah_cuti" id="txt_jumlah_cuti_ubah" class="form-control" autocomplete="off" required></td>
							</tr>
						</table>
						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>

