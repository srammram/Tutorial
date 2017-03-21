
	$(document).ready(function() {	
$("#loginForm").on('submit',(function(e){
		e.preventDefault();
	 var email = $('#email').val();
	 var pass = $('#password').val();
	 if(isEmailValid(email)==false){
		alert("Please Enter Valid Email Id"); 
	 }else if((pass.length<3)){
		 
		 alert("Password must be atleast 4 characters")
		 
	 }else{
	$("#loginResult").html("<img src='images/loading-small.gif'/> Please wait....");
	
		$.ajax({
		url: "authentication.php",
		type: "POST",
		data: $(this).serialize(),
		success: function(datas){
			
			if(datas.status=="success"){
			window.location.href="dashboard.php"
			}else if(datas.status=="error"){
				
				$("#loginResult").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Error!</strong> '+datas.data+' </div>')
			}
		},
		error: function(){} 	        
		});
	 }


		}));
		$("#regForm").on('submit',(function(e){
		e.preventDefault();
	var name = $("#reg_name").val();
	 var email = $('#reg_email').val();
	 var mobile = $('#mobile').val();
	 var pass = $('#pass').val();
	 var cpass = $('#cpass').val();
	 var btn = $('#btn').val();
	if(name==""){
		alert("Enter your Name");
		$("#reg_name").focus();
	}
	 else if(isEmailValid(email)==false){
		alert("Please Enter Valid Email Id"); 
		$('#reg_email').focus();
	 }
	 
	 else if((mobile.length<11)||(mobile.length>12)){
		 alert("Enter Your 10 digit Mobile number");
		 $('#mobile').focus();
	 }
	 else if((pass.length<4)){
		 
		 alert("Password must be atleast 4 characters")
		 $('#pass').focus();
	 }
	else if(pass!=cpass){
		alert("Password Missmatch!");
		$('#cpass').focus();
	}
	 else{
	$("#regResult").html("<img src='images/loading-small.gif'/> Please wait....");
	
		$.ajax({
		url: "registeration.php",
		type: "POST",
		dataType:"JSON",
		data: $(this).serialize(),
		success: function(datas){
			
			if(datas.status=="success"){
			$("#regResult").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Success!</strong>'+datas.data+'</div>');
			}else if(datas.status=="error"){
				
				$("#regResult").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Error!</strong>'+datas.data+'</div>');
			}
		},
		error: function(){} 	        
		});
	 }


		}));
		
	});
		
function isEmailValid(email){
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
	return regex.test(email);
	
}

