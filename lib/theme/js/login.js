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
    return $('#select_project,#select_departments,#emp_country,#asign_departments,#asign_user_details,#asign_project,#asign_usertype,#emp_departments,#user_type,#emp_state,#emp_city,#emp_accessmenu').select2(
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
function getdepartments(usertype_id) {
    if (usertype_id > 4) {
        $('#departments_details').show();
        $('#asign_departments').attr('required', 'required');

    } else {
        $('#departments_details').hide();
        $('#asign_departments').removeAttr('required');
        get_user_details(department_id = '');
    }
}
function changereadonly(selectid, defaultid) {
    if (defaultid != 1 && selectid == 1) {
        $('#pro_start').removeAttr('readonly');
        $('#pro_finished').removeAttr('readonly');
        $('#pro_duration').removeAttr('readonly');
        $('#dropzonefiles').show();
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
    } else {
        $('#pro_start').attr('readonly', 'readonly');
        $('#pro_finished').attr('readonly', 'readonly');
        $('#pro_duration').attr('readonly', 'readonly');
        $('#dropzonefiles').hide();
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
function edittask(edit_id) {
    $.ajax({
        url: FRONTEND_URL + 'tasks/edittask',
        data: {edit_id: edit_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#taskedit').html(output);
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
function getassignedproject_details(project_id) {
    $.ajax({
        url: FRONTEND_URL + 'projects/view_assigned_project',
        data: {project_id: project_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#viewassignedproject').html(output);
        }
    })
}
function downloadFile(str) {
//alert(str);
    $.ajax({
        type: 'POST',
        url: FRONTEND_URL + 'projects/downloadfiles',
        data: {filename: str},
        success: function (data) {
            alert(data);
        }
    });
}
function changestatus_forteamprojects(project_id) {
    $.ajax({
        url: FRONTEND_URL + 'projects/changestatus_fromteam',
        data: {project_id: project_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#changeasignproject').html(output);
        }
    })
}
function changetaskstatus(task_id) {

}
function get_reporting_person(user_type_id) {
    var emp_departments = $('#emp_departments').val();
    $.ajax({
        url: FRONTEND_URL + 'get_reporting_person_by_user_type',
        data: {user_type_id: user_type_id, emp_departments: emp_departments},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            var select = $("#reporting_person"), options = '';
            select.empty();
//            select.select2('destroy');
            if (output.length == 0 || output.length != 0) {
                options += "<option value=''>Please select</option>";
            }
            for (var i = 0; i < output.length; i++)
            {
                options += "<option value='" + output[i].id + "'>" + (output[i].user_name) + "</option>";
            }
            select.append(options);
            select.select2();
        }
    })
}
function get_tasks_employee(project_id) {
    $.ajax({
        url: FRONTEND_URL + 'tasks/get_task_by_project',
        data: {project_id: project_id},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            var select = $("#task_title"), options = '';
            select.empty();
//            select.select2('destroy');
            if (output.length == 0 || output.length != 0) {
                options += "<option value=''>Please select</option>";
            }
            for (var i = 0; i < output.length; i++)
            {
                options += "<option value='" + output[i].task_title + "'>" + (output[i].task_title) + "</option>";
            }
            select.append(options);
            select.select2();
        }
    })
}
function getnewtask_details(project_id) {

    $.ajax({
        url: FRONTEND_URL + 'tasks/getnewtask_details',
        data: {project_id: project_id},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            var select = $("#add_selected_task"), options = '';
            select.empty();
//            select.select2('destroy');
            if (output.length == 0 || output.length != 0) {
                options += "<option value=''>Please select</option>";
            }
            for (var i = 0; i < output.length; i++)
            {
                options += "<option value='" + output[i].id + "'>" + (output[i].task_name) + "</option>";
            }
            select.append(options);
            select.select2();
        }
    })
}
function edittaskdetails(task_id) {
    $.ajax({
        url: FRONTEND_URL + 'tasks/edit_new_task',
        data: {task_id: task_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#edit_new_task').html(output);
        }
    })
}
function edit_asign_task(task_id) {
    $.ajax({
        url: FRONTEND_URL + 'tasks/edit_asign_task',
        data: {task_id: task_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#edit_asign_task').html(output);
        }
    })
}
function view_asign_task(task_id) {
    $.ajax({
        url: FRONTEND_URL + 'tasks/view_asign_task',
        data: {task_id: task_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#view_asign_task').html(output);
        }
    })
}
function check_status(status_id) {
    if (status_id == 5) {
        $('#finished_hours_div').show();
    } else {
        $('#finished_hours_div').hide();
    }
}
function get_project_details(project_id, record_id) {
    $.ajax({
        url: FRONTEND_URL + 'user/get_project_details',
        data: {project_id: project_id, record_id: record_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#get_dashboard_details').html(output);
        }
    })
}
function get_user_details(department_id) {

    var user_type_id = $('#asign_usertype').val();

    $.ajax({
        url: FRONTEND_URL + 'tasks/get_user_details',
        data: {user_type_id: user_type_id, department_id: department_id},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#employee_details').html(output);
        }
    })
}
function checkstatus_withfinished(status_id) {
    if (status_id == 5) {

        var finisehd_hours = $('#finished_hours').val();
        var add_duration_hours = $('#add_duration_hours').val();
        var project_duration = $('#estimated_hours').val();
        var total_hours = parseInt(finisehd_hours) + parseInt(add_duration_hours);
        if (total_hours > project_duration) {
            $('#delay_reason_div').show();
        } else {
            $('#delay_reason_div').hide();
        }

    } else {
        $('#finished_div').hide().slideUp();
        $('#add_finished_duration_hours').removeAttr('required');
        $('#add_finished_message').removeAttr('required');
    }

}
function getfinished_hours(task_id) {

    var project_id = $('#add_project').val();
    if (project_id == 'others') {
        $('#assigneddiv').hide();
    } else {
        $.ajax({
            url: FRONTEND_URL + 'tasks/getfinished_hours',
            data: {task_id: task_id, project_id: project_id},
            dataType: 'json',
            type: 'post',
            success: function (output) {

                if (project_id != 'others') {
                    $('#finished_hours').val(output.finished_hours);
                    $('#estimated_hours').val(output.project_duration);
                    $('#assginehours').val(output.project_duration);
                    $('#assginestartdate').val(output.start_datetime);
                    $('#assgineenddate').val(output.end_datetime);
                    $('#assigneddiv').show();
                } else {
                    $('#assginehours').hide();
                    $('#assginestartdate').hide();
                    $('#assgineenddate').hide();
                }
            }
        });
    }
}


function getavalablehours(project_id) {
    $.ajax({
        url: FRONTEND_URL + 'tasks/getavailablehours',
        data: {project_id: project_id},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            $('#asign_available_hours').val(output.available_hours);
        }
    })
}
function check_available_hours(duration_hours) {
    var asign_available_hours = $('#asign_available_hours').val();
    if (asign_available_hours < duration_hours) {
        alert("Enter Hours is not equal to available hours. Check this available hours");
        $('#add_duration_hours').val('');
    }

}
function getemployees(department_id) {
    $.ajax({
        url: FRONTEND_URL + 'getemployees_by_department_id',
        data: {department_id: department_id},
        dataType: 'json',
        type: 'post',
        success: function (output) {
            var select = $("#select_employee"), options = '';
            select.empty();
//            select.select2('destroy');
            if (output.length == 0 || output.length != 0) {
                options += "<option value=''>Please select</option>";
            }
            for (var i = 0; i < output.length; i++)
            {
                options += "<option value='" + output[i].id + "'>" + (output[i].user_name) + "</option>";
            }
            select.append(options);
            select.select2();
        }
    })
}
function get_filter_reports() {

    $('#reporting_table').html('<img src="' + BASE_URL + 'media/default/loading_images.gif" style="vertical-align:middle">');
    $.ajax({
        url: FRONTEND_URL + 'reporting',
        data: $('#filter_form').serialize(),
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#reporting_table').html(output);
        }
    })
}
/*####### Dashboard js  #########*/
function accord(title)
{

    $(".accord_box").hide();
    $(".accord").removeClass('active');
    if (title == 1) {
        var id = 'one';
        $("." + id).addClass('active');
    } else if (title == 2) {
        var id = 'two';
        $("." + id).addClass('active');
    } else if (title == 3) {
        var id = 'three';
        $("." + id).addClass('active');
    } else if (title == 4) {
        var id = 'four';
        $("." + id).addClass('active');
    } else if (title == 5) {
        var id = 'five';
        $("." + id).addClass('active');
    } else if (title == 6) {
        var id = 'six';
        $("." + id).addClass('active');
    }

    $("#" + id).show();
    $.ajax({
        url: FRONTEND_URL + 'getdashboard_details',
        data: {id: title},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#' + id).html(output);
        }
    })

}