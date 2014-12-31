function open_fad()
{	
	$(document).ready(function(){
		$("#con_btn").hide();
		$("#con_fad").show();
	});
}
	
function close_fad()
{	
	$(document).ready(function(){
		$("#con_fad").hide();
		$("#con_btn").show();
	});
}

function activate_acc_user_isd(x)
{
	var c = confirm('Apakah anda yakin meng-Aktifkan akses ini ?');
	if (c==true)
	{
		$(document).ready(function(){
			$().redirect_pageself(url_activate_acc,{
				'acc_id':x
			});
		});
	}
	else
	{
		return false;
	}
}

function disactivate_acc_user_isd(x)
{
	var c = confirm('Apakah anda yakin meng-Aktifkan akses ini ?');
	if (c==true)
	{
		$(document).ready(function(){
			$().redirect_pageself(url_disactivate_acc,{
				'acc_id':x
			});
		});
	}
	else
	{
		return false;
	}
}