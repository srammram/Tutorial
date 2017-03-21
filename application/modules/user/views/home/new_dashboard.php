
<?php echo $this->load->view('layout/left-menu'); ?>


<div class="clear" style="clear: both;height:3em"></div>
<div class="common col-lg-12 col-md-6 col-md-offset-2 col-sm-12 col-xs-12">
    <div class="col-xs-offset-2  col-xs-8 text-center">
        <h4>Current Weelkly Report</h4>
        <?php $workchart = json_encode($chart_total); ?>
        <div id="chartdiv" style="height:300px"></div>
        <h5 class="text-center">Project status</h5>
    </div>
    
    <?php if ($_SESSION['user_type_id'] == 1): ?>
    	<input type="hidden" name="project_user_type" id="project_user_type" value="<?php echo '1'; ?>">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 circle_red one accord active" onclick="accord(1)" title="one" >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($dashboard_count) != '0' ? $dashboard_count[0]['ongoing'] : '0'; ?></div>
                            <div>All Ongoing Project</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 circle_green two accord " onclick="accord(2)" title="two">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-building-o fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($dashboard_count) != '0' ? $dashboard_count[0]['Upcoming'] : '0'; ?></div>
                            <div>All Upcoming Project</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 circle_yellow three accord " onclick="accord(3)" title="three">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-database fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($dashboard_count) != '0' ? $dashboard_count[0]['Pipeline'] : '0'; ?></div>
                            <div>All pipeline Project</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 circle_blue four accord " onclick="accord(4)" title="four">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-battery-full fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($dashboard_count) != '0' ? $dashboard_count[0]['completed'] : '0'; ?></div>
                            <div>Completed Project</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <?php
    elseif ($_SESSION['user_type_id'] == 4):
        ?>
        <input type="hidden" name="project_user_type" id="project_user_type" value="<?php echo '1'; ?>">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_red one accord active" onclick="accord(1)" title="one" >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($dashboard_count) != '0' ? $dashboard_count[0]['ongoing'] : '0'; ?></div>
                            <div>All Ongoing Project</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_red five accord" onclick="accord(5)" title="five" >
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($assigned_count) != '0' ? $assigned_count[0]['assigned_count'] : '0'; ?></div>
                            <div>Assigned Tasks</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_red six accord" onclick="accord(6)" title="six" >
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($my_tasks_count) != '0' ? $my_tasks_count[0]['my_tasks_count'] : '0'; ?></div>
                            <div>My Tasks</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>
    <?php elseif ($_SESSION['user_type_id'] == 5): ?>
    <input type="hidden" name="project_user_type" id="project_user_type" value="<?php echo '7'; ?>">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_red seven accord active" onclick="accord(7)" title="seven" >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($asigned_project_count) != '0' ? $asigned_project_count[0]['asigned_project_count'] : '0'; ?></div>
                            <div>Assigned Projects</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_red five accord" onclick="accord(5)" title="five" >
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($assigned_count) != '0' ? $assigned_count[0]['assigned_count'] : '0'; ?></div>
                            <div>Assigned Tasks</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_red six accord" onclick="accord(6)" title="six" >
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($my_tasks_count) != '0' ? $my_tasks_count[0]['my_tasks_count'] : '0'; ?></div>
                            <div>My Tasks</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>
    <?php elseif ($_SESSION['user_type_id'] == 6): ?>
    <input type="hidden" name="project_user_type" id="project_user_type" value="<?php echo '6'; ?>">
        <div class="col-xs-offset-3 col-xs-6 circle_red six accord active" onclick="accord(6)" title="six" >
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo count($my_tasks_count) != '0' ? $my_tasks_count[0]['my_tasks_count'] : '0'; ?></div>
                            <div>My Tasks</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"></span>
                        <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

        </div>
    <?php endif; ?>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section_accord">
    <div class="accord_box" id="one">

    </div>
    <div class="accord_box" id="two" style="display:none;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 project_list">
            <div class="row">
                <div class="col-xs-3" data-toggle="modal" data-target="#myModal" >
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 1</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Projects</h4>
                            </div>
                            <div class="modal-body">
                                <p>Project Title =</p>
                                <p>Project Description =</p>
                                <p>Start Date =</p>
                                <p>End Date =</p>
                                <p>Estimated Hours =</p>
                                <p>Used Hours =</p>
                                <p>Team Involved =</p>
                                <p>Current Status =</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 2</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 3</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 4</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clear" style="clear: both;height:3em"></div>
            <div class="row">
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 5</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 6</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="accord_box" id="three" style="display:none;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 project_list">
            <div class="row">
                <div class="col-xs-3" data-toggle="modal" data-target="#myModal" >
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 1</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Projects</h4>
                            </div>
                            <div class="modal-body">
                                <p>Project Title =</p>
                                <p>Project Description =</p>
                                <p>Start Date =</p>
                                <p>End Date =</p>
                                <p>Estimated Hours =</p>
                                <p>Used Hours =</p>
                                <p>Team Involved =</p>
                                <p>Current Status =</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 2</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 3</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 4</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clear" style="clear: both;height:3em"></div>

            <!--<div class="row">
                    <div class="col-xs-12 text-center pagination">
                            <ul class="pagination">
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                      </ul>
                    </div>
            </div>-->
        </div>
    </div>
    <div class="accord_box" id="four" style="display:none;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 project_list">
            <div class="row">
                <div class="col-xs-3" data-toggle="modal" data-target="#myModal" >
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 1</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Projects</h4>
                            </div>
                            <div class="modal-body">
                                <p>Project Title =</p>
                                <p>Project Description =</p>
                                <p>Start Date =</p>
                                <p>End Date =</p>
                                <p>Estimated Hours =</p>
                                <p>Used Hours =</p>
                                <p>Team Involved =</p>
                                <p>Current Status =</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 2</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 3</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 4</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clear" style="clear: both;height:3em"></div>

            <!--<div class="row">
                    <div class="col-xs-12 text-center pagination">
                            <ul class="pagination">
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                      </ul>
                    </div>
            </div>-->
        </div>
    </div>
    <div class="accord_box" id="five">



    </div>
    <div class="accord_box" id="six">



    </div>
    <div class="accord_box" id="seven">



    </div>

</div>
<script>
    var chartData = <?php echo $workchart; ?>;
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        "marginRight": 70,
        "dataProvider": chartData,
        "valueAxes": [{
                "axisAlpha": 1,
                "position": "left",
                "title": "Time Durations"
            }],
        "startDuration": 1,
        "graphs": [{
                "balloonText": "<b>[[hours]]: [[value]]</b><br>[[performance]]:<b>[[status]]</b>",
                "fillColorsField": "color",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "time",
                "valueField2": "status",
                "valueField3": "status",
            }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "datevalue",
        "categoryField2": "performance",
        "categoryField3": "hours",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 0
        },
        "export": {
            "enabled": true
        }

    });
</script>
<div class="row">
    <!-- bar chart -->

</div>
<div class="clearfix"></div>
</div>
<script>
$(window).load(function() {
	var title = $("#project_user_type").val();
    $.ajax({
        url: FRONTEND_URL + 'getdashboard_details',
        data: {id: title},
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('#one').html(output);
        }
    })
});
</script>