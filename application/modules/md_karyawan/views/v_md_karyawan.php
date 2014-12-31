<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="myTab">
	<li class="active"><a href="#new_user" role="tab" data-toggle="tab">Karyawan Baru</a></li>
	<li><a href="#data_user" role="tab" data-toggle="tab">Data Karyawan</a></li>
</ul>

<!-- Tab panes -->

<div class="tab-content">
	
	<div class="tab-pane fade in active" id="new_user" style="padding:20px 0px 0px 40px;">
		
		<div class="row">
			<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'md_karyawan/c_md_karyawan/karyawan_baru';?>" onSubmit="return confirm('Are you sure want to request ?');">
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">NIK</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" name="txt_karyawan_nik" id="txt_karyawan_nik" class="form-control" onBlur="check_user_available(this.value)" autocomplete="off" required autofocus>
						</div>
						<span class="cekAvUserTrue_user_id text-success"></span><span class="cekAvUserFalse_user_id text-danger"></span>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Jabatan</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="cmb_karyawan_jabatan_no" id="cmb_karyawan_jabatan_no" class="form-control" style="width:auto;" onChange="field_unit(this.value,this.id)" required>
								<option value="">Pilih</option>
								<?php
								foreach ($md_jabatan as $l)
								{
									?><option value="<?php echo $l['jabatan_no']; ?>"><?php echo $l['jabatan_name']; ?></option><?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Division</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="cmb_karyawan_div_no" id="cmb_karyawan_div_no" class="form-control" style="width:auto;" onChange="get_md_dept(this.value)" required>
								<option value="">Pilih</option>
								<?php
								foreach ($md_division as $l)
								{
									?><option value="<?php echo $l['div_no']; ?>"><?php echo $l['div_name']; ?></option><?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Departement</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="cmb_karyawan_dept_no" id="cmb_karyawan_dept_no" class="form-control" style="width:auto;" onChange="get_md_bagian(this.value)" required>
								<option value="">Pilih Divisi</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Bagian</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="cmb_karyawan_bagian_no" id="cmb_karyawan_bagian_no" class="form-control" style="width:auto;" required>
								<option value="">Pilih Departemen</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Nama Lengkap</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" name="txt_karyawan_fullname" id="txt_karyawan_fullname" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Tanggal Lahir</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" name="txt_tanggal_lahir" id="txt_tanggal_lahir" class="form-control datepicker_tgl_lahir" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Alamat</label>
						<div class="col-xs-6 col-md-6" style="padding:0">
							<textarea name="txt_karyawan_address" id="txt_karyawan_address" class="form-control animated" rows=2 required></textarea>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Telepon</label>
						<div class="col-xs-6 col-md-2" style="padding:0">
							<input type="text" name="txt_karyawan_phone1" id="txt_karyawan_phone1" class="form-control" autocomplete="off" required>
						</div>
						<label class="col-sm-1 control-label-left" style="width:1%;padding-left:0;">,</label>
						<div class="col-xs-6 col-md-2" style="padding:0">
							<input type="text" name="txt_karyawan_phone2" id="txt_karyawan_phone2" class="form-control" autocomplete="off">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Email</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="email" name="txt_karyawan_email" id="txt_karyawan_email" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Sudah Dapat Cuti</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<div class="radio-inline">
								<label>
									<input type="radio" name="cmb_dapat_cuti" value="1"> Ya
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="cmb_dapat_cuti" value="99" checked> Tidak
								</label>
							</div>
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
		
		<?php
		/*
		<div class="row" style="display:none" id="con_fed">
			<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'md_users/c_users/edit_user';?>" onSubmit="return confirm('Are you sure want to edit ?');">
				<input type="hidden" name="user_no" id="fed_user_no">
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">User Level</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="user_level" id="fed_user_level" class="form-control" onChange="field_unit(this.value,this.id)" style="width:auto;" required>
								<option value="">Choose</option>
								<?php
								foreach ($level as $l)
								{
									?><option value="<?php echo $l['LEVEL_NO']; ?>"><?php echo $l['LEVEL_DESC']; ?></option><?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">User ID</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" name="user_id" id="fed_user_id" class="form-control" onBlur="check_user_available(this.id)" autocomplete="off" required autofocus>
						</div>
						<span class="cekAvUserTrue_fed_user_id text-success"></span><span class="cekAvUserFalse_fed_user_id text-error"></span>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Department</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="department" id="fed_department" class="form-control" style="width:auto;" required>
								<option value="">Choose</option>
								<?php 
								foreach ($dept as $d)
								{
									?><option value="<?php echo $d['DEPT_NO']; ?>"><?php echo $d['DEPT_NAME']; ?></option><?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group" style="display:none;" id="con_unit_fed_user_level">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">Unit</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<select name="user_unit" id="frm_unit_fed_user_level" class="form-control" style="width:auto;" required>
								<option value="">Choose</option>
								<?php 
								foreach ($category as $c)
								{
									?><option value="<?php echo $c['CATEGORY_NO']; ?>"><?php echo $c['CATEGORY_NAME']; ?></option><?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">User Fullname</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" name="user_fname" id="fed_user_fname" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">User Nickname</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" name="user_nname" id="fed_user_nname" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">User Email</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="email" name="user_email" id="fed_user_email" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label-left" style="padding-left:0;">User Phone</label>
						<div class="col-xs-6 col-md-2" style="padding:0">
							<input type="text" name="user_phone" id="fed_user_phone" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 text-center" style="padding:0">
							<button type="button" class="btn" onClick="close_fed()">CANCEL</button>
							<button type="submit" class="btn btn-primary" id="btn_submit_form">SUBMIT</button>
						</div>
					</div>
				</div>
				
			</form>
		</div>
		*/
		?>
		
		<div class="row">
			<div class="col-sm-12 bg-white con-datatables">
				<table class="table table-hover table-striped table-bordered font-11 datatables">
					<thead>
						<tr>
							<th style="text-align:center;">No.</th>
							<th style="text-align:center;">NIK</th>
							<th style="text-align:center;">Divisi</th>
							<th style="text-align:center;">Departemen</th>
							<th style="text-align:center;">Bagian</th>
							<th style="text-align:center;">Jabatan</th>
							<th style="text-align:center;">Nama Lengkap</th>
							<th style="text-align:center;">Dapat Cuti</th>
							<!--<th style="text-align:center;">Action</th>-->
						</tr>
					</thead>
					<tbody>
						<?php
						$n = 1;
						foreach ($data_user as $d)
						{
							?>
							<tr>
								<th style="text-align:center"><?php echo $n;?></th>
								<td style="text-align:center">
									<a href="#" onClick="view_detail(this.id)" id="<?php echo $d['karyawan_nik']; ?>">
										<span class="ttip" data-placement="top" title="Klik untuk melihat detail"><?php echo $d['karyawan_nik']; ?></span>
									</a>
								</td>
								<td style="text-align:center"><?php echo $d['karyawan_div_name']; ?></td>
								<td style="text-align:center"><?php echo $d['karyawan_dept_name']; ?></td>
								<td style="text-align:center"><?php echo $d['karyawan_bagian_name']; ?></td>
								<td style="text-align:center"><?php echo $d['karyawan_jabatan_name']; ?></td>
								<td style="text-align:left"><?php echo $d['karyawan_fullname']; ?></td>
								<td style="text-align:center">
									<?php 
									if  ($d['karyawan_get_cuti']==1)
									{
										?>
										<button type="button" onClick="set_tidak_get_cuti(this.value)" class="btn btn-xs btn-success ttip" title="Klik untuk men-set tidak" value="<?php echo $d['karyawan_nik'] ?>">
											Ya
										</button>
										<?php
									}
									else
									{
										?>
										<button type="button" onClick="set_ya_get_cuti(this.value)" class="btn btn-xs btn-danger ttip" title="Klik untuk men-set Ya" value="<?php echo $d['karyawan_nik'] ?>">
											Tidak
										</button>
										<?php
									}
									?>
								</td>
								<?php
								/*
								<td style="text-align:center;">
									<?php
									$active = $d['USER_ACTIVE']; 
									if ($active == 1)
									{
										?>
										<a href="<?php echo site_url().'md_users/c_users/Activate_user/'.$d['USER_NO'];?>" onClick="return confirm('Apakah anda yakin ?');"> <img src="<?php echo base_url().'images/icon/true.png';?>"></a>
										<?php
									}
									else
									{
										?>
										<a href="<?php echo site_url().'md_users/c_users/Activate_user/'.$d['USER_NO'];?>" onClick="return confirm('Apakah anda yakin ?');"><img src="<?php echo base_url().'images/icon/false.png';?>"></a>
										<?php
									}
									?>
								</td>
								<td style="text-align:center;">
									<input type="image" class="act" id="<?php echo $d['karyawan_nik']; ?>" src="<?php echo base_url().'images/icon/edit.png';?>" data-toggle="tooltip" data-placement="top" title="Edit" onClick="open_fed_user(this.id)">
									 <input type="image" class="act" id="DEL_User_<?php echo$n;?>" src="<?php echo base_url().'images/icon/delete.png';?>" data-toggle="tooltip" data-placement="top" title="Delete">
								</td>
							</tr>
							*/
							$n++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		
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
					<tr>
						<td>Dapat Cuti</td>
						<td id="detail_karyawan_dapat_cuti">&nbsp;</td>
					</tr>
				</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>