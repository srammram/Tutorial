/* this files used  pagination actions.. */

$(document).ready(function() {
	$(".append_html").on("click", ".pagination a", function(e) {
		e.preventDefault();

		var pass_url = $(this).attr('href');
		if (typeof (pass_url) != 'undefined' && pass_url != null) {
			show_content_loading();
			$.get(pass_url+"?paging=true", function(data) {
				hide_content_loading();
				var response = jQuery.parseJSON(data);
				$(".append_html").html(response.html);

			});
		}

	});
	
/* submit search.. */
	
/* unlink image  */
  $(".common_delete_image").click(function() {
	  
	 if(confirm('Are you want delete this image?'))
	  {
		    
	  }
  });
	
});

/* load content... */
function get_content(obj) { 
	paging = "";
	if (typeof (obj.paging) != "undefined" && obj.paging !== null) { 
		paging = "true";
	}
	show_content_loading(); 
	$.ajax({
		url : admin_url + module + "/ajax_pagination",
		data : $('#common_search').serialize() + "&paging="+paging,
		type : 'POST',
		dataType : "json",
		async:false,
		success : function(data) {
			hide_content_loading();
			if (data.status == "ok") {
				$(".append_html").html(data.html);

			}
		}
	});
}
/*reset form */
function reset_form()
{

	 $('#common_search').each(function() {
         this.reset();
     });
	  get_content({paging:"true"});	
}
/* Common show lodong content image */
function show_content_loading() {
	$(".cntloading_wrapper").addClass('active');
	$(".cnt_loading").show()
}

/* Common hide lodong content image */
function hide_content_loading() {
	$(".cntloading_wrapper").removeClass('active');
	$(".cntloading_wrapper").removeClass('active');
	$(".cnt_loading").hide();
}
