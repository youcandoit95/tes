$(document).ready(function(){
	$("#recent_generate").click(function(){
		$("#div_new_generate").hide(700);
		$("#div_recent_generate").show(1000);
		$("#result_generate").show(1000);
	});
	
	$("#FTR").dialog({
		autoOpen: false,
		modal: true,
		width: 535
	});
	
	$("#new_generate").click(function(){
		$("#div_recent_generate").hide(700);
		$("#result_generate").hide(700);
		$("#div_new_generate").show(1000);
	});

	$("#FAD_UR_type").change(function(){
		var based = $("#FAD_UR_based").val();
		var type = $("#FAD_UR_type").val();
		var RC = $("#FAD_UR_case").val();
		var post = "based="+based+"&type="+type;
		if (based!="choose" && type!="choose")
		{
			$("#FAD_UR_case").fadeOut();
			$.ajax({
				type:"POST",
				url:url_RC,
				data:post,
				success:function(result){
					var res = result;
					$("#FAD_UR_case").html(""+res);
					$("#FAD_UR_case").fadeIn();
				}
			});
		}
		else
		{
			$("#FAD_UR_case").fadeOut();
			$("#FAD_UR_case").html('<option value="">Choose</option>');
			$("#FAD_UR_case").fadeIn();
		}
	});
});

$(document).ready(function(){
	$("#FAD_UR_based").change(function(){
		var type2 = $("#FAD_UR_type").val();
		var based2 = $("#FAD_UR_based").val();
		if (type2!="choose" && based2!="choose")
		{
			var post2 = "based="+based2+"&type="+type2;
			$("#FAD_UR_case").fadeOut();
			$.ajax({
				type:"POST",
				url:url_RC,
				data:post2,
				success:function(result){
					var res = result;
					$("#FAD_UR_case").html(""+res);
					$("#FAD_UR_case").fadeIn();
				}
			});
		}
		else
		{
			$("#FAD_UR_case").fadeOut();
			$("#FAD_UR_case").html('<option value="">Choose</option>');
			$("#FAD_UR_case").fadeIn();
		}
	});
});

function show_RM()
{
	$(document).ready(function(){
		var RB = $("#FAD_UR_based").val();
		var RT = $("#FAD_UR_type").val();
		var RC = $("#FAD_UR_case").val();
		var RM = $("#FAD_UR_modul").val();
		if (RB!="choose" && RT!="choose" && RC!="choose")
		{
			$("#FAD_TXT_Modul").fadeIn(800);
			$("#FAD_TXT_desc").fadeIn(800);
			$("#FAD_TXT_reason").fadeIn(800);
			$(".step3_req").fadeIn(800);
			if (RT == 2)
			{
				document.getElementById("file_maintenance").removeAttribute("required");
				$(".file_project").attr("required","required");
				$("#tbl_docSupport_maintenance").hide();
				$("#tbl_docSupport_dev").fadeIn(800);
			}
			else if (RT == 1)
			{
				$(".file_project").removeAttr("required");
				document.getElementById("file_maintenance").setAttribute("required","required");
				$("#tbl_docSupport_maintenance").fadeIn(800);
				$("#tbl_docSupport_dev").hide();
			}
			$("#FAD_BTN_submit").fadeIn(800);
		}
		else
		{
			$("#FAD_TXT_Modul").hide(400);
			$("#FAD_UR_modul").val("");
			$("#FAD_TXT_desc").hide(400);
			$("#FAD_UR_desc").val("");
			$("#FAD_TXT_reason").hide(400);
			$("#FAD_UR_reason").val("");
		}
	});
}

function openMdl(id)
{
	$(document).ready(function(){
		var post = "Req_ID="+id;
		$.ajax({
			type:"POST",
			url:url_DAR,
			data:post,
			success:function(result){
				var res = result.split("+");
				$("#D_REQID").html(res[0]);
				$("#D_REQBased").html(res[1]);
				$("#D_REQType").html(res[2]);
				$("#D_REQCase").html(res[3]);
				$("#D_REQModul").html(res[4]);
				$("#D_REQDesc").html(res[5]);
				$("#D_REQReason").html(res[6]);
				$("#D_REQFname").html(res[7]);
				$("#D_REQCreated").html(res[9]);
				$("#D_REQPICDev").html(res[17]);
				$("#D_REQEST").html(res[19]);
				$("#D_REQStatus").html(res[20]);
				$("#D_REQStatusReason").html(res[22]);
				$("#D_REQStatusDate").html(res[24]);
			}
		});
		$("#Modal_FTR").modal("show");
	});
	
}

$(document).ready(function(){
	$("#close_successFrm").click(function(){
		$("#successFrm").fadeOut(700);
	});
});