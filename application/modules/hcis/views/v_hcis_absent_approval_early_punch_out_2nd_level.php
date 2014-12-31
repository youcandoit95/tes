<div class="row">
	<div class="col-sm-12 bg-white con-datatables">
		<table class="table table-striped table-bordered font-11 datatables">
			<thead>
				<tr>
					<th style="text-align:center;">No.</th>
					<th style="text-align:center;">NIK</th>
					<th style="text-align:center;">Nama Lengkap</th>
					<th style="text-align:center;">Punch Out Time</th>
					<th style="text-align:center;">Reason</th>
					<th style="text-align:center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$n = 1;
				foreach ($data_early_punch_out as $d)
				{
					?>
					<tr>
						<th style="text-align:center"><?php echo $n;?></th>
						<td style="text-align:center">
							<a href="#" onClick="view_detail(this.id)" id="<?php echo $d['karyawan_nik']; ?>">
								<span class="ttip" data-placement="top" title="Klik untuk melihat detail"><?php echo $d['karyawan_nik']; ?></span>
							</a>
						</td>
						<td style="text-align:left"><?php echo $d['karyawan_fullname']; ?></td>
						<td style="text-align:center"><?php echo $d['absen_punch_out_time']; ?></td>
						<td style="text-align:left"><?php echo $d['po_early_reason']; ?></td>
						<td style="text-align:center;">
							<a href="#" onClick="approve_po_early(this.id)" id="approve_<?php echo $d['absen_no']; ?>" class="btn btn-xs btn-success">Approve</a>
							<a href="#" onClick="reject_po_early(this.id)" id="reject_<?php echo $d['absen_no']."+".$d['karyawan_nik']."+".$d['karyawan_fullname']."+".$d['absen_punch_out_time']."+".$d['po_early_reason']; ?>" class="btn btn-xs btn-danger">Reject</a>
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
	
	<div id="modal_reject_po_early" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<form method="POST" action="<?php echo site_url().'hcis/c_hcis_absent_approval/reject_po_early_2nd_level'; ?>">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Reject Early Punch Out</h4>
				</div>
				<div class="modal-body">
					<table class="table col-md-12 table-bordered table-hover table-striped" style="font-size:12px;">
						<input type="hidden" name="p_absen_no" id="p_absen_no">
						<tr>
							<td class="col-md-4">NIK</td>
							<td id="rpoe_karyawan_nik">&nbsp;</td>
						</tr>
						<tr>
							<td>Nama Lengkap</td>
							<td id="rpoe_karyawan_fname">&nbsp;</td>
						</tr>
						<tr>
							<td>Punch Out Time</td>
							<td id="rpoe_po_time">&nbsp;</td>
						</tr>
						<tr>
							<td>Reason Early Punch Out</td>
							<td id="rpoe_po_reason">&nbsp;</td>
						</tr>
						<tr>
							<td>Reject Reason</td>
							<td><textarea name="p_reject_reason" id="p_reject_reason" class="form-control animated" rows=2 required></textarea></td>
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
	var url_approve_po_early = "<?php echo site_url().'hcis/c_hcis_absent_approval/approve_po_early_2nd_level'; ?>";
</script>