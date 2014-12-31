<div class="row">
	<div class="col-sm-12 bg-white con-datatables">
		<table class="table table-striped table-bordered font-11 datatables">
			<thead>
				<tr>
					<th style="text-align:center; width:4%;">No.</th>
					<th style="text-align:center;">NIK</th>
					<th style="text-align:center;">Lama Cuti</th>
					<th style="text-align:center;">Tanggal Cuti</th>
					<th style="text-align:center;">Reason</th>
					<th style="text-align:center;">Created Date</th>
					<th style="text-align:center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$n = 1;
				foreach ($data_annual_leave as $d)
				{
					$id_reject = "reject_".$d['rcuti_no']."+".$d['karyawan_nik']."+".$d['karyawan_fullname']."+".$d['mcuti_period_year']."+".$d['rcuti_lama_hari']."+".$d['rcuti_date_from']."+".$d['rcuti_date_thru']."+".$d['rcuti_created_date'];
					?>
					<tr>
						<th style="text-align:center"><?php echo $n;?></th>
						<td style="text-align:center">
							<a href="#" onClick="view_detail(this.id)" id="<?php echo $d['karyawan_nik']; ?>">
								<span class="ttip" data-placement="top" title="Klik untuk melihat detail"><?php echo $d['karyawan_nik']." - ".$d['karyawan_fullname']; ?></span>
							</a>
						</td>
						<td style="text-align:center"><?php echo $d['rcuti_lama_hari']; ?> Hari</td>
						<td style="text-align:center"><?php echo $d['rcuti_date_from']." s/d ".$d['rcuti_date_thru']; ?></td>
						<td style="text-align:left"><?php echo $d['rcuti_reason']; ?></td>
						<td style="text-align:center"><?php echo $d['rcuti_created_date']; ?></td>
						<td style="text-align:center;">
							<a href="#" onClick="approve_cuti(this.id)" id="approve_<?php echo $d['rcuti_no']."_".$d['mcuti_no']; ?>" class="btn btn-xs btn-success">Approve</a>
							<a href="#" onClick="reject_cuti(this.id)" id="<?php echo $id_reject; ?>" class="btn btn-xs btn-danger">Reject</a>
						</td>
					</tr>
					<?php
					$n++;
				}
				?>
			</tbody>
		</table>
	</div>
	
	<!-- Modal -->
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
	
	<div id="modal_reject_cuti" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<form method="POST" action="<?php echo site_url().'hcis/c_hcis_cuti_approval/reject_annual_leave_2nd_level'; ?>">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Reject Annual Leave</h4>
				</div>
				<div class="modal-body">
					<table class="table col-md-12 table-bordered table-hover table-striped" style="font-size:12px;">
						<input type="hidden" name="rcuti_no" id="rcuti_no">
						<tr>
							<td class="col-md-5">NIK</td>
							<td id="rj_karyawan_nik">&nbsp;</td>
						</tr>
						<tr>
							<td>Periode Cuti yang digunakan</td>
							<td id="rj_periode_cuti">&nbsp;</td>
						</tr>
						<tr>
							<td>Lama Cuti</td>
							<td id="rj_lama_cuti">&nbsp;</td>
						</tr>
						<tr>
							<td>Tanggal Cuti</td>
							<td id="rj_tgl_cuti">&nbsp;</td>
						</tr>
						<tr>
							<td>Tanggal Pengajuan</td>
							<td id="rj_tgl_pengajuan">&nbsp;</td>
						</tr>
						<tr>
							<td>Reject Reason</td>
							<td><textarea name="reject_reason" id="p_reject_reason" class="form-control animated" rows=2 required></textarea></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" value="Submit" class="btn btn-danger">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div>
</div>

<script type="text/javascript">
	var url_approve_cuti = "<?php echo site_url().'hcis/c_hcis_cuti_approval/approve_annual_leave_2nd_level';?>";
</script>