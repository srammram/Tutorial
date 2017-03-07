/* this files used login related functions... */

$(document).ready(function() {

	var  loading_icon = "";
/* Common login */
$("#login_form").validate(
		{
			ignore : "",
			submitHandler : function() {
				
				$(".log_alert").removeClass('alert-danger');
				$("#log_submit").hide();
				$("#login-progress").show();
		    	
		    	   $.ajax({
		    	        url: SITE_URL+"login",
		    	        data : $('#login_form').serialize(),
		    	        type :'POST', 
		    	        dataType:"json",
		    	        success:function(data){
		    	        	$("#log_submit").show();
		    	    		$("#login-progress").hide();
							
		    	            if(data.status=="success"){
								
								if(data.type='delear')
								{
								 window.location.href = SITE_URL;
								} 
		    	            	
		    	              }else if(data.status=="error"){
		    	     		      $(".log_alert").addClass("alert-danger");
									$(".log_alert").show().html(data.message);
									
		    	              }
		    	        }
		    	    });
		    
			}
		});

}); /* end of document ready*/