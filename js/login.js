/*$(document).ready(function(){
	$('#signup_btn').click(function(){
		$('#login_page').hide();
		$('#loader').show();
		var ass = 'asd';
		var datastring = 'ass=' + ass;
		
		$.ajax({
			type:'POST',
			url:signup_url,
			data:datastring,
			success:function(data){
				$('#loader').hide();
				$('#sign_page').html(data);
			}
		});
		return false;
	});
});
*/

$(document).ready(function(){
	$(".alert").delay(2000).fadeOut(1000);
	
	$("#myForm").submit(function(){
		var name = $('input#name').val();
		var email = $('input#email').val();
		var username = $('input#user').val();
		var pass = $('input#pass').val();
		var re_pass = $('input#re_pass').val();
		var depart = $('#depart').val();
		var phone = $('input#phone').val();
		var o_phone = $('input#o_phone').val();
		var datastring = 'name=' + name + '&email=' + email + '&username=' + username + '&pass=' + pass + '&re_pass=' + re_pass + '&depart=' + depart + '&phone=' + phone + '&o_phone=' + o_phone;
		
		if(name.length<=0 || email.length<=0 || username.length<=0 || pass.length<=0 || re_pass.length<=0 || depart.length<=0 || phone.length<=0 || o_phone.length<=0){
			$('#loader2').hide();
			$('.error').html('Tolong jangan ada yang dikosongkan');
			
		}else{
			$('#loader2').show();
			$('.error').html('');
			
			$.ajax({
				type:'POST',
				url:signup_proses_url,
				data:datastring,
				success:function(data){
					var ass = data;
					$('.error').html('');
					$('#loader2').hide();
					if(ass=="1"){
						$('.error').html('<div class="alert alert-danger"><strong>Please fill form correctly</strong></div>');
						$('.error').fadeIn(1000);
						$('.error').delay(3000).fadeOut(2000);
					}else if(ass=="2"){
						$('.error').html('<div class="alert alert-danger"><strong>Email Already Exist, Please Try Another</strong></div>');
						$('.error').fadeIn(1000);
						$('.error').delay(3000).fadeOut(2000);
					}
					else if(ass=="4"){
						$('.error').html('<div class="alert alert-danger"><strong>Username Already Exist, Please Try Another</strong></div>');
						$('.error').fadeIn(1000);
						$('.error').delay(3000).fadeOut(2000);
					}else if(ass=="5"){
						$('.error').html('<div class="alert alert-danger"><strong>Password Not Same</strong></div>');
						$('.error').fadeIn('slow');
						$('.error').delay(3000).fadeOut('slow');
					}else if(ass=="7"){
						$('.error').html('<div class="alert alert-danger"><strong>Error:Mailer 108</strong></div>');
					}else if(ass=="6"){
						$('.sukses').html('<div class="alert alert-success"><strong>Congratulation, Check your mail for activation</strong></div>');
						$('input#name').val("");
						$('input#email').val("");
						$('input#user').val("");
						$('input#pass').val("");
						$('input#re_pass').val("");
						$('input#depart').val("");
						$('input#phone').val("");
						$('input#o_phone').val("");
						$('.sukses').fadeIn(1000);
						$('.sukses').delay(3000).fadeOut(2000);
					}
				}
				
			});
		}
		return false;
	});

	$("#signup_btn").click(function(){
		$("#myForm2").hide('slow');
		$("#signup_btn").hide('slow');
		$("#myForm").show('slow');
	});
	
	$(".ttip").tooltip();
	
	$("#login_btn").click(function(){
		$("#myForm").hide('slow');
		$("#myForm2").show('slow');
		$("#signup_btn").show('slow');
	});
});

function checkInput(obj) 
{
	var pola = "^";
	pola += "[0-9]*";
	pola += "$";
	rx = new RegExp(pola);

	if (!obj.value.match(rx))
	{
		if (obj.lastMatched)
		{
			obj.value = obj.lastMatched;
		}
		else
		{
			obj.value = "";
		}
	}
	else
	{
		obj.lastMatched = obj.value;
	}
}