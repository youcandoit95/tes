function openForm()
{
	$(document).ready(function(){
		$("#successFrm").hide('slow');	
		$("#form_add_data").show('slow');	
		$("#add_data").hide('slow');	
	});
}

function closeForm()
{
	$(document).ready(function(){
		$("#frm_username").val("");
		$("#frm_email").val("");
		$("#frm_password").val("");
		$("#re_frm_password").val("");
		$("#frm_fullname").val("");
		$("#frm_department").val("");
		$("#frm_phn_personal").val("");
		$("#frm_phn_office").val("");
		$("#errorFrm").hide('slow');
		$("#form_add_data").hide('slow');
		$("#add_data").show('slow');	
	});
}

$(document).ready(function(){
	$("#re_frm_password").focusout(function(){
		var pass = $("#frm_password").val();
		var re_pass = $("#re_frm_password").val();
		if (pass=="" || re_pass=="")
		{
			$("#cekPassMatchTrue2").hide(400);
			$("#btn_register").hide();
			$("#cekPassMatchFalse2").html('password field and confirm password are required');
			$("#cekPassMatchFalse2").show(400);
		}
		else
		{
			if (re_pass!=pass)
			{
				$("#cekPassMatchTrue2").hide(400);
				$("#btn_register").hide();
				$("#cekPassMatchFalse2").html('not match w/ password field');
				$("#cekPassMatchFalse2").show(400);
			}
			else
			{
				$("#cekPassMatchTrue2").show(400);
				$("#cekPassMatchFalse2").hide();
				$("#cekPassMatchTrue2").html('yap, match w/ password field');
				$("#cekPassMatchTrue2").show(400);
				$("#btn_register").show(400);
			}
		}
	});
});

$(document).ready(function(){
	$("#close_successFrm").click(function(){
		$("#successFrm").fadeOut('2000');
	});
});

for (var yy = 1; yy <= 100; yy++)
{
	FED_user('GO_FED_User_'+yy, 'males'+yy);
	DEL_user('DEL_User_'+yy, 'males'+yy, 'deleteUserame'+yy, 'row_deleteUser'+yy)
}

function DEL_user(x,y,w,r)
{
	$(document).ready(function(){
		$("#"+x).click(function(){
			var d=confirm("Are you sure want to continue ?");
			if (d==true)
			{
				var z = $("#"+y).val();
				var v = $("#"+w).val();
				var post = "DEL_user_id="+z+"&DEL_user_name="+v;
				$.ajax({
					type:"POST",
					url:url_delUser,
					data:post,
					success:function(res){
						var r_del_user = res;
						if (r_del_user=='1')
						{
							$("#successFrm").hide(800);
							$("#deletedUserName").html(""+v);
							$("#"+r).hide(800);
							$("#deleteUser").show(800);
							$(".loader").hide('slow');
						}
						else
						{
						
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

function FED_user(btnfed,ddd)
{
	$(document).ready(function(){
		$("#"+btnfed).click(function(){
			var xxx = $("#"+ddd).val();
			var post = "FED_user_id="+xxx;
			$("#successFrm").fadeOut('2000');
			$.ajax({
				type:"POST",
				url:url_goFED,
				data:post,
				dataType: "json",
				success:function(res){
					document.getElementById("fed_user_no").value = res.USER_NO;
					document.getElementById("fed_user_id").value = res.USER_ID;
					document.getElementById("fed_user_fname").value = res.USER_FNAME;
					$("#fed_department").val(res.DEPT_NO);
					$("#fed_user_nname").val(res.USER_NICKNAME);
					$("#fed_user_email").val(res.USER_EMAIL);
					$("#fed_user_phone").val(res.USER_PHONE);
					$("#fed_user_level").val(res.LEVEL_NO);
					
					$("#deleteUser").hide("slow");
					$("#add_data").hide("slow");
					$("#form_add_data").hide("slow");
					$("#FED_User").show(1200);
					$(".loader").fadeOut('slow');
				}
			});
		});
	});
}

$(document).ready(function(){
	$("#FED_BTN_cancel").click(function(){
		$("#FED_User").hide(1200);
		$("#add_data").show("slow");
	});
	
	$("#GO_FED_User_changePass").click(function(){
		$("#FED_F_Password").fadeIn(800);
		$("#FED_F_Re_Password").fadeIn(800);
		$("#FED_statChangePass").val("Y");
		
	});
	$("#GO_FED_User_Cancel_changePass").click(function(){
		document.getElementById("FED_password").value="";
		document.getElementById("FED_re_password").value="";
		$("#FED_statChangePass").val("N");
		$("#FED_F_Re_Password").fadeOut(800);
		$("#FED_F_Password").fadeOut(800);
	});
});

$(document).ready(function(){
	$("sup").tooltip();
	$("#re_password").change(function(){
		if ($("#password").val()!=$("#re_password").val())
		{
			$("#cekPassMatchFalse2").html("not match with password field");
			$("#cekPassMatchFalse2").show(400);
		}
	});
});

$(document).ready(function(){
	$("#FED_username").focusout(function(){
		var cek_username = $("#FED_username").val();
		var compare_username = $("#FED_compareUsername").val();
		var post = "cek_username="+cek_username;
		
		$.ajax({
			type:"POST",
			url:url_cekUser,
			data:post,
			success:function(data){
				var r = data;
				if (r=="4")
				{
					$(".cekAvUserTrue").html('');
					$(".cekAvUserTrue").hide('slow');
					$(".cekAvUserFalse").html('Please fill this field');
					$(".cekAvUserFalse").show('slow');
					$(".loader").hide();
				}
				else if (compare_username==cek_username)
				{
					$(".cekAvUserFalse").html('');
					$(".cekAvUserFalse").hide('slow');
					$(".cekAvUserTrue").html('Your current username <img src="../../js/smile.gif" width=19 height=19>');
					$(".cekAvUserTrue").show('slow');
					$(".loader").hide();
				}
				else if(r=="1")
				{
					
					$(".cekAvUserTrue").html('');
					$(".cekAvUserTrue").hide('slow');
					$(".cekAvUserFalse").html('Not Available!');
					$(".cekAvUserFalse").show('slow');
					$(".loader").hide();
				}
				else
				{
					$(".cekAvUserFalse").html('');
					$(".cekAvUserFalse").hide('slow');
					$(".cekAvUserTrue").html('Available!');
					$(".cekAvUserTrue").show('slow');
					$(".loader").hide();
				}
			}
		});
	});
	
});

$(document).ready(function(){
	$("#frm_newUser").submit(function(){
		var username = $("#frm_username").val();
		var email = $("#frm_email").val();		
		var password = $("#frm_password").val();		
		var fname = $("#frm_fullname").val();		
		var dept = $("#frm_department").val();		
		var personal = $("#frm_phn_personal").val();		
		var office = $("#frm_phn_office").val();		
		 
		var post = "username="+username+ "&email="+email+ "&password="+password+ "&fullname="+fname+ "&department="+dept+ "&phn_personal="+personal+"&phn_office="+office;
			
			$.ajax({
				 type:"POST",
		  		 url:url_frmNewUser,
		  		 data:post,
		  		 success:function(data){
					var r = data;
					if (r="1")
					{
						$("#successFrm").html("Success");
						$("#successFrm").show();
						$(".loader").hide();
						return false;
					}
					else
					{
						$("#errorFrm").html("error");
						$("#errorFrm").show();
						$(".loader").hide();
						return false;
					}
				 }
			});
		return false;
		});
		
	});
	
function delete_user(x)
{
	$(document).ready(function(){
		$().redirect_pageself(url_delUser,{
			'user_no':x
		});
	});
}

function match_pass_new(x)
{
	$(document).ready(function(){
		var pass = $("#"+x+"_conf").val();
		var conf_pass = $("#"+x).val();
		
		if (pass!=conf_pass)
		{
			$("#re_pass_error").html("Tidak sama dengan kolom password");
			$("#btn_submit_form").prop("disabled",true);
		}
		else
		{
			$("#re_pass_error").html("");
			$("#btn_submit_form").prop("disabled",false);
		}
	});
}

function check_user_available(x)
{
	$(document).ready(function(){
		var post = "nik="+x;
		
			$.ajax({
				type:"POST",
				url:url_cek_user,
				data:post,
				success:function(data){
					var r = data;
					if (r=="4")
					{
						$(".cekAvUserTrue_"+x).html('');
						$(".cekAvUserTrue_"+x).hide('slow');
						$(".cekAvUserFalse_"+x).html('Please fill this field');
						$(".cekAvUserFalse_"+x).show('slow');
						$(".loader").hide();
					}
					else if(r=="1")
					{
						$(".cekAvUserTrue_"+x).html('');
						$(".cekAvUserTrue_"+x).hide('slow');
						$(".cekAvUserFalse_"+x).html('Not Available!');
						$(".cekAvUserFalse_"+x).show('slow');
						$(".loader").hide();
					}
					else
					{
						$(".cekAvUserFalse_"+x).html('');
						$(".cekAvUserFalse_"+x).hide('slow');
						$(".cekAvUserTrue_"+x).html('Available!');
						$(".cekAvUserTrue_"+x).show('slow');
						$(".loader").hide();
					}
				}
			});
		});
}

function get_md_dept(x)
{
	$(document).ready(function(){
		var post = "div_no="+x;
		
			$.ajax({
				type:"POST",
				url:url_get_md_dept,
				data:post,
				success:function(data){
					$("#cmb_karyawan_dept_no").html(data);
					if (x=="888")
					{
						$("#cmb_karyawan_bagian_no").html('<option value="888">Semua Bagian</option>');
					}
					else
					{
						$("#cmb_karyawan_bagian_no").html("<option value=''>Pilih Departement</option>");
					}
				}
			});
		});
}

function get_md_bagian(x)
{
	$(document).ready(function(){
		var p_div_no = $("#cmb_karyawan_div_no").val();
		var post = "div_no="+p_div_no+"&dept_no="+x;
		
			$.ajax({
				type:"POST",
				url:url_get_md_bagian,
				data:post,
				success:function(data){
					$("#cmb_karyawan_bagian_no").html(data);
				}
			});
		});
}

function field_unit(x,y)
{
	$(document).ready(function(){
		if (x==1)
		{
			$("#cmb_karyawan_div_no").val("");
			$("#cmb_karyawan_dept_no").val("");
			$("#cmb_karyawan_bagian_no").val("");
			
			$("#cmb_karyawan_div_no").prop("disabled",true);
			$("#cmb_karyawan_dept_no").prop("disabled",true);
			$("#cmb_karyawan_bagian_no").prop("disabled",true);
		}
		else if (x<=3)
		{	
			$("#cmb_karyawan_dept_no").val("");
			$("#cmb_karyawan_bagian_no").val("");
		
			$("#cmb_karyawan_div_no").prop("disabled",false);
			$("#cmb_karyawan_dept_no").prop("disabled",true);
			$("#cmb_karyawan_bagian_no").prop("disabled",true);
		}
		else
		{
			$("#cmb_karyawan_div_no").prop("disabled",false);
			$("#cmb_karyawan_dept_no").prop("disabled",false);
			if (x>4)
			{
				$("#cmb_karyawan_bagian_no").prop("disabled",false);
			}
			else
			{
				$("#cmb_karyawan_bagian_no").prop("disabled",true);
				$("#cmb_karyawan_bagian_no").val("");
			}
		}
	});
}

function open_fed_user(x)
{
	$(document).ready(function(){
		var post = "FED_user_id="+x;
			$.ajax({
				type:"POST",
				url:url_goFED,
				data:post,
				dataType: "json",
				success:function(res){
					$("#fed_user_no").val(x);
					$("#fed_user_level").val(res.LEVEL_NO);
					$("#fed_user_id").val(res.USER_ID);
					$("#fed_department").val(res.DEPT_NO);
					
					if (res.LEVEL_NO==1)
					{
						$("#frm_unit_fed_user_level").attr("required","");
						$("#frm_unit_fed_user_level").val(res.CATEGORY_NO);
						$("#con_unit_fed_user_level").show();
					}
					else
					{
						$("#frm_unit_fed_user_level").removeAttr("required");
						$("#frm_unit_fed_user_level").val("");
						$("#con_unit_fed_user_level").hide();
					}
					
					$("#fed_user_fname").val(res.USER_FNAME);
					$("#fed_user_nname").val(res.USER_NICKNAME);
					$("#fed_user_email").val(res.USER_EMAIL);
					$("#fed_user_phone").val(res.USER_PHONE);
					$("#con_fed").show();
					$("#fed_user_level").focus();
				}
			});
	});
}

function close_fed()
{
	$("#con_fed").hide();
}

function view_detail(x)
{	
	var datapost = "nik="+x;
	$(document).ready(function(){
		$.ajax({
			type: "POST",
			data: datapost,
			url: url_detail_karyawan,
			dataType: "json",
			success: function(result){
				$("#detail_karyawan_nik").html(result.karyawan_nik);
				$("#detail_karyawan_divisi").html(result.karyawan_div_name);
				$("#detail_karyawan_dept").html(result.karyawan_dept_name);
				$("#detail_karyawan_bagian").html(result.karyawan_bagian_name);
				$("#detail_karyawan_jabatan").html(result.karyawan_jabatan_name);
				$("#detail_karyawan_fname").html(result.karyawan_fullname);
				$("#detail_karyawan_address").html(result.karyawan_address);
				$("#detail_karyawan_telepon").html(result.karyawan_phone1);
				$("#detail_karyawan_email").html(result.karyawan_email);
				$("#detail_karyawan_dapat_cuti").html(result.karyawan_get_cuti);
			}
		});
	});
	
	$('#modal_detail_karyawan').modal('toggle');
	$('#modal_detail_karyawan').modal('show');
}

function set_tidak_get_cuti(x)
{
	var conf = confirm('Apakah anda yakin ?');
	if (conf==true)
	{
		$().redirect_pageself(url_set_tidak_get_cuti,{
			'nik': x
		});
	}
	else
	{
		return false;
	}
}

function set_ya_get_cuti(x)
{
	var conf = confirm('Apakah anda yakin ?');
	if (conf==true)
	{
		$().redirect_pageself(url_set_ya_get_cuti,{
			'nik': x
		});
	}
	else
	{
		return false;
	}
}