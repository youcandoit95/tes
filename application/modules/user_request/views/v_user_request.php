<?PHP
/** View user request ( form request )
 * UR = user request
 * VE = validation / warning error form
 *
 *
 *
 */

/* Error Form */ 
$VE = validation_errors();
if (!empty($VE))
{$VE_gone = "";}
else
{$VE_gone = "gone";}
/* End Error Form */

$sess_dml = $this->session->flashdata('status_dml_dept');
$msg_sess_dml = $this->session->flashdata('msg_status_dml_dept');
if (($sess_dml=="Y") AND (!empty($msg_sess_dml)))
{$class_dml = "";}
else
{$class_dml = "gone";}

?>
	
<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?PHP echo site_url().'user_request/c_user_request/new_request';?>" accept-charset="utf-8" enctype="multipart/form-data" onSubmit="return confirm('Are you sure want to request ?');">
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">No. Ref ISD</label>
			<div class="col-xs-6 col-md-2" style="padding:0">
				<input type="text" name="req_ref_no" id="req_ref_no" class="form-control" onblur="check_ref_no()" autocomplete="off" required autofocus>
			</div>
			<span id="ajax_ref_no"></span>
		</div>
	</div>
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Request Name</label>
			<div class="col-xs-6 col-md-6" style="padding:0">
				<input type="text" name="req_name" class="form-control" autocomplete="off" required>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Request Type</label>
			<div class="col-xs-6 col-md-6" style="padding:0">
				<select name="req_type" class="form-control" style="width:auto;" required>
					<option value="">Choose</option>
					<?php 
					foreach ($req_type as $rt)
					{
						?><option value="<?php echo $rt['TYPE_NO']; ?>"><?php echo $rt['TYPE_NAME']; ?></option><?php
					}
					?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Request Category</label>
			<div class="col-xs-6 col-md-6" style="padding:0">
				<select name="req_category" class="form-control" style="width:auto;" required>
					<option value="">Choose</option>
					<?php 
					foreach ($req_category as $rc)
					{
						?><option value="<?php echo $rc['CATEGORY_NO']; ?>"><?php echo $rc['CATEGORY_NAME']; ?></option><?php
					}
					?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Request Reason</label>
			<div class="col-xs-6 col-md-6" style="padding:0">
				<textarea name="req_reason" class="form-control animated" id="req_reason" required="" rows=2 maxlength=400 onKeyUp="count_length(this.id)"></textarea>
			</div>
		</div>
	</div>
	
		<div class="form-group" style="margin-top:-15px;">
			<div class="row sorot">
				<label class="col-sm-2 control-label">&nbsp;</label>
				<div class="col-xs-6 col-md-6" style="padding:0">
					<div class="col-xs-6 col-md-2" style="padding:0; width:60px;">
						<input type="text" class="form-control" value=400 disabled="disabled" id="req_reason_char_left">
					</div>
					<label style="margin-top:7px;">Character Left</label>
				</div>
			</div>
		</div>
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Request Note</label>
			<div class="col-xs-6 col-md-6" style="padding:0">
				<textarea name="req_note" class="form-control animated" id="req_note" required="" rows=2 maxlength=400 onKeyUp="count_length(this.id)"></textarea>
			</div>
		</div>
	</div>
	
		<div class="form-group" style="margin-top:-15px;">
			<div class="row">
				<label class="col-sm-2 control-label">&nbsp;</label>
				<div class="col-xs-6 col-md-6" style="padding:0">
					<div class="col-xs-6 col-md-2" style="padding:0; width:60px;">
						<input type="text" class="form-control" value=400 disabled="disabled" id="req_note_char_left">
					</div>
					<label style="margin-top:7px;">Character Left</label>
				</div>
			</div>
		</div>
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Document Support</label>
			<div class="col-xs-6 col-md-3" style="padding:0">
				<input type="file" class="form-control" name="req_documentSupport" id="req_documentSupport" required="" onChange="checkFile(this.value,this.id)">
			</div>
		</div>
	</div>	
	
	<div class="form-group">
		<div class="row" style="margin-top:-15px;">
			<div class="col-sm-2">&nbsp;</div>
			<div class="col-xs-6 col-md-10 bg-white" style="padding-top:10px; padding-bottom:10px; color:black;">
				<div class="col-xs-6 col-md-6" style="padding:0px;">
					<div class="row">
						<div class="col-lg-12">
							<div class="input-group">
								<span class="input-group-addon">
									<input type="checkbox" name="form_req_dev" value="Y">
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
									<input type="checkbox" name="bisnis_proses" value="Y">
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
									<input type="checkbox" name="regulasi" value="Y">
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
									<input type="checkbox" name="prototype" value="Y">
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
									<input type="checkbox" name="master_data" value="Y">
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
									<input type="checkbox" name="fungsi_utama_app" value="Y">
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
									<input type="checkbox" name="karakteristik_pengguna" value="Y">
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
									<input type="checkbox" name="RAS" value="Y">
								</span>
								<input type="text" class="form-control" value="Resiko Akibat Solusi" readonly>
							</div>
						</div>
					</div>
					<!--<label><input type="checkbox" name="RAS" value="Y">Resiko Akibat Solusi</label>-->
					
				</div>
			</div>
		</div>
	</div>
		
	<div class="form-group">
		<div class="row">
			<div class="col-md-12 text-center" style="padding:0">
				<button type="submit" class="btn btn-primary" id="btn_submit_form">SUBMIT</button>
			</div>
		</div>
	</div>	
		
</form>	
	
<script>var url_ifexist_ref_no = "<?php echo site_url().'user_request/c_user_request/ifexist_ref_no';?>";</script>