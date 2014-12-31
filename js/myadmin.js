$(document).ready(function(){
	$(".ttip").tooltip();
	$(".datepicker").datepicker({dateFormat : 'dd-mm-yy'});
	$(".datepicker").keydown(function(k){
		if (k.keyCode!=9)
		{
			return false;
		}
	});
	$('.datetimepicker').datetimepicker({
		dateFormat: 'dd-mm-yy',
		timeFormat: "HH:mm:ss"
	});
});

$(document).ready(function() {
	$('sup').tooltip();
	$('input.act').tooltip();
	$('button.act').tooltip();
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

function follow_up_on_process()
{
	$(document).ready(function(){
		var status = $("#req_status").val();
		if (status==1)
		{
			$(".col_status_reason").hide(400);
			$("#req_status_reason").removeAttr("required");
		}
		else
		{
			$(".col_status_reason").show(400);
			$("#req_status_reason").attr("required","");
		}
	});
}

function follow_up_revision()
{
	$(document).ready(function(){
		var status = $("#req_status").val();
		if (status==1)
		{
			$("#con_req_est_time").hide(400);
			$("#req_est_time").removeAttr("required");
		}
		else
		{
			$("#con_req_est_time").show(400);
			$("#req_est_time").attr("required","");
		}
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
		var p_req_pic = $("#req_pic").val();
		$().redirect(url_print_report, {
			'date_from': p_date_from,
			'date_thru': p_date_thru,
			'req_type': p_req_type,
			'req_category': p_req_category,
			'req_pic': p_req_pic
		});
	});
}