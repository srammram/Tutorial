<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 project_list">
    <div class="row">
        <?php
        $i = 1;
        foreach ($records as $det):
            $project_type_status = $det['project_type_status'];
            ?>
            <div class="col-xs-3" >
                <a href="javascript:void(0)" <?php if ($project_type_status != 2 && $project_type_status != 3): ?> data-toggle="modal" data-target="#DashboradModal" onclick="get_project_details(<?php echo $det['project_id']; ?>,<?php echo $record_id; ?>)" <?php endif; ?>   >
                    <div class="card-base">
                        <div class="card-icon">
                            <div title="Widgets" id="widgetCardIcon" class="imagecard"><span class="fa fa-globe"></span></div>
                            <div class="card-data widgetCardData">
                                <h2 class="box-title" style="color: #337AB7;"><?php echo $det['project_name']; ?></h2>
                                <hr>
                                <?php if ($record_id != 5 && $record_id != 6): ?>
                                    <p class="card-block text-center"><?php echo $det['project_description']; ?></p>
                                <?php else: ?>
                                    <p class="card-block text-center"><?php echo $det['task_name']; ?></p>
                                <?php endif; ?>
                                <hr>
                                <div class="btn btn-default" style="background: #337AB7; border: #337AB7; color: #fff;">More</div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </a>
            </div>
            <?php if (($i % 4 == 0)): ?>
                <div class="clear" style="clear: both;height:1em"></div>
            <?php endif; ?>
    <!--    <tr>
    <th><?php echo $det['id']; ?></th>
    <th><?php echo $det['project_name']; ?></th>
    <th><?php echo $det['project_description']; ?></th>
    <th><?php echo $det['projecttype_status']; ?></th>
    <th><?php echo $det['project_status']; ?></th>
    </tr>-->
            <?php
            $i++;
        endforeach;
        ?>
    </div>
</div>
<div class="modal fade" id="DashboradModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
                <h4 class="modal-title">Projects</h4>
            </div>
            <div id="get_dashboard_details" class="modal-body">

            </div>
            <div class="modal-footer" style="border-top:0px">
                <button type="button" class="btn btn-default" data-dismiss="modal" area-hidden="true">Close</button>
            </div>
        </div>

    </div>
</div>
