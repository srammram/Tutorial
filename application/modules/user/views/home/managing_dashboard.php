


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
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section_accord">
    <div class="accord_box" id="one">



    </div>
</div>

<div class="row">
    <!-- bar chart -->

</div>
<div class="clearfix"></div>
</div>