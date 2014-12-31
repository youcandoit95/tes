function openFAD()
{
	$(document).ready(function(){
		$("#successFrm").hide('slow');
		$("#GO_FAD").hide('slow');
		$("#FAD").show('slow');
	});
}

function closeFAD()
{
	$(document).ready(function(){
		$("#GO_FAD").show('slow');
		$("#FAD").hide('slow');
		$("#errorFrm").hide('slow');
	});
}

function closeFED()
{
	
}

for (var yy=1; yy<=30; yy++)
{
	DELrcd('GO_DEL_'+yy, 'data_record_'+yy, 'data_row_'+yy, 'data_delete_name_'+yy);
	ACTrcd('GO_ACTV_'+yy, 'data_record_'+yy);
}

function ACTrcd(btn,rcd)
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

function DELrcd(btn,rcd,row,nm)
{
	$(document).ready(function(){
		$("#"+btn).click(function(){
			var d=confirm("Are you sure want to continue ?");
			if (d==true)
			{
				var id = $("#"+rcd).val();
				var post = "FED_id="+id;
				var n = $("#"+nm).val();
				
				$.ajax({
					type:"POST",
					url:url_DEL,
					data:post,
					success:function(result){
						var res = result;
						if (res=="1")
						{
							$("#data_deleted").html(''+n)
								$("#"+row).hide(800);
								$("#successFrm").hide(800);
								$("#FED").hide(800);
								$("#DEL").show(800);
								$(".loader").fadeOut('slow');
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