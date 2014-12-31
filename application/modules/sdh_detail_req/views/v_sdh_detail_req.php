<?php
foreach ($detail_request as $d)
{
?>
	<div class="row con-datatables">
		<div class="row bg-white">
			<div class="col-sm-6 con-datatables">
				<table class="table table-hover table-striped table-bordered font-12 ">
					<tr>
						<td class="col-sm-3 text-bold">Req. No#</td>
						<td class="text-bold"><?php echo $d['REQ_NO'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-3 text-bold">No. Ref ISD</td>
						<td class="text-bold"><?php echo $d['REF_NO'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-3 text-bold">Created By</td>
						<td class="text-bold"><?php echo $d['REQ_BY_USERID'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-3 text-bold">Created Date</td>
						<td class="text-bold"><?php echo $d['REQ_CREATED'] ?></td>
					</tr>
				</table>
			</div>
			<div class="col-sm-6 con-datatables pull-right">
				<table class="table table-hover table-striped table-bordered font-12">
					<tr>
						<td class="col-sm-3 text-bold">PIC</td>
						<td><?php echo $d['REQ_PIC_USERID'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-3 text-bold">Est. Time Done</td>
						<td><?php echo $d['REQ_EST_TIME'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-3 text-bold">Status</td>
						<td><?php echo $d['STATUS_NAME'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-3 text-bold">Status Reason</td>
						<td><?php echo $d['REQ_LSTATUS_REASON'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-3 text-bold">Priority</td>
						<td><?php echo $d['PRIORITY_NAME'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-3 text-bold">Priority Reason</td>
						<td><?php echo $d['PRIORITY_REASON'] ?></td>
					</tr>
					<?php
					if ($menu_active=="waiting_done" || $menu_active=="done_request")
					{
					?>
						<tr>
							<td class="col-sm-3 text-bold">Note From PIC</td>
							<td valign="top"><?php echo $d['REQ_DONE_NOTE_PIC'] ?></td>
						</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 con-datatables bg-white">
				<table class="table table-hover table-striped table-bordered font-12">
					<tr>
						<td class="col-sm-2 text-bold">Req. Name</td>
						<td><?php echo $d['REQ_NAME'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-2 text-bold">Req. Type</td>
						<td><?php echo $d['TYPE_NAME'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-2 text-bold">Req. Category</td>
						<td><?php echo $d['CATEGORY_NAME'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-2 text-bold">Req. Reason</td>
						<td><?php echo $d['REQ_REASON'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-2 text-bold">Req. Note</td>
						<td><?php echo $d['REQ_NOTE'] ?></td>
					</tr>
					<tr>
						<td class="col-sm-2 text-bold">Document Support</td>
						<td>
							<div class="row">
								<div  style="padding-left:15px;">
								<?php echo $d['FILE_DOC_SUPPORT']; ?>
								<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['FILE_DOC_SUPPORT'];?>" class="ttip" style="" data-toggle="tooltip" data-placement="top" data-original-title="Download File">
									<i class="glyphicon glyphicon-download-alt"></i>
								</a>						
								</div>
							</div>
							<div class="col-xs-6 col-md-10 bg-white" style="padding-top:10px; margin-top:5px; padding-bottom:10px; color:black;">
								<div class="col-xs-6 col-md-6" style="padding:0px;">
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="form_req_dev" value="Y" <?php echo $d['FILE_FORM_REQ_DEV']; ?> disabled>
												</span>
												<input type="text" class="form-control" value="Form Request dari IT Development" readonly>
											</div>
										</div>
									</div>
									<!--<label><input type="checkbox" name="form_req_dev" value="Y">Form Request dari IT Development</label><br>-->
									
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="bisnis_proses" value="Y" <?php echo $d['FILE_BISNIS_PROSES']; ?> disabled>
												</span>
												<input type="text" class="form-control" value="Bisnis Proses" readonly>
											</div>
										</div>
									</div>
									<!--<label><input type="checkbox" name="bisnis_proses" value="Y">Bisnis Proses</label><br>-->
									
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="regulasi" value="Y" <?php echo $d['FILE_REGULASI']; ?> disabled>
												</span>
												<input type="text" class="form-control" value="Regulasi" readonly>
											</div>
										</div>
									</div>
									<!--<label><input type="checkbox" name="regulasi" value="Y">Regulasi</label>-->
									
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="prototype" value="Y" <?php echo $d['FILE_PROTOTYPE']; ?> disabled>
												</span>
												<input type="text" class="form-control" value="Prototype dan User Interface (Antar Muka Pengguna)" readonly>
											</div>
										</div>
									</div>
									<!--<label><input type="checkbox" name="prototype" value="Y">Prototype dan User Interface (Antar Muka Pengguna)</label>-->
								</div>
								
								<div class="col-xs-6 col-md-6">
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="master_data" value="Y" <?php echo $d['FILE_MASTER_DATA']; ?> disabled>
												</span>
												<input type="text" class="form-control" value="Data yang dipergunakan (Master Data)" readonly>
											</div>
										</div>
									</div>
									<!--<label><input type="checkbox" name="master_data" value="Y">Data yang dipergunakan (Master Data)</label>-->
									
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="fungsi_utama_app" value="Y" <?php echo $d['FILE_FUNGSI_UTAMA_APP']; ?> disabled>
												</span>
												<input type="text" class="form-control" value="Fungsi Utama Aplikasi" readonly>
											</div>
										</div>
									</div>
									<!--<label><input type="checkbox" name="fungsi_utama_app" value="Y">Fungsi Utama Aplikasi</label>-->
									
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="karakteristik_pengguna" value="Y" <?php echo $d['FILE_KARAKTERISTIK_PENGGUNA']; ?> disabled>
												</span>
												<input type="text" class="form-control" value="Karakteristik Pengguna (Modul Aplikasi)" readonly>
											</div>
										</div>
									</div>
									<!--<label><input type="checkbox" name="karakteristik_pengguna" value="Y">Karakteristik Pengguna (Modul Aplikasi)</label>-->
									
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="RAS" value="Y" <?php echo $d['FILE_RAS']; ?> disabled>
												</span>
												<input type="text" class="form-control" value="Resiko Akibat Solusi" readonly>
											</div>
										</div>
									</div>
									<!--<label><input type="checkbox" name="RAS" value="Y">Resiko Akibat Solusi</label>-->
									
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="col-sm-2 text-bold">Document UAT</td>
						<td>
							<?php echo $d['FILE_UAT']; 
							if ($d['FILE_UAT']!="N/A")
							{
							?>
								<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['FILE_UAT'];?>" class="ttip" style="" data-toggle="tooltip" data-placement="top" data-original-title="Download File">
									<i class="glyphicon glyphicon-download-alt"></i>
								</a>	
							<?php
							}
							?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<?php
}
?>