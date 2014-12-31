function openFAD()
{
	$(document).ready(function(){
		$("#GO_FAD").hide('medium');
		$("#FAD_RT").show('medium');
	});
}

function closeFAD()
{
	$(document).ready(function(){
		$("#GO_FAD").show('medium');
		$("#FAD_RT").hide('medium');
	});
}

function closeFED()
{
	$(document).ready(function(){
		$("#FED_RT_id").val('');
		$("#FED_RT_name").val('');
		$("#errorFrm").hide(900);
		$("#FED_RT").fadeOut(900);
		$("#GO_FAD").show('slow');	
	});
}

for (var yy=1; yy<=4; yy++)
{
	openFED('GO_FED_'+yy, 'data_record_'+yy);
	DELrecord('GO_DEL_'+yy, 'data_record_'+yy, 'data_row_'+yy, 'data_delete_name_'+yy);
	ACTdata('GO_ACTV_'+yy, 'data_record_'+yy)
}

function ACTdata(btn,rcd)
{	
	$(document).ready(function(){
		$("#"+btn).click(function(){
			var id = $("#"+rcd).val();
			var post = "a="+id;
			$.ajax({
				type:"POST",
				url:url_ACT+'/'+id,
				data:post,
				success:function(result){
					var res = result;
					if (res=="Y")
					{
						$("#"+btn).html("<img src='../../images/icon/true.png'>");
						$(".loader").fadeOut('slow');
					}
					else if (res=="N")
					{
						$("#"+btn).html("<img src='../../images/icon/false.png'>");
						$(".loader").fadeOut('slow');
					}
				}
			});
		});
	});
}

function DELrecord(btn,rcd,row,n)
{
	$(document).ready(function(){
		$("#"+btn).click(function(){
			var d=confirm("Are you sure want to continue ?");
			if (d==true)
			{
				var x = $("#"+rcd).val();
				var post = "DEL_id="+x;
				var nm = $("#"+n).val();
				
				$.ajax({
					type:"POST",
					url:url_DEL,
					data:post,
					success:function(result){
						var r = result;
						if (r=="1")
						{
							$("#RT_deleted").html(''+nm)
							$("#"+row).hide(800);
							$("#successFrm").hide(800);
							$("#FED_RT").hide(800);
							$("#DEL").show(800);
							$(".loader").fadeOut('slow');
						}
					},
					error:function(){
						$("#nameErrorDel").html(''+nm)
							$("#successFrm").hide(800);
							$("#FED_RT").hide(800);
							$("#errorDel").show(800);
							$(".loader").fadeOut('slow');
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
			var x = $("#"+rcd).val();
			var post = "FED_ID="+x;
			
			$.ajax({
				type: "POST",
				url:url_FED,
				data:post,
				success:function(result){
					var res = result;
					var r = res.split(";");
					$("#FED_RT_id").val(r[0]);
					$("#FED_RT_name_now").html(r[1]);
					$("#FED_RT_name_compare").val(r[1]);
					$("#FED_RT_name").val(r[1]);
					$("#GO_FAD").hide('slow');
					$("#FAD_RT").fadeOut(400);
					$("#FED_RT").fadeIn(900);
					$(".loader").fadeOut('slow');
				}
			});
		});
	});
}