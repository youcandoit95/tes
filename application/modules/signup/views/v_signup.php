<script>
var signup_proses_url = '<?php echo site_url().'signup/c_signup/signup_proses' ?>';

$(document).ready(function(){
	$("#myForm").submit(function(){
		var name = $('input#name').val();
		var email = $('input#email').val();
		var username = $('input#user').val();
		var pass = $('input#pass').val();
		var re_pass = $('input#re_pass').val();
		var depart = $('input#depart').val();
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
						$('.error').html('Invalid Name');
					}else if(ass=="2"){
						$('.error').html('Invalid Email');
					}else if(ass=="3"){
						$('.error').html('Invalid Username');
					}else if(ass=="4"){
						$('.error').html('Username Already Exist, Please Try Another');
					}else if(ass=="5"){
						$('.error').html('Password Not Same');
					}else if(ass=="6"){
						$('.error').html('Congratulation, You Successfuly Registered');
						$('input#name').val("");
						$('input#email').val("");
						$('input#user').val("");
						$('input#pass').val("");
						$('input#re_pass').val("");
						$('input#depart').val("");
						$('input#phone').val("");
						$('input#o_phone').val("");
					}
				}
				
			});
		}
		return false;
	});
});

jQuery(function($){
	$("#phone").mask("999999999999");
	$("#o_phone").mask("9999999");
});
</script>
<form id="myForm">
<table cellpadding="10" style="border:1px solid #CCC; width:400px; background-color:#FFF; font-size:12px;" class="shadow">
            	<tr class="btn-inverse">
                	<td style="padding:10px;" colspan="2">SIGN UP</td>
                </tr>
                <tr>
                	<td>Name</td><td><input type="text" name="name" id="name" class="span3" style="height:35px;" /></td>
                </tr>
                <tr>
                	<td>Email</td><td><input type="text" name="email" id="email" class="span3"  style="height:35px;" /></td>
                </tr>
                <tr>
                	<td>Username</td><td><input type="text" name="username" id="user" class="span3"  style="height:35px;" /></td>
                </tr>
                <tr>
                	<td>Password</td><td><input type="password" name="pass" id="pass" class="span3"  style="height:35px;" /></td>
                </tr>
                <tr>
                	<td>Re-password</td><td><input type="password" name="re_pass" id="re_pass" class="span3"  style="height:35px;" /></td>
                </tr>
                <tr>
                	<td>Departement</td><td><input type="text" name="depart" id="depart" class="span3" style="height:35px;" /></td>
                </tr>
                <tr>
                	<td>Phone</td><td><input type="text" name="phone" id="phone" class="span3" style="height:35px;" /></td>
                </tr>
                <tr>
                	<td>Office Phone</td><td><input type="text" name="o_phone" id="o_phone" class="span3" style="height:35px;" /></td>
                </tr>
                <tr>
                	<td colspan="2"><input type="submit" value="SIGN UP" class="btn btn-primary" /> &nbsp;<span id="loader2" class="gone"><img src="<?php echo base_url().'images/loader2.gif'; ?>" /></span><span class="error"></span></td>
                </tr>
				<tr>
					<td colspan="2" align="right"><input type="button" id="login_btn" value="LOG IN" class="btn btn-success" /></td>
				</tr>
</table>

</form>