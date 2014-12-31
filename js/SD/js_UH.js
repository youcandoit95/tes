$(document).ready(function()
{	
	var cekAR = setInterval(function(){
		var post = "cek=ya";
		$.ajax({
			type: "POST",
			data: post,
			url: url_CAR,
			success:function(result){
				$("#SL_CAR").html(result);
			}
		});
	},3000);
	
	var cekWR = setInterval(function(){
		var post = "cek=ya";
		$.ajax({
			type: "POST",
			data: post,
			url: url_CWR,
			success:function(result){
				$("#SL_CWR").html(result);
			
			}
		});
		return false;
		}, 3000);
		
		var cekHR = setInterval(function(){
			var post  = "cek=ya";
			$.ajax({
				type: "POST",
				data: post,
				url:url_CHR,
				success:function(result){
					var res = result;
					$("#SL_HR").html(res);
				}
			});
			return false;
		},3000);
		
		var cekCR = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type: "POST",
				data: post,
				url: url_CCR,
				success:function(result){
					var res = result;
					$("#SL_CR").html(""+res);
				}
			});
		},3000);
		
		var cekWD = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type:"POST",
				data:post,
				url: url_CWD,
				success:function(result){
					var res = result;
					$("#SL_WD").html(""+res);
				}
			});
		},3000);
		
		var cekOP = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type: "POST",
				data: post,
				url: url_COP,
				success:function(result){
					var res = result;
					$("#SL_OP").html(""+res);
				}
			});
		},3000);
		
		var cekRR = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type: "POST",
				data: post,
				url: url_CRR,
				success:function(result){
					var res = result;
					$("#SL_RR").html(""+res);
				}
			});
		},3000);
		
		var cekDR = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type: "POST",
				data: post,
				url: url_CDR,
				success: function(result){
					var res = result;
					$("#SL_DR").html(""+res);
				}
			});
		},3000);
		
		var cekTR = setInterval(function(){
			var post = "id="+id_user;
			$.ajax({
				type:"POST",
				url:url_CTR,
				data:post,
				success:function(result){
					var br;
					var ty = result;
					var reqid;
					reqid="";
					if (ty!="nothing")
					{
						var temp;
						temp = "";
						var res = result.split(";");
						
							for (var cnt_tr=0; cnt_tr<res.length; cnt_tr++)
							{
								var cek_avlbl;
								br = "";
								var r = res[cnt_tr].split("+");
								for (var t = 1; t<r.length; t++)
								{
									cek_avlbl = 0;
									if(r[0]=="YTR")
									{
										if (t%2==1)
										{
											temp =  temp +"User '" + r[t];
										}else{
												reqid = reqid + r[t] + ";";
												temp = temp + "' was taken request '"+ r[t]+"'";
										}
										cek_avlbl = 1;
									}
								}
								if (cek_avlbl>0)
								{br="<br>"}
								temp = temp+br;
							}
							
							if (temp!="")
							{
							$("#VN_YTR").val(""+reqid);
							$("#TR_data").html(""+temp);
							/*$("#tryyy").show(800);*/
							}
					}
					else if (ty!="nothing")
					{
						$("#TR_data").html("");
						$("#tryyy").fadeOut(800);
					}
				}
			});
		}, 3000);
		
			var NHR = setInterval(function(){
			var post = "id="+id_user;
			$.ajax({
				type:"POST",
				url:url_CTR,
				data:post,
				success:function(result){
					var ty = result;
					var br;
					if (ty!="nothing")
					{
						var temp;
						var reqid;
						var cek_avlbl;
						reqid = "";
						temp = "";
						var res = result.split(";");
						
							for (var cnt_tr=0; cnt_tr<res.length; cnt_tr++)
							{
								cek_avlbl = 0;
								br = "";
								var r = res[cnt_tr].split("+");
								for (var t = 1; t<r.length; t++)
								{
									br = "<br>";
									if(r[0]=="YHR")
									{
										if (t%2==1)
										{
											temp =  temp +"User " + r[t];
										}else{
												temp = temp + " was HOLD request '"+ r[t]+"'" +br;
												reqid = reqid + r[t]+ ";";
										}
										cek_avlbl = 1;
									}
									else if(r[0]=="YCR")
									{
										if (t%2==1)
										{
											temp =  temp +"User " + r[t];
										}else{
												temp = temp + " was CANCEL request '"+ r[t]+"'" +br;
												reqid = reqid + r[t]+ ";";
										}
										cek_avlbl = 1;
									}
									else if(r[0]=="YTR")
									{
										if (t%2==1)
										{
											temp =  temp +"User " + r[t];
										}else{
												reqid = reqid + r[t] + ";";
												temp = temp + " was taken your request '"+ r[t]+"'" +br;
										}
										cek_avlbl = 1;
									}
									else if(r[0]=="YWD")
									{
										if (t%2==1)
										{
											temp =  temp +"User " + r[t];
										}else{
												reqid = reqid + r[t] + ";";
												temp = temp + " was sent confirmation done for your request '"+ r[t]+"'" +br;
										}
										cek_avlbl = 1;
									}
									
								}
								temp = temp;
							}
							
							if (temp!="")
							{
								$("#VN_YHR").val(""+reqid);
								$("#NHR_D").html(""+temp);
								$("#NHR").show(800);
							}
					}
					else if (ty!="nothing")
					{
						$("#TR_data").html("");
						$("#tryyy").fadeOut(800);
					}
				}
			});
		}, 3000);
		
		$(".viewed_notif").click(function(){
			var YHR = $("#VN_YHR").val();
			var YTR = $("#VN_YTR").val();
			var post = "view_id="+id_user+"&VN_YTR="+YTR+"&VN_YHR="+YHR;
			$.ajax({
				type:"POST",
				url:url_VN,
				data: post,
				success: function(result){
					var res = result;
					if (res==2)
					{
						$("#VN_YTR").val("");
						$("#VN_YHR").val("");
						$("#TR_data").html("");
						$("#NHR_D").html("");
						
						$("#tryyy").hide(800);
						$("#NHR").hide(800);
					}
				}
			});
		});
	
	/*$(".BTN_WR_SDH").click(function(){
		location.reload();
	});*/
	
	$("#FTR").dialog({
		autoOpen: false,
		modal: true,
		width: 535
	});
	
	$('.datetimepicker').datetimepicker({
		dateFormat: 'dd-mm-yy',
		timeFormat: "HH:mm:ss"
	});
	
	$('#FTR_REQ_EST').keydown(function() {
	//code to not allow any changes to be made to input field
	return false;
	});
	
	$("#status").change(function(){
		var status = $("#status").val();
		if (status=="On Process")
		{
			document.getElementById('file_uat').removeAttribute("required");
			$("#STAT_REASON").hide('slow');
			$("#FTR_REQ_Reason").val("")
			$("#FTR_REQ_EST_DONE").val("");
			$("#SET_DONE").hide('slow');
		
			$("#SET").fadeIn(800);
		}
		else if (status=="Hold" || status=="Cancel" || status=="Revision")
		{
			document.getElementById('file_uat').removeAttribute("required");
			$("#FTR_REQ_EST").val("");
			$("#SET").hide('slow');
			$("#FTR_REQ_EST_DONE").val("");
			$("#SET_DONE").hide('slow');
			
			$("#STAT_REASON").fadeIn(800);			
		}
		else if (status=="Done")
		{
			document.getElementById('file_uat').setAttribute("required","required");
			$("#STAT_REASON").hide('slow');
			$("#FTR_REQ_Reason").val("")
			$("#FTR_REQ_EST").val("");
			$("#SET").hide('slow');
			$("#file_done").fadeIn(800);
		}
		else
		{
			document.getElementById('file_uat').removeAttribute("required");
			$("#FTR_REQ_Reason").val("");
			$("#FTR_REQ_EST").val("");
			$("#FTR_REQ_EST_DONE").val("");
			$("#SET_DONE").hide('slow');
			$("#SET").hide('slow');
			$("#STAT_REASON").hide('slow');
		}
	});
});

function openTR(id)
{
	$(document).ready(function(){
		var post = "TR_ID="+id;
		$.ajax({
			type:"POST",
			url:url_FTR,
			data:post,
			success:function(result){
				var res = result.split(";");
				var statusss = "";
				$("#FTR_REQID").val(res[0]);
				$("#FTR_REQ_ID").html(res[0]);
				$("#FTR_REQ_Based").html(res[1]);
				$("#FTR_REQ_Type").html(res[2]);
				$("#FTR_REQ_Case").html(res[3]);
				$("#FTR_REQ_Modul").html(res[4]);
				$("#FTR_REQ_Desc").html(res[5]);
				$("#FTR_REQReason").html(res[6]);
				$("#FTR_PIC_Username").html(res[7]);
				$("#FTR_PIC_Fullname").html(res[8]);
				$("#FTR_REQ_PICPP").html(res[9]);
				$("#FTR_REQ_PICPO").html(res[10]);
				$("#FTR_REQ_Created").html(res[11]);
				if(res[12] == "Waiting_confirmation_DONE")
				{
					statusss = "Wating Confirmation DONE from you";
				}
				else
				{
					statusss = res[12];
				}
				$("#FTR_REQ_Status").html(statusss);
				$("#FTR_REQ_StatusReason").html(res[13]);
			}
		});
	});
	
	$("#Modal_FTR").modal("show");
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
	});
	
	$("#Modal_FTR").modal("show");
}

/*
function checkFile(valFile,idFile)
{
	var ext=/\b(pdf|doc|docx)/g;
	var x = valFile;
	var spl = x.split(".");
	if (spl[1].match(ext)!=null)
	{
		
	}
	else
	{
		alert("extension '."+spl[1]+"' not allowed. PDF and DOC/X please");
		document.getElementById(''+idFile).value = "";
	}	
}*/

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