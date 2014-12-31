<?php
foreach ($data_request as $r)
{
	$req_no = $r['REQ_NO'];
	$req_date = $r['REQ_CREATED'];
	$req_dept = $r['DEPT_NAME'];
	$req_type = $r['TYPE_NO'];
	$ref_no = $r['REF_NO'];
	$req_priority = $r['PRIORITY_NO'];
	$req_priority_reason = $r['PRIORITY_REASON'];
	$req_reason = $r['REQ_REASON'];
	$f_req_dev = $r['FILE_FORM_REQ_DEV'];
	$f_bisnis_proses = $r['FILE_BISNIS_PROSES'];
	$f_regulasi = $r['FILE_REGULASI'];
	$f_master_data = $r['FILE_MASTER_DATA'];
	$f_fungsiUtamaApp = $r['FILE_FUNGSI_UTAMA_APP'];
	$f_karakteristik_pengguna = $r['FILE_KARAKTERISTIK_PENGGUNA'];
	$f_prototype = $r['FILE_PROTOTYPE'];
	$f_RAS = $r['FILE_RAS'];
	$f_UAT = $r['FILE_UAT'];
	$req_by = $r['REQUEST_BY'];
	$req_by_mgr = $r['BY_USER_DEPT_MGR'];
	$PIC_mgr = $r['PIC_USER_DEPT_MGR'];
	$req_note = $r['REQ_NOTE'];
}
?>

<div class="width-100 MT-30px">
	<b>FORM REQUEST PROJECT AND MAINTENANCE <br>
	APPLICATIONS MYORION SYSTEM</b>
</div>

<div class="width-100 MT-10px">
	<div class="width-100 text-left MT-10px PL-15px"><b>REQUEST NO. : <?php echo $req_no; ?></b></div>
	<div class="width-100 text-left MT-10px PL-40px"><b>DATE : <?php echo substr($req_date,0,10); ?></b></div>
	<div class="width-100 text-left MT-10px PL-40px"><b>IT SERVICES / DEPARTMENT : <?php echo $req_dept; ?></b></div>
</div>

<div class="width-96-2 ML-15px MB-10px MT-30px border-double">
	<div class="width-90 M-10px">
		<div class="width-100 text-left">
			<div class="width-100"><b>REQUEST : </b></div>
		</div>
		<div class="width-100 MT-10px">
			<div class="width-20 text-left ">
				<div class="kotak_cek"><?php echo $req_type==1 ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
				<div class="text-kotak_cek"><b>PROJECT</b></div>
			</div>
			<div class="width-20 text-left ">
				<div class="kotak_cek"><?php echo $req_type==2 ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
				<div class="text-kotak_cek"><b>MODIFIKASI</b></div>
			</div>
			<div class="width-20 text-left ">
				<div class="kotak_cek"><?php echo $req_type==3 ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
				<div class="text-kotak_cek"><b>REVISI</b></div>
				<div class="text-priority_reason"><?php echo $ref_no; ?></div>
			</div>
		</div>
		
		<div class="width-100 ML-45px">
			<div class="width-100 MT-10px MB-1px">
				<div class="width-50 text-left MT-10px">
					<div class="kotak_cek"><?php echo $req_priority==1 ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek"><b>HIGH</b></div>
					<div class="text-priority_reason"><?php echo $req_priority==1 ? $req_priority_reason : "";?></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $req_priority==2 ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek"><b>MEDIUM</b></div>
					<div class="text-priority_reason"><?php echo $req_priority==2 ? $req_priority_reason : "";?></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $req_priority==3 ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek"><b>LOW</b></div>
					<div class="text-priority_reason"><?php echo $req_priority==3 ? $req_priority_reason : "";?></div>
				</div>
			</div>	
		</div>
		
		<div class="width-100 text-left MT-10px">
			<div class="width-100"><b>REASON : </b></div>
		</div>
		<div class="width-100 text-left MT-10px height-100px MB-5px">
			<div class="text-reason"><b><?php echo $req_reason; ?></b></div>
		</div>
		
		<div class="width-100 text-left MT-10px">
			<div class="width-100"><b>Check List Documentation *)</b></div>
		</div>
		<div class="width-100 ML-45px">
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $f_req_dev=="Y" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>Form Request dari IT Development</b></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $f_bisnis_proses=="Y" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>Bisnis Proses</b></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $f_regulasi=="Y" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>Regulasi</b></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $f_master_data=="Y" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>Data yang dipergunakan (Master Data)</b></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $f_fungsiUtamaApp=="Y" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>Fungsi Utama Aplikasi</b></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $f_karakteristik_pengguna=="Y" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>Karakteristik Pengguna (Modul Aplikasi)</b></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-70 text-left ">
					<div class="kotak_cek"><?php echo $f_prototype=="Y" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>Prototype dan User Interface (Antar Muka Pengguna)</b></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $f_RAS=="Y" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>Resiko Akibat Solusi</b></div>
				</div>
			</div>
			<div class="width-100 MB-1px MT-10px">
				<div class="width-50 text-left ">
					<div class="kotak_cek"><?php echo $f_UAT!="N/A" ? "<img src='".base_url()."images/icon/check.png' width=20 height=20>" : "&nbsp;"; ?></div>
					<div class="text-kotak_cek_document"><b>UAT</b></div>
				</div>
			</div>
		</div>
		<div class="width-100 text-left MT-10px ">
			<div class="width-100 text-12px"><b><i>*) Approve By IT Development it's a must</i></b></div>
		</div>
	</div>
</div>

<div class="width-100 MT-10px ML-15px MB-10px">
	<div class="width-23">
		<div class="width-100"><b>Request By</b></div>
		<div class="kotak_ttd">&nbsp;</div>
		<div class="width-100">
			<b>( <?php echo $req_by; ?> )</b>
		</div>
	</div>
	<div class="width-23">
		<div class="width-100"><b>Head Dept.</b></div>
		<div class="kotak_ttd">&nbsp;</div>
		<div class="width-100">
			<b>( <?php echo $req_by_mgr; ?> )</b>
		</div>
	</div>
	<div class="width-24-5">
		<div class="width-100"><b>Head Dept. IDD</b></div>
		<div class="kotak_ttd">&nbsp;</div>
		<div class="width-100">
			<b>( <?php echo $PIC_mgr; ?> )</b>
		</div>
	</div>
	<div class="width-24-5">
		<div class="width-100"><b>DIREKSI</b></div>
		<div class="kotak_ttd">&nbsp;</div>
		<div class="width-100 ML-15px">
			<b>
			<div class="width-2">(</div>
				<div class="width-96">&nbsp;</div>
			<div class="width-2">)</div>
			</b>
		</div>
	</div>
</div>

<div class="width-100 MB-10px PL-15px">
	<div class="width-100 text-left MT-10px">
		<div class="width-100"><b>Note : </b></div>
	</div>
	<div class="width-100 text-left MT-10px height-100px MB-5px">
		<div class="text-reason"><b><?php echo $req_note; ?></b></div>
	</div>
</div>