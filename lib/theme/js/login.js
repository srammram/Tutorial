$(function () {

    $('#login-form-link').click(function (e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#forgot-form").fadeOut(100);
        $("#login-form-link").text('Login');
        $('#forgot-form-link').removeClass('active');
        $('#hide-login-link').hide();
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#forgot-form-link').click(function (e) {
        $("#forgot-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $("#login-form-link").text('Forgot Password');
        $("#hide-login-link").show();
        $(this).addClass('active');
        e.preventDefault();
    });

});
$(document).ready(function () {
    $("#selectall").change(function () {
        var status = this.checked;
        $('.selectthis').each(function () {
            this.checked = status;
        });
    });

    $('.selectthis').change(function () { //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if (this.checked == false) { //if this item is unchecked
            $("#selectall")[0].checked = false; //change "select all" checked status to false
        }

        //check "select all" if all checkbox items are checked
        if ($('.selectthis:checked').length == $('.selectthis').length) {
            $("#selectall")[0].checked = true; //change "select all" checked status to true
        }
    });
})
$(function () {
    return $('#emp_country,#emp_departments,#user_type').select2(
            /*{
             minimumResultsForSearch: Infinity
             }*/
            );

});
function get_state_by_country_id(country_id) {

    var countryid = country_id;
    $.ajax({
        url: FRONTEND_URL + 'get_state_by_country_id',
        dataType: 'json',
        data: {country_id: countryid},
        type: 'post',
        success: function (output) {
            var select = $("#emp_state"), options = '';
            select.empty();
//            select.select2('destroy');
            if (output.length == 0 || output.length != 0) {
                options += "<option value=''>Please select</option>";
            }
            for (var i = 0; i < output.length; i++)
            {
                options += "<option value='" + output[i].id + "'>" + (output[i].name) + "</option>";
            }
            select.append(options);
            select.select2();
        }
    })


}
function get_city_by_state_id(state_id) {

    var countryid = $('#emp_country').val();
    var state_id = state_id;
    $.ajax({
        url: FRONTEND_URL + 'get_city_by_state_id',
        dataType: 'json',
        data: {country_id: countryid, state_id: state_id},
        type: 'post',
        success: function (output) {
            var select = $("#emp_city"), options = '';
            select.empty();
//            select.select2('destroy');
            if (output.length == 0 || output.length != 0) {
                options += "<option value=''>Please select</option>";
            }
            for (var i = 0; i < output.length; i++)
            {
                options += "<option value='" + output[i].id + "'>" + (output[i].name) + "</option>";
            }
            select.append(options);
            select.select2();
        }
    })


}
