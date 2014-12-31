<div class="row">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-list"></i><span class="panel_break"></span> Data Annual Leave</h3>
		</div>
		<div class="panel-body">
			<div class="col-sm-12 bg-white con-datatables">
				<table class="table table-striped table-bordered font-11 datatables">
					<thead>
						<tr>
							<th style="text-align:center; width:4%;">No.</th>
							<th style="text-align:center;">Lama Cuti</th>
							<th style="text-align:center;">Tanggal Cuti</th>
							<th style="text-align:center;">Reason</th>
							<th style="text-align:center;">Status</th>
							<th style="text-align:center;">Created Date</th>
							<th style="text-align:center;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$n = 1;
						foreach ($data_ambil_cuti as $d)
						{
							$class_row = "";
							
							if ($d['rcuti_cancel']==1)
							{
								$class_row = "danger";
							}
							else
							{
								if ($d['rcuti_lstatus']==4 || $d['rcuti_lstatus']==2)
								{
									$class_row = "warning";
								}
								
								if ($d['rcuti_lstatus']==1)
								{
									$class_row = "success";
								}
							}
							
							switch ($d['rcuti_approve_up_level'])
							{
								case 1:
								$status_rcuti_approve_up_level = "Approved";
								break;
								
								case 2:
								$status_rcuti_approve_up_level = "Rejected";
								break;
								
								case 99:
								$status_rcuti_approve_up_level = "Waiting Approval";
								break;
								
								default:
								$status_rcuti_approve_up_level = "";
								break;
							}
							
							switch ($d['rcuti_approve_hrd'])
							{
								case 1:
								$status_rcuti_approve_hrd = "Approved";
								break;
								
								case 2:
								$status_rcuti_approve_hrd = "Rejected";
								break;
								
								case 3:
								$status_rcuti_approve_hrd = "Waiting Approval";
								break;
								
								default:
								$status_rcuti_approve_hrd = "";
								break;
							}
							
							$array_data_cuti[0] = "reject_".$d['rcuti_no']."+".$d['karyawan_nik']."+".$d['karyawan_fullname']."+".$d['mcuti_period_year']."+".$d['rcuti_lama_hari']."+".$d['rcuti_date_from']."+".$d['rcuti_date_thru']."+".$d['rcuti_created_date'];
							$array_data_cuti[1] = $status_rcuti_approve_up_level;
							$array_data_cuti[2] = $d['reject_up_level_reason'];
							$array_data_cuti[3] = $d['approve_up_level_date'];
							$array_data_cuti[4] = $status_rcuti_approve_hrd;
							$array_data_cuti[5] = $d['reject_hrd_reason'];
							$array_data_cuti[6] = $d['approve_hrd_date'];
							
							//$id_reject = "reject_".$d['rcuti_no']."+".$d['karyawan_nik']."+".$d['karyawan_fullname']."+".$d['mcuti_period_year']."+".$d['rcuti_lama_hari']."+".$d['rcuti_date_from']."+".$d['rcuti_date_thru']."+".$d['rcuti_created_date'];
							$id_reject = implode("+", $array_data_cuti);
							?>
							<tr class="<?php echo $class_row; ?>">
								<th style="text-align:center"><?php echo $n;?></th>
								<td style="text-align:center"><?php echo $d['rcuti_lama_hari']; ?> Hari</td>
								<td style="text-align:center"><?php echo $d['rcuti_date_from']." s/d ".$d['rcuti_date_thru']; ?></td>
								<td style="text-align:left"><?php echo $d['rcuti_reason']; ?></td>
								<td style="text-align:center"><?php echo $d['rcuti_cancel']==1 ? "Cancel" : $d['rcuti_lstatus_name']; ?></td>
								<td style="text-align:center"><?php echo $d['rcuti_created_date']; ?></td>
								<td style="text-align:center;">
									<a href="#" onClick="reject_cuti(this.id)" id="<?php echo $id_reject; ?>" class="btn btn-xs btn-primary">Detail</a>
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
</div>
	
	<div id="modal_reject_cuti" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Detail Pengajuan Cuti</h4>
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
							<td>Approval Up Level</td>
							<td id="rj_approval_up_level">&nbsp;</td>
						</tr>
						<tr>
							<td>Approval Up Level Reason</td>
							<td id="rj_approval_up_level_reason">&nbsp;</td>
						</tr>
						<tr>
							<td>Approval Up Level Date</td>
							<td id="rj_approval_up_level_date">&nbsp;</td>
						</tr>
						<tr>
							<td>Approval HRD</td>
							<td id="rj_approval_hrd">&nbsp;</td>
						</tr>
						<tr>
							<td>Approval HRD Reason</td>
							<td id="rj_approval_hrd_reason">&nbsp;</td>
						</tr>
						<tr>
							<td>Approval HRD Date</td>
							<td id="rj_approval_hrd_date">&nbsp;</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div>
</div>