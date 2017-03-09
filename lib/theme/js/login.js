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
    return $('#emp_country,#emp_departments,#user_type,#emp_state,#emp_city,#emp_accessmenu').select2(
            /*{
             minimumResultsForSearch: Infinity
             }*/
            );

});
$(function () {
    return $('#emp_accessmenu').select2(
            {
                placeholder: 'Select Option'
            }
    );

});
$(function () {
    return $('#pro_team').select2(
            {
                placeholder: 'Select Teams'
            }
    );

});
function changereadonly(selectid, defaultid) {
    if (defaultid != 1 && selectid == 1) {
        $('#pro_start').removeAttr('readonly');
        $('#pro_finished').removeAttr('readonly');
        $('#pro_duration').removeAttr('readonly');
        $(function () {
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

            $("#pro_start").datepicker({
                todayBtn: 1,
                autoclose: true,
                todayHighlight: true,
                startDate: today,
                format: "yyyy-mm-dd",
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#pro_finished').datepicker('setStartDate', minDate);
                var cc = $('#pro_start').val();


            });

            $("#pro_finished").datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
            }).on('changeDate', function (selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#pro_start').datepicker('setEndDate', maxDate);
                var start_date = $('#pro_start').val();
                var end_date = $('#pro_finished').val();
                $.ajax({
                    url: FRONTEND_URL + 'calculatehours',
                    data: {start_date: start_date, end_date: end_date},
                    dataType: 'json',
                    type: 'post',
                    success: function (output) {
                        $('#pro_duration').val(output.total_hours);
                    }
                })
            });
        });
    }
}
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
function delete_actions(delete_id, delete_table) {
    var cc = confirm('Are You sure you want to delete this');

    if (cc == true) {
        $.ajax({
            url: FRONTEND_URL + 'delete_actions',
            dataType: 'json',
            data: {delete_id: delete_id, delete_table: delete_table},
            type: 'post',
            success: function (output) {
                alert(output.message);
                location.reload();
            }
        })
    } else {

    }
}
function editusertype(edit_id) {
    $.ajax({
        url: FRONTEND_URL + 'editusertype',
        data: {edit_id: edit_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#useredit').html(output);
        }
    })
}
function updateusertype(edit_id) {
    var edittype_name = $('#edittype_name').val();
    var edit_type_status = $('#edit_type_status').val();
    $.ajax({
        url: FRONTEND_URL + 'usertype/update',
        data: {edit_id: edit_id, edittype_name: edittype_name, edit_type_status: edit_type_status},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            $('#err_message').html(output.message);
            setInterval(function () {
                location.reload();
            }, 5000)
        }
    })
}
function editdepartments(edit_id) {
    $.ajax({
        url: FRONTEND_URL + 'editdepartment',
        data: {edit_id: edit_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#departmentsedit').html(output);
        }
    })
}
function editproject(edit_id) {
    $.ajax({
        url: FRONTEND_URL + 'projects/ediproject',
        data: {edit_id: edit_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#projectsedit').html(output);
        }
    })
}
function updatedepart(edit_id) {
    var editdepart_name = $('#editdepart_name').val();
    var edit_depart_status = $('#edit_depart_status').val();
    $.ajax({
        url: FRONTEND_URL + 'departments/update',
        data: {edit_id: edit_id, editdepart_name: editdepart_name, edit_depart_status: edit_depart_status},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            $('#err_message').html(output.message);
            setInterval(function () {
                location.reload();
            }, 5000)
        }
    })
}

function activate_users(activate_table, status) {
    var favorite = [];
    $.each($("input[name='empcheckid']:checked"), function () {
        favorite.push($(this).val());
    });
    var checkboxid = favorite.join(", ");
    $.ajax({
        url: FRONTEND_URL + 'activate',
        data: {activate_id: checkboxid, activate_table: activate_table, status: status},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            $('#empsucc_message').scrollTop(0);
            $('#empsucc_message').html(output.message);
            setInterval(function () {
                location.reload();

            }, 3000);
        }
    })
}
function projectselection(select_value) {
    if (select_value == 1) {
        $('#project_select').show();
        $('#pro_team').attr('required', 'required');
    } else {
        $('#project_select').hide();
        $('#pro_team').removeAttr('required');
    }
}

function asign_projects(project_id) {
    $.ajax({
        url: FRONTEND_URL + 'projects/assign_projects',
        data: {project_id: project_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#asignproject').html(output);
        }
    })
}
function asigned_projects(project_id) {
    $.ajax({
        url: FRONTEND_URL + 'projects/assigned_projects',
        data: {project_id: project_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#asignproject').html(output);
        }
    })
}
function assignprojects(duration_hours) {
    var n = $("input[name^='team_duration_hours']").length;

    var array_val = $("input[name^='team_duration_hours']");
    totalteamduration = 0;
    for (i = 0; i < n; i++)
    {
        teamdurationhours = array_val[i].value;
        totalteamduration = parseInt(totalteamduration) + parseInt(teamdurationhours);
    }
    if (totalteamduration != duration_hours) {
        alert("Team Duration Hour is not equal to project duration hours. Kindly Check this");
    } else {
        $.ajax({
            url: FRONTEND_URL + 'projects/asingnteam_byproject',
            data: $('#asign_project').serialize(),
            dataType: 'html',
            type: 'post',
            success: function (output) {
                $('#assign_err_message').html(output);
                setInterval(function () {
                    location.reload();
                }, 3000)
            }
        })
    }
}

/*####### Holiday  #########*/
function editholiday(edit_id) {
    $.ajax({
        url: FRONTEND_URL + 'editholiday',
        data: {edit_id: edit_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#holidayedit').html(output);
        }
    })
}
function updateholiday(edit_id) {
    var holiday_date = $('#holiday_date').val();
    var holiday_reason = $('#holiday_reason').val();
    var edit_status = $('#edit_status').val();
    $.ajax({
        url: FRONTEND_URL + 'holidays/update',
        data: {edit_id: edit_id, holiday_date: holiday_date, holiday_reason: holiday_reason, edit_status: edit_status},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            $('#err_message').html(output.message);
            setInterval(function () {
                location.reload();
            }, 5000)
        }
    })
}