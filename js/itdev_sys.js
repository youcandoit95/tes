/* START NOTIFICATION */

$(document).ready(function(){
    var new_request = setInterval(function(){        
		var post = "cek=yo";
		$.ajax({
				 type:"POST",
				 data:post,
		  		 url:url_new_request,
		  		 success:function(result){
					if (result>0)
					{
						$("#incoming_new_request").html(result);
						$("#incoming_new_request").show(800);
					}
					else
					{
						$("#incoming_new_request").html("0");
						$("#incoming_new_request").hide(800);
					}
				 }
			});
		
		return false;
    }, 50000);
	
	var cancel_request = setInterval(function(){
		var post = "cek=yo";
		$.ajax({
			type: "POST",
			dara: post,
			url: url_cancel_request,
			success: function(result){
				if (result>0)
				{
					$("#notif_cancel_request").html(result);
					$("#notif_cancel_request").show(800);
				}
				else
				{
					$("#notif_cancel_request").html("0");
					$("#notif_cancel_request").hide(800);
				}
			}
		});
	},50000);
	
	var revision_request = setInterval(function(){
		var post = "cek=yo";
		$.ajax({
			type: "POST",
			dara: post,
			url: url_revision_request,
			success: function(result){
				if (result>0)
				{
					$("#notif_revision_request").html(result);
					$("#notif_revision_request").show(800);
				}
				else
				{
					$("#notif_revision_request").html("0");
					$("#notif_revision_request").hide(800);
				}
			}
		});
	},50000);
	
	var done_request = setInterval(function(){
		var post = "cek=yo";
		$.ajax({
			type: "POST",
			dara: post,
			url: url_done_request,
			success: function(result){
				if (result>0)
				{
					$("#notif_done_request").html(result);
					$("#notif_done_request").show(800);
				}
				else
				{
					$("#notif_done_request").html("0");
					$("#notif_done_request").hide(800);
				}
			}
		});
	},50000);
	
	var on_process = setInterval(function(){        
		var post = "cek=yo"
		$.ajax({
				 type:"POST",
				 data:post,
		  		 url:url_on_process_request,
		  		 success:function(result){
					if (result>0)
					{
						$("#notification_on_process").html(result);
						$("#notification_on_process").show(800);
					}
					else
					{
						$("#notification_on_process").html("0");
						$("#notification_on_process").hide(800);
					}
				 }
			});
		
		return false;
    }, 50000);
	
	var waiting_done_confirmation = setInterval(function(){        
		var post = "cek=yo"
		$.ajax({
				 type:"POST",
				 data:post,
		  		 url:url_waiting_done_confirmation,
		  		 success:function(result){
					if (result>0)
					{
						$("#notification_waiting_done").html(result);
						$("#notification_waiting_done").show(800);
					}
					else
					{
						$("#notification_waiting_done").html("0");
						$("#notification_waiting_done").hide(800);
					}
				 }
			});
		
		return false;
    }, 50000);
	
	var hold_request = setInterval(function(){        
		var post = "cek=yo"
		$.ajax({
				 type:"POST",
				 data:post,
		  		 url:url_hold_request,
		  		 success:function(result){
					if (result>0)
					{
						$("#notification_hold").html(result);
						$("#notification_hold").show(800);
					}
					else
					{
						$("#notification_hold").html("0");
						$("#notification_hold").hide(800);
					}
				 }
			});
		
		return false;
    }, 50000);
});

/* END NOTIFICATION */

function print_report_request()
{
	$(document).ready(function(){
		var p_date_from = $("#date_from").val();
		var p_date_thru = $("#date_thru").val();
		var p_req_type = $("#req_type").val();
		var p_req_category = $("#req_category").val();
		var p_req_by = $("#req_by").val();
		var p_req_pic = $("#req_pic").val();
		$().redirect(url_print_report, {
			'date_from': p_date_from,
			'date_thru': p_date_thru,
			'req_type': p_req_type,
			'req_category': p_req_category,
			'req_by': p_req_by,
			'req_pic': p_req_pic
		});
	});
}

function check_ref_no()
{
	$(document).ready(function(){
		var p_ref_no = $("#req_ref_no").val();
		var string_data = "ref_no="+p_ref_no;
		$("#ajax_ref_no").html("Checking...");
		$.ajax({
			type: "POST",
			url: url_ifexist_ref_no,
			data: string_data,
			success: function(result){
				if (result>0)
				{
					$("#req_ref_no").select();
					$("#req_ref_no").focus();
					$("#text_alert_warning").html("No ref "+p_ref_no+" sudah pernah digunakan");
					$("#alert_warning").show('slow');
					$("#btn_submit_form").hide('slow');
					$("#ajax_ref_no").html("");
				}
				else
				{
					$("#text_alert_warning").html("");
					$("#alert_warning").hide('slow');
					$("#btn_submit_form").show('slow');
					$("#ajax_ref_no").html("");
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

function modal_request_detail(req_no)
{
	$(document).ready(function(){
		var p_req_no = req_no;
		var p_menu_active = $("#p_menu_active").val();
		var p_view_content = $("#p_view_content").val();
			$().redirect_pageself(url_detail_request, {
				'req_no': p_req_no,
				'menu_active': p_menu_active,
				'view_content': p_view_content
			});
	});
}

function modal_request_detail_uh(req_no)
{
	$(document).ready(function(){
		var p_req_no = req_no;
		var p_menu_active = $("#p_menu_active").val();
		var p_view_content = $("#p_view_content").val();
			$().redirect_pageself(url_detail_request_uh, {
				'req_no': p_req_no,
				'menu_active': p_menu_active,
				'view_content': p_view_content
			});
	});
}

function modal_request_detail_follow_up(req_no)
{
	$(document).ready(function(){
		var p_req_no = req_no;
		var p_menu_active = $("#p_menu_active").val();
		var p_view_content = $("#p_view_content").val();
		var p_view_sub_content = $("#p_view_sub_content").val();
			$().redirect_pageself(url_detail_request, {
				'req_no': p_req_no,
				'menu_active': p_menu_active,
				'view_content': p_view_content,
				'view_sub_content': p_view_sub_content
			});
	});
}

function modal_request_detail_follow_up_uh(req_no)
{
	$(document).ready(function(){
		var p_req_no = req_no;
		var p_menu_active = $("#p_menu_active").val();
		var p_view_content = $("#p_view_content").val();
		var p_view_sub_content = $("#p_view_sub_content").val();
			$().redirect_pageself(url_detail_request_uh, {
				'req_no': p_req_no,
				'menu_active': p_menu_active,
				'view_content': p_view_content,
				'view_sub_content': p_view_sub_content
			});
	});
}

function follow_up_on_process()
{
	$(document).ready(function(){
		var status = $("#req_status").val();
		if (status==1)
		{
			$(".col_status_reason").show(400);
			$("#req_status_reason").removeAttr("required");
		}
		else
		{
			$(".col_status_reason").show(400);
			$("#req_status_reason").attr("required","");
		}
	});
}

function follow_up_hold()
{	
	$(document).ready(function(){
		var status = $("#req_status").val();
		if (status==1)
		{
			$("#con_req_est_time").hide(400);
			$("#req_est_time").removeAttr("required");
			$(".col_status_reason").show(400);
			$("#req_status_reason").removeAttr("required");
		}
		else if (status==4)
		{
			$("#con_req_est_time").show(400);
			$("#req_est_time").attr("required","");
			$(".col_status_reason").hide(400);
			$("#req_status_reason").removeAttr("required");
		}
		else
		{
			$("#con_req_est_time").hide(400);
			$("#req_est_time").removeAttr("required");
			$(".col_status_reason").hide(400);
			$("#req_status_reason").removeAttr("required");
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

function follow_up_waiting_done()
{
	$(document).ready(function(){
		var status = $("#req_status").val();
		var type = $("#req_type_no").val();
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
			
			$(".col_status_reason").hide(400);
			$("#req_status_reason").removeAttr("required");
		}
		else
		{
			$("#col_file_uat").hide(400);
			$("#f_uat").removeAttr("required");
			$(".col_status_reason").show(400);
			$("#req_status_reason").attr("required","");
			window.location.hash = "#req_status_reason";
		}
	});
}