$(document).ready(function(){
    var new_request = setInterval(function(){        
		var post = "cek=yo"
		$.ajax({
				 type:"POST",
				 data:post,
		  		 url:url_on_process_request,
		  		 success:function(result){
					if (result>0)
					{
						$("#notification_on_process").html(result);
						$("#notification_on_process").fadeIn(800);
					}
					else
					{
						$("#notification_on_process").html("0");
						$("#notification_on_process").fadeOut(800);
					}
				 }
			});
		
		return false;
    }, 70000);
	
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
						$("#notification_waiting_done").fadeIn(800);
					}
					else
					{
						$("#notification_waiting_done").html("0");
						$("#notification_waiting_done").fadeOut(800);
					}
				 }
			});
		
		return false;
    }, 70000);
	
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
						$("#notification_hold").fadeIn(800);
					}
					else
					{
						$("#notification_hold").html("0");
						$("#notification_hold").fadeOut(800);
					}
				 }
			});
		
		return false;
    }, 70000);
});

function modal_request_detail(req_no)
{
	var post="req_no="+req_no;
	$(document).ready(function(){
		$.ajax({
			type:"POST",
			data:post,
			dataType:"json",
			url:url_modal_detail_request,
			success:function(data){
				$("#req_no").val(data.REQ_NO.replace(/_/g,"/"));
				$("#modal_req_no").html(data.REQ_NO.replace(/_/g,"/"));
				$("#modal_req_name").html(data.REQ_NAME);
				$("#modal_req_type").html(data.TYPE_NAME);
				$("#modal_req_category").html(data.CATEGORY_NAME);
				$("#modal_req_ref_no").html(data.REF_NO);
				$("#modal_req_priority").html(data.PRIORITY_NAME);
				$("#modal_req_priority_reason").html(data.PRIORITY_REASON);
				$("#modal_req_PIC").html(data.PIC_FNAME);
				$("#modal_req_est_time").html(data.REQ_EST_TIME);
				$("#modal_req_reason").html(data.REQ_REASON);
				$("#modal_req_note").html(data.REQ_NOTE);
			}
		});
		$("#Modal_FTR").modal("show");
	});
}

function modal_request_detail_wd(req_no)
{
	var post="req_no="+req_no;
	$(document).ready(function(){
		$.ajax({
			type:"POST",
			data:post,
			dataType:"json",
			url:url_modal_detail_request,
			success:function(data){
				$("#req_no").val(data.REQ_NO.replace(/_/g,"/"));
				$("#modal_req_no").html(data.REQ_NO.replace(/_/g,"/"));
				$("#modal_req_name").html(data.REQ_NAME);
				$("#modal_req_type_no").val(data.TYPE_NO);
				$("#modal_req_type").html(data.TYPE_NAME);
				$("#modal_req_category").html(data.CATEGORY_NAME);
				$("#modal_req_ref_no").html(data.REF_NO);
				$("#modal_req_PIC").html(data.PIC_FNAME);
				$("#modal_req_est_time").html(data.REQ_EST_TIME);
				$("#modal_req_reason").html(data.REQ_REASON);
				$("#modal_req_note").html(data.REQ_NOTE);
			}
		});
		$("#Modal_FTR").modal("show");
	});
}