$(document).ready(function(){
	$(".ttip").tooltip();
	$(".dtpicker").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true
	});
});

function count_length(x)
{
	var m = document.getElementById(x).value.length;
	var d = 400;
	var n = d - m;
	$(document).ready(function(){
		$("#"+x+"_char_left").val(n);
	});
}

function checkFile(valFile,idFile)
{
	var ext=/\b(zip|rar|doc|docx|xls|xlsx|pdf|jpeg|jpg|png|PNG|txt|oft|OFT|msg|MSG)/g;
	var x = valFile;
	var spl = x.split(".");
	if (spl[1].match(ext)!=null)
	{
		
	}
	else
	{
		alert("extension '."+spl[1]+"' not allowed");
		document.getElementById(''+idFile).value = "";
	}
}

function follow_up_waiting_done()
{
	$(document).ready(function(){
		var status = $("#req_status").val();
		var type = $("#modal_req_type_no").val();
		if (status==1)
		{
			if (type!=3) // project || revisi
			{
				$("#col_file_uat").show(400);
				$("#f_uat").attr("required","");
				window.location.hash = "#col_file_uat";
			}
			else
			{
				$("#col_file_uat").hide(400);
				$("#f_uat").removeAttr("required");
			}
			
			$("#col_status_reason").hide(400);
			$("#req_status_reason").removeAttr("required");
		}
		else
		{
			$("#col_file_uat").hide(400);
			$("#f_uat").removeAttr("required");
			$("#col_status_reason").show(400);
			$("#req_status_reason").attr("required","");
			window.location.hash = "#req_status_reason";
		}
	});
}

function check_ref_no()
{
	$(document).ready(function(){
		var p_ref_no = $("#req_ref_no").val();
		var string_data = "ref_no="+p_ref_no;
		$.ajax({
			type: "POST",
			url: url_ifexist_ref_no,
			data: string_data,
			success: function(result){
				if (result>0)
				{
					$("#req_ref_no").select();
					$("#req_ref_no").focus();
					$("#exist_ref_no").html("No ref "+p_ref_no+" sudah pernah digunakan");
					$("#exist_ref_no").show('slow');
					$(".btn-success").hide('slow');
				}
				else
				{
					$("#exist_ref_no").html("");
					$("#exist_ref_no").hide('slow');
					$(".btn-success").show('slow');
				}
			}
		});
	});
}

function print_request(req_no)
{
	$(document).ready(function(){
		var p_req_no = req_no;
			$().redirect(url_print, {
				'req_no': p_req_no
			});
	});
}

function print_report_request()
{
	$(document).ready(function(){
		var p_date_from = $("#date_from").val();
		var p_date_thru = $("#date_thru").val();
		var p_req_type = $("#req_type").val();
		var p_req_category = $("#req_category").val();
		$().redirect(url_print_report, {
			'date_from': p_date_from,
			'date_thru': p_date_thru,
			'req_type': p_req_type,
			'req_category': p_req_category
		});
	});
}