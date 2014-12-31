function openFAD()
{
	$(document).ready(function(){
		$("#GO_FAD").hide('slow');	
		$("#FAD_dept").show('slow');	
	});
}

function closeFAD()
{
	$(document).ready(function(){
		$("#new_dept_name").val("");
		$("#GO_FAD").show('slow');	
		$("#FAD_dept").hide('slow');	
	});
}

function closeFED()
{
	$(document).ready(function(){
		$("#FED_dept_id").val('');
		$("#FED_dept_name").val('');
		$("#errorFrm").hide(900);
		$("#FED").fadeOut(900);
		$("#GO_FAD").show('slow');	
	});
}

for (var ke=1; ke<=100; ke++)
{
	openFED('GO_FED_'+ke, 'data_record_'+ke);
	DELrecord('GO_DEL_'+ke, 'data_row_'+ke, 'data_record_'+ke, 'data_delete_name_'+ke);
	ACTVrecord('GO_ACTV_'+ke, 'data_record_'+ke);
}

function ACTVrecord(btn,rcd)
{
	$(document).ready(function(){
		$("#"+btn).click(function(){
			var id = $("#"+rcd).val();
			var post = "a="+id;
			$.ajax({
				type:"POST",
				url:url_ACTV+'/'+id,
				data:post,
				success:function(result){
					var r = result;
					if (r=="N")
					{
						$("#"+btn).html("<img src='"+base_url+"/images/icon/false.png'>");
						$(".loader").fadeOut(800);
					}
					else if (r=="Y")
					{
						$("#"+btn).html("<img src='"+base_url+"images/icon/true.png'>");
						$(".loader").fadeOut(800);
					}
				}
			});
		});
	});
}

function DELrecord(btn,r,rcd,n)
{
	$(document).ready(function(){
		$("#"+btn).click(function(){
			var d=confirm("Are you sure want to continue ?");
			if (d==true)
			{
				var id = $("#"+rcd).val();
				var post = "DEL_id="+id;
				var nm = $("#"+n).val();
				
				$.ajax({
					type:"POST",
					url:url_DEL,
					data:post,
					success:function(result){
						var res = result;
						if (res==1)
						{
							$("#dept_deleted").html(''+nm)
							$("#"+r).hide(800);
							$("#successFrm").hide(800);
							$("#FED").hide(800);
							$("#deleteDept").show(800);
							$(".loader").hide('slow');
						}
						else
						{
							$("#txt_error_ajax").html("This item is being used , you can't delete it");
							$("#error_ajax").show(800);
						}
					}
				});
			}
			else
			{
				return false;
			}
		});
	});
}

function openFED(btn,rcd)
{
	$(document).ready(function(){
		$("#"+btn).click(function(){
			var id = $("#"+rcd).val();
			var post = "FED_id="+id;
			
			$.ajax({
				type:"POST",
				dataType: "json",
				url:url_FED,
				data:post,
				success:function(data){					
					$("#fed_reqType_no").val(data.TYPE_NO);
					$("#fed_reqType_name").val(data.TYPE_NAME);
					$("#FAD_dept").hide('slow');
					$("#GO_FAD").hide('slow');
					$("#FAD").show(400);
					$("#FED").show(900);
				}
			});
		});
	});
}