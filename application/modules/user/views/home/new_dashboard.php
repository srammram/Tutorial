
<?php echo $this->load->view('layout/left-menu'); ?>


<div class="clear" style="clear: both;height:3em"></div>
<div class="common col-lg-12 col-md-6 col-md-offset-2 col-sm-12 col-xs-12">
    <div class="col-xs-offset-2  col-xs-8 text-center">
        <div id="chartdiv" style="height:300px"></div>
        <h5 class="text-center">Project status</h5>
    </div>

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

</div>

<div class="row">
    <!-- bar chart -->

</div>
<div class="clearfix"></div>
</div>