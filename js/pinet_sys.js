/* ========= BEGIN HCIS ===========*/
 
	function absent_punch_in(x)
	{
		if (p_do_absent==1)
		{
			var v_hour = get_time_now("h");
			var v_minutes = get_time_now("m");
			
			// var v_hour = "8";
			// var v_minutes = get_time_now("m");
			
			if (v_hour >= 9)
			{
				if (v_hour == 9)
				{
					if (v_minutes > 30)
					{
						open_punch_in_late();
					}
				}
				else
				{
					open_punch_in_late();
				}
			}
			else
			{
				punch_in();
			}
		}
	}

	function punch_in()
	{
		$().redirect_pageself(url_punch_in, {
		
		});
	}

	function open_punch_in_late()
	{
		$("#po_early").hide();
		$("#pi_late").show('slow');
		$("#pi_late_reason").focus();
	}

	function absent_punch_out(x)
	{
		if (p_do_absent==1)
		{
			var v_hour = get_time_now("h");
			var v_minutes = get_time_now("m");
			
			// var v_hour = "8";
			// var v_minutes = get_time_now("m");
			
			if (v_hour < 18)
			{
				open_punch_out();
			}
			else
			{
				punch_out();
			}
		}
	}
	
	function punch_out()
	{
		$().redirect_pageself(url_punch_out, {
		
		});
	}

	function open_punch_out()
	{
		$("#pi_late").hide();
		$("#po_early").show('slow');
		//$("#po_early_reason").focus();
	}
	
	function approve_po_early(x)
	{
		var xsplit = x.split("_");
		var p_absen_no = xsplit[1];
		$().redirect_pageself(url_approve_po_early, {
			'p_absen_no': p_absen_no
		});
	}
	
	function reject_po_early(x)
	{
		var xsplit = x.split("_");
		var data_po_early = xsplit[1];
		
		var ysplit = data_po_early.split("+");
		var p_absen_no = ysplit[0];
		var karyawan_nik = ysplit[1];
		var karyawan_fullname = ysplit[2];
		var absen_punch_out_time = ysplit[3];
		var po_early_reason = ysplit[4];
		
		$("#p_absen_no").val(p_absen_no);
		
		$("#rpoe_karyawan_nik").html(karyawan_nik);
		$("#rpoe_karyawan_fname").html(karyawan_fullname);
		$("#rpoe_po_time").html(absen_punch_out_time);
		$("#rpoe_po_reason").html(po_early_reason);
		
		$('#modal_reject_po_early').modal('toggle');
		$('#modal_reject_po_early').modal('show');
	}
	
	function data_karyawan_mdl_md_cuti(x)
	{
		//$(document).ready(function(){
			var datapost = "nik="+x;
			$.ajax({
				type: "POST",
				url: url_ajax_data_karyawan,
				data: datapost,
				dataType: "json",
				success: function(result){
					$("#txt_jabatan").val(result.karyawan_jabatan_name);
					$("#txt_division").val(result.karyawan_div_name);
					$("#txt_dept").val(result.karyawan_dept_name);
					$("#txt_bagian").val(result.karyawan_bagian_name);
					$("#txt_nama_lengkap").val(result.karyawan_fullname);
				}
			});
		//});
	}
	
	function open_edit_md_cuti(x)
	{
		var xsplit = x.split(":");
		var mcuti_no = xsplit[0];
		var jumlah_cuti_now = xsplit[1];
		var karyawan_nik = xsplit[2];
		
		$("#mcuti_no").val(mcuti_no);
		$("#txt_jumlah_cuti_ubah").val(jumlah_cuti_now);
		$("#karyawan_nik").val(karyawan_nik);
		
		$('#modal_edit_md_cuti').modal('toggle');
		$('#modal_edit_md_cuti').modal('show');
	}

	function cek_cuti_mencukupi()
	{
		var date1 = $("#date_from").val().split("-");
		date1 = new Date(date1[2], date1[1] - 1, date1[0]);
		var date2 = $("#date_thru").val().split("-");
		date2 = new Date(date2[2], date2[1] - 1, date2[0]);
		
		var date_diff = Math.abs(date2.getTime() - date1.getTime())/86400000;
		var available_cuti = $("#available_cuti").val();
		$("#lama_cuti").val(date_diff);
		
		if (date_diff > available_cuti)
		{
			$("#txt_error_tidak_cukup").fadeIn('slow');
			location.hash = "#txt_error_tidak_cukup";
			return false;
		}
		else
		{
			$("#txt_error_tidak_cukup").hide('slow');
			var conf = confirm('Apakah anda yakin ?');
			if (conf==true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function give_value_cuti(x)
	{
		if (x=="" || x==null)
		{
			$("#date_from").val("");
			document.getElementById("date_from").disabled = true;
			$("#date_thru").val("");
			document.getElementById("date_thru").disabled = true;
			$("#cmb_periode_cuti").focus();
		}
		else
		{
			var xsplit = x.split(":");
			$("#available_cuti").val(xsplit[2]);
			document.getElementById("date_from").disabled = false;
			document.getElementById("date_thru").disabled = false;
		}
	}
	
	function cancel_cuti(x)
	{
		var conf = confirm('Apakah anda yakin ?');
		if (conf==true)
		{
			$().redirect_pageself(url_cancel_cuti, {
				'rcuti_no': x
			});
		}
		else
		{
			return false;
		}
	}
	
	function reject_cuti(x)
	{
		var xsplit = x.split("_");
		var data = xsplit[1];
		
		var ysplit = data.split("+");
		var rcuti_no = ysplit[0];
		var karyawan_nik = ysplit[1];
		var karyawan_fullname = ysplit[2];
		var mcuti_period_year = ysplit[3];
		var rcuti_lama_hari = ysplit[4];
		var rcuti_date_from = ysplit[5];
		var rcuti_date_thru = ysplit[6];
		var rcuti_created_date = ysplit[7];
		var rj_approval_up_level = ysplit[8];
		var rj_approval_up_level_reason = ysplit[9];
		var rj_approval_up_level_date = ysplit[10];
		var rj_approval_hrd = ysplit[11];
		var rj_approval_hrd_reason = ysplit[12];
		var rj_approval_hrd_date = ysplit[13];
		
		$("#rcuti_no").val(rcuti_no);
		
		$("#rj_karyawan_nik").html(karyawan_nik+" - "+karyawan_fullname);
		$("#rj_periode_cuti").html(mcuti_period_year);
		$("#rj_lama_cuti").html(rcuti_lama_hari+" Hari");
		$("#rj_tgl_cuti").html(rcuti_date_from+" s/d "+rcuti_date_thru);
		$("#rj_tgl_pengajuan").html(rcuti_created_date);
		$("#rj_approval_up_level").html(rj_approval_up_level);
		$("#rj_approval_up_level_reason").html(rj_approval_up_level_reason);
		$("#rj_approval_up_level_date").html(rj_approval_up_level_date);
		$("#rj_approval_hrd").html(rj_approval_hrd);
		$("#rj_approval_hrd_reason").html(rj_approval_hrd_reason);
		$("#rj_approval_hrd_date").html(rj_approval_hrd_date);
		
		$('#modal_reject_cuti').modal('toggle');
		$('#modal_reject_cuti').modal('show');
	}
	
	function approve_cuti(x)
	{
		var xsplit = x.split("_");
		var rcuti_no = xsplit[1];
		var mcuti_no = xsplit[2];
		$().redirect_pageself(url_approve_cuti, {
			'rcuti_no': rcuti_no,
			'mcuti_no': mcuti_no
		});
	}
	
	function cancel_lembur(x)
	{
		var conf = confirm('Apakah anda yakin ?');
		if (conf==true)
		{
			$().redirect_pageself(url_cancel_lembur, {
				'lembur_no': x
			});
		}
		else
		{
			return false;
		}
	}
/* ========= END HCIS ===========*/