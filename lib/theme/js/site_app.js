$(function() {
	$(".navbar-expand-toggle").click(function() {
		$(".app-container").toggleClass("expanded");
		return $(".navbar-expand-toggle").toggleClass("fa-rotate-90");
	});
	return $(".navbar-right-expand-toggle").click(function() {
		$(".navbar-right").toggleClass("expanded");
		return $(".navbar-right-expand-toggle").toggleClass("fa-rotate-90");
	});
});

$(function() {
	return $('select').select2({
		minimumResultsForSearch: Infinity
	});

});

$(function() {
	return $('.toggle-checkbox').bootstrapSwitch({
		size : "small"
	});
});

$(function() {
	return $('.match-height').matchHeight();
});

/*******************************************************************************
 * * removed tadatable - devteam $(function() { return
 * $('.datatable').DataTable({ "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>'
 * }); });
 ******************************************************************************/

$(function() {
	return $(".side-menu .nav .dropdown").on('show.bs.collapse', function() {
		return $(".side-menu .nav .dropdown .collapse").collapse('hide');
	});
});
/* Common form validation and for submit - start */
var loading_icon = get_loading_icon('form_submit col-sm-offset-2 col-sm-4 ');
$("#user_registration_form").validate({
	// errorElement: "span",
	// errorClass:"field_err",
	ignore : "",

	submitHandler : function() {
		$(".alert_msg").hide();
		$(".btn_submit_div").hide();
		$(".btn_submit_div").before(loading_icon);

		$("#user_registration_form").ajaxSubmit({
			type : "POST",
			dataType : "json",
			url :  admin_url + module + "/" + module_action,
			data : $("#user_registration_form").serialize(),
			cache : false,
			success : function(data) {
				response = data;
				$(".btn_submit_div").show();
				$(".form_submit").remove();

				if (response.status == "success") {

					window.location.href = admin_url + module;
				} else if (response.status == "error") {
					$(".alert_msg").show().html(data.message);
					$('.side-body').scrollView();
					
				}

			}
		});

	}
});

/* Common form validation and for submit - start */
var loading_icon = get_loading_icon('form_submit col-sm-offset-2 col-sm-4 ');
$("#common_form").validate({
	// errorElement: "span",
	// errorClass:"field_err",
	ignore : "",

	submitHandler : function() {
		$(".alert_msg").hide();
		$(".btn_submit_div").hide();
		$(".btn_submit_div").before(loading_icon);

		$("#common_form").ajaxSubmit({
			type : "POST",
			dataType : "json",
			url :  admin_url + module + "/" + module_action,
			data : $("#common_form").serialize(),
			cache : false,
			success : function(data) {
				response = data;
				$(".btn_submit_div").show();
				$(".form_submit").remove();

				if (response.status == "success") {

					window.location.href = admin_url + module;
				} else if (response.status == "error") {
					$(".alert_msg").show().html(data.message);
					$('.side-body').scrollView();
					
				}

			}
		});

	}
});

/* Common form validation and for submi - end */
/** Referral Form Start **/
$("#referral_form").validate({
	// errorElement: "span",
	// errorClass:"field_err",
	ignore : "",
	
	submitHandler : function() {
		$(".alert_msg").hide();
		$(".btn_submit_div").hide();
		$(".btn_submit_div").before(loading_icon);

		$("#referral_form").ajaxSubmit({
			type : "POST",
			dataType : "json",
			url :  admin_url + module + "/" + module_action,
			data : $("#referral_form").serialize(),
			cache : false,
			success : function(data) {
				response = data;
				$(".btn_submit_div").show();
				$(".form_submit").remove();

				if (response.status == "success") {

					window.location.href = admin_url + module;
				} else if (response.status == "error") {
					$(".alert_msg").show().html(data.message);
					$('.side-body').scrollView();
					
				}

			}
		});

	}
});
/** End of Referral Form **/
/* hide error on chnage the select box... */
$(document).ready(function() {
	$('select').change(function() {
		$(this).parents('.col-sm-4').find('.error').hide();
	});
	
	
});
/* Add Multi field   */
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="form-group"><div class="col-sm-4"><input class="form-control" type="text" name="friend_name[]" value="" Placeholder="Name" /></div><div class="col-sm-5"><input type="text" name="friend_email[]" value="" class="form-control" Placeholder="Email" /></div><a href="javascript:void(0);" class="remove_button" title="Remove field"> <i class="fa fa-times-circle-o fa-2x"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

/* get loading icon */
function get_loading_icon(class_name) {
	return loding_img = "<div class=\""
			+ class_name
			+ " loading\"><img src=\""
			+ lod_lib
			+ "theme/images/loading_icon_default.gif\" class=\"\" alt=\"Loading...\" /> </div>";

}

/*show  alert message*/
function showerror(errorclas,errormessage)
{ 
    $(".common_shower").remove();
    $('.side-body').prepend('<div class="all_notice '+errorclas+'">'+errormessage+'</div>').slideDown(500);
	$('.common_shower').delay(7000).slideUp(function(){$(this).remove();});
	 
}



/*scrool to top */
$.fn.scrollView = function () { 
	  return this.each(function () {
	    $('html, body').animate({
	      scrollTop: $(this).offset().top
	    }, 1000);
	  });
	}
