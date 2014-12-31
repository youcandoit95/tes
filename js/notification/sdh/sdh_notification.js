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
						$("#incoming_new_request").fadeIn(800);
					}
					else
					{
						$("#incoming_new_request").html("0");
						$("#incoming_new_request").fadeOut(800);
					}
				 }
			});
		
		return false;
    }, 70000);
	
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
					$("#notif_cancel_request").fadeIn(800);
				}
				else
				{
					$("#notif_cancel_request").html("0");
					$("#notif_cancel_request").fadeOut(800);
				}
			}
		});
	},70000);
	
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
					$("#notif_revision_request").fadeIn(800);
				}
				else
				{
					$("#notif_revision_request").html("0");
					$("#notif_revision_request").fadeOut(800);
				}
			}
		});
	},70000);
	
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
					$("#notif_done_request").fadeIn(800);
				}
				else
				{
					$("#notif_done_request").html("0");
					$("#notif_done_request").fadeOut(800);
				}
			}
		});
	},70000);
});

function openMdl(req_no)
{
	var post="req_no="+req_no;
	$(document).ready(function(){
		$.ajax({
			type:"POST",
			data:post,
			dataType:"json",
			url:url_modal_detail_request,
			success:function(data){
				$("#take_req_no").val(data.REQ_NO.replace(/_/g,"/"));
				$("#modal_req_no").html(data.REQ_NO.replace(/_/g,"/"));
				$("#modal_req_name").html(data.REQ_NAME);
				$("#modal_req_type").html(data.TYPE_NAME);
				$("#modal_req_category").html(data.CATEGORY_NAME);
				$("#modal_req_ref_no").html(data.REF_NO);
				$("#modal_req_reason").html(data.REQ_REASON);
				$("#modal_req_note").html(data.REQ_NOTE);
			}
		});
		$("#Modal_FTR").modal("show");
	});
}

function openMdlRev(req_no)
{
	var post="req_no="+req_no;
	$(document).ready(function(){
		$.ajax({
			type:"POST",
			data:post,
			dataType:"json",
			url:url_modal_detail_request,
			success:function(data){
				$("#take_req_no").val(data.REQ_NO.replace(/_/g,"/"));
				$("#modal_req_no").html(data.REQ_NO.replace(/_/g,"/"));
				$("#modal_req_name").html(data.REQ_NAME);
				$("#modal_req_type").html(data.TYPE_NAME);
				$("#modal_req_category").html(data.CATEGORY_NAME);
				$("#modal_req_ref_no").html(data.REF_NO);
				$("#modal_req_priority").html(data.PRIORITY_NAME);
				$("#modal_req_priority_reason").html(data.PRIORITY_REASON);
				$("#modal_req_reason").html(data.REQ_REASON);
				$("#modal_req_note").html(data.REQ_NOTE);
				$("#modal_req_status").html(data.STATUS);
				$("#modal_req_status_reason").html(data.STATUS_REASON);
			}
		});
		$("#Modal_FTR").modal("show");
	});
}

function modal_request_detail(req_no)
{
	var post="req_no="+req_no;
	$(document).ready(function(){
		$.ajax({
			type:"POST",
			data:post,
			dataType:"json",
			url:url_detail_request,
			success:function(data){
				$("#modal_req_no").html(data.REQ_NO);
				$("#modal_req_name").html(data.REQ_NAME);
				$("#modal_req_by").html(data.REQ_BY_USERID);
				$("#modal_req_type").html(data.TYPE_NAME);
				$("#modal_req_category").html(data.CATEGORY_NAME);
				$("#modal_req_ref_no").html(data.REF_NO);
				$("#modal_req_priority").html(data.PRIORITY_NAME);
				$("#modal_req_priority_reason").html(data.PRIORITY_REASON);
				$("#modal_req_created").html(data.REQ_CREATED);
				$("#modal_req_PIC").html(data.REQ_PIC_USERID);
				$("#modal_req_status").html(data.STATUS_NAME);
				$("#modal_req_status_reason").html(data.REQ_LSTATUS_REASON);
				$("#modal_req_status_created").html(data.REQ_LUPDATED);
				$("#modal_req_est_time").html(data.REQ_EST_TIME);
				$("#modal_req_reason").html(data.REQ_REASON);
				$("#modal_req_note").html(data.REQ_NOTE);
			}
		});
		$("#Modal_FTR").modal("show");
	});
}