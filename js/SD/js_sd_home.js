$(document).ready(function()
{
    var ceknreq = setInterval(function(){        
		var post = "cek=yo"
		$.ajax({
				 type:"POST",
				 data:post,
		  		 url:url_CNR,
		  		 success:function(result){
					var CNR = result;					
					if ((CNR!="") && (CNR!=0))
					{
						$("#NNR_COUNT").html(result);
						$("#NNR").fadeIn(800);
					}
					else
					{
						$("#NNR").hide(800);
					}
				 }
			});
		
		return false;
    }, 2000);
	
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
		
		var cekWD = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type:"POST",
				data:post,
				url:url_CWD,
				success:function(result){
					var res = result;
					$("#SL_WD").html(res);
				}
			});
			return false;
		},3000);
		
		var cekRR = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type: "POST",
				url:url_CRR,
				data:post,
				success:function(result){
					var res = result;
					$("#SL_RR").html(""+res);
				}
			});
		},3000);
		
		var cekCR = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type: "POST",
				url: url_CCR,
				data: post,
				success: function(result){
					var res = result;
					$("#SL_CR").html(""+res);
				}
			});
		},3000);
		
		var cekDR = setInterval(function(){
			var post = "cek=ya";
			$.ajax({
				type: "POST",
				url: url_CDR,
				data: post,
				success:function(result){
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
						reqid = "";
						temp = "";
						var res = result.split(";");
						
							for (var cnt_tr=0; cnt_tr<res.length; cnt_tr++)
							{
								var r = res[cnt_tr].split("+");
								for (var t = 1; t<r.length; t++)
								{
									if(r[0]=="YHR")
									{
										if (t%2==1)
										{
											temp =  temp +"User `" + r[t];
										}else{
												temp = temp + "` was HOLD request '"+ r[t]+"'" +br;
												reqid = reqid + r[t]+ ";";
										}
										br = "<br>" ;
									}
									else if(r[0]=="YCR")
									{
										if (t%2==1)
										{
											temp =  temp +"User `" + r[t];
										}else{
												temp = temp + "` was CANCEL request '"+ r[t]+"'" +br;
												reqid = reqid + r[t]+ ";";
										}
										br = "<br>" ;
									}
									else if(r[0]=="YTR")
									{
										if (t%2==1)
										{
											temp =  temp +"User " + r[t];
										}else{
												reqid = reqid + r[t] + ";";
												temp = temp + " was taken request '"+ r[t]+"'";
										}
										br = "<br>";
									}
									else if(r[0]=="YRR")
									{
										if (t%2==1)
										{
											temp =  temp +"User " + r[t];
										}else{
												reqid = reqid + r[t] + ";";
												temp = temp + " was sent revision information on request '"+ r[t]+"'";
										}
										br = "<br>";
									}
									else
									{
										br = "" ;
									}
								}
								temp = temp+br;
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
			$("#STAT_REASON").hide('slow');
			$("#FTR_REQ_Reason").val("")
			$("#FTR_REQ_EST_DONE").val("");
			$("#SET_DONE").hide('slow');
		
			$("#SET").fadeIn(800);
		}
		else if (status=="Hold" || status=="Cancel")
		{
			$("#FTR_REQ_EST").val("");
			$("#SET").hide('slow');
			$("#FTR_REQ_EST_DONE").val("");
			$("#SET_DONE").hide('slow');
			
			$("#STAT_REASON").fadeIn(800);			
		}
		else if (status=="Done")
		{
			$("#STAT_REASON").hide('slow');
			$("#FTR_REQ_Reason").val("")
			$("#FTR_REQ_EST").val("");
			$("#SET").hide('slow');
		
			/*$("#SET_DONE").fadeIn(800);*/
		}
		else
		{
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
				$("#FTR_REQID").val(res[0]);
				$("#FTR_REQ_ID").html(res[0]);
				$("#FTR_REQ_Based").html(res[1]);
				$("#FTR_REQ_Type").html(res[2]);
				$("#FTR_REQ_Case").html(res[3]);
				$("#FTR_REQ_Modul").html(res[4]);
				$("#FTR_REQ_Desc").html(res[5]);
				$("#FTR_REQReason").html(res[6]);
				$("#FTR_REQ_Username").html(res[7]);
				$("#FTR_REQ_UserPP").html(res[8]);
				$("#FTR_REQ_UserPO").html(res[9]);
				$("#FTR_REQ_Created").html(res[10]);
				$("#FTR_REQ_Status").html(res[11]);
				$("#FTR_REQ_StatusReason").html(res[12]);
				$("#FTR_REQ_StatusCreated").html(res[13]);
			}
		});
	});
	
	$("#Modal_FTR").modal("show");
}

function openMdl(id)
{
	$(document).ready(function(){
		var post = "Req_ID="+id;
		var idwtslashh = id.replace("/","_");
		var idwtslash = idwtslashh.replace("/","_");
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
				var m_sp_doc = res[25].split("|");
				var d = "";
				for (var t=0; t<m_sp_doc.length; t++)
				{
					var d_sp_doc = m_sp_doc[t].split(".");
					var ext_d_sp_doc = d_sp_doc.length;
					var ext_f = d_sp_doc[ext_d_sp_doc-1];
					var ext = ext_file(ext_f);
					var d = d + "<a target='_blank' href='"+file_url+idwtslash+"/"+m_sp_doc[t]+"'>" + ext + " " + m_sp_doc[t] + "</a><br>";
				}
				$("#D_REQDocumentSupport").html(d);
			}
		});
	});
	
	$("#Modal_FTR").modal("show");
}

function openFtrMdl(id)
{
	$(document).ready(function(){
		var post = "Req_ID="+id;
		var idwtslashh = id.replace("/","_");
		var idwtslash = idwtslashh.replace("/","_");
		$.ajax({
			type:"POST",
			url:url_DAR,
			data:post,
			success:function(result){
				var res = result.split("+");
				$("#FTR_REQID").val(res[0]);
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
				var m_sp_doc = res[25].split("|");
				var d = "";
				for (var t=0; t<m_sp_doc.length; t++)
				{
					var d_sp_doc = m_sp_doc[t].split(".");
					var ext_d_sp_doc = d_sp_doc.length;
					var ext_f = d_sp_doc[ext_d_sp_doc-1];
					var ext = ext_file(ext_f);
					var d = d + "<a target='_blank' href='"+file_url+idwtslash+"/"+m_sp_doc[t]+"'>" + ext + " " + m_sp_doc[t] + "</a><br>";
				}
				$("#D_REQDocumentSupport").html(d);
			}
		});
	});
	
	$("#Modal_FTR").modal("show");
}

function ext_file(d)
{
	if (d=="txt")
	{
		return "<img src='"+img_url+"txt.png' width=24 height=24 border=0> ";
	}
	else if (d=="jpg" || d=="png" || d=="jpeg" || d=="gif" || d=="ico")
	{
		return "<img src='"+img_url+"image.png' width=24 height=24 border=0> ";
	}
	else if (d=="pdf")
	{
		return "<img src='"+img_url+"pdf.png' width=24 height=24 border=0> ";
	}
	else if (d=="xls" || d=="xlsx")
	{
		return "<img src='"+img_url+"excel.png' width=24 height=24 border=0> ";
	}
	else if (d=="doc" || d=="docx")
	{
		return "<img src='"+img_url+"word.png' width=24 height=24 border=0> ";
	}
	else if (d=="ppt" || d=="pptx")
	{
		return "<img src='"+img_url+"ppt.png' width=24 height=24 border=0> ";
	}
}