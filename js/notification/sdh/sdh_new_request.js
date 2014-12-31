$(document).ready(function(){
    var new_request = setInterval(function(){        
		var post = "cek=yo"
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