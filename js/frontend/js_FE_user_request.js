/*
* js_FE_user_request.js
* created by yansen - April 2013
* RM = Request Modul , RB = Request Based, RC = Request Case , RT = Request Type 
* 
*
*
*/
$(document).ready(function(){
	$("#FAD_UR_type").change(function(){
		$(".step2_req").hide(400);
		$(".step3_req").hide(400);
		var based = $("#FAD_UR_based").val();
		var type = $("#FAD_UR_type").val();
		var RC = $("#FAD_UR_case").val();
		var post = "based="+based+"&type="+type;
		if (based!="choose" && type!="choose")
		{
			$("#loader").show();
			$.ajax({
				type:"POST",
				url:url_RC,
				data:post,
				success:function(result){
					var res = result;
					$("#FAD_CMB_RC").fadeOut();
					$("#FAD_UR_case").html(""+res);
					$("#FAD_CMB_RC").fadeIn(800);
					$("#loader").fadeOut();
				}
			});
		}
		else
		{
			$("#FAD_CMB_RC").hide(400);
			$("#FAD_TXT_Modul").hide(400);
			$("#FAD_UR_modul").val("");
			$("#FAD_TXT_desc").hide(400);
			$("#FAD_UR_desc").val("");
			$("#FAD_TXT_reason").hide(400);
			$("#FAD_UR_reason").val("");
			$("#FAD_BTN_submit").hide(400);
		}
	});
});

$(document).ready(function(){
	$("#FAD_UR_based").change(function(){
		var type2 = $("#FAD_UR_type").val();
		var based2 = $("#FAD_UR_based").val();
		if (type2!="choose" && based2!="choose")
		{
			$("#loader").show();
			var post2 = "based="+based2+"&type="+type2;
			$.ajax({
				type:"POST",
				url:url_RC,
				data:post2,
				success:function(result){
					var res = result;
					$("#FAD_CMB_RC").fadeOut();
					$("#FAD_UR_case").html(""+res);
					$("#FAD_CMB_RC").fadeIn(800);
					$("#loader").fadeOut();
				}
			});
		}
		else
		{
			$("#FAD_TXT_Modul").hide(400);
			$("#FAD_UR_modul").val("");
			$("#FAD_TXT_desc").hide(400);
			$("#FAD_UR_desc").val("");
			$("#FAD_TXT_reason").hide(400);
			$("#FAD_UR_reason").val("");
			$("#FAD_BTN_submit").hide(400);
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

$(document).ready(function(){
	$("#close_successFrm").click(function(){
		$("#successFrm").fadeOut(700);
	});
});

function openFCD(id)
{
	$(document).ready(function(){
		$('#loader').show('slow');
		var post = "FCD_id="+id;
		$.ajax({
			type:"POST",
			url:url_FCD,
			data:post,
			success:function(result){
				var res = result;
				var data = res.split(";");
				$("#FCD_request_ID").html(""+data[0]);
				$("#cancelRequest").fadeIn(800);
				$('#loader').fadeOut(800);
			}
		});
	});
}

function checkFile(valFile,idFile)
{
	
		var ext=/\b(txt|gif|jpg|png|doc|docx|xls|xlsx|pdf|jpeg)/g;
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