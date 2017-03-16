<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 project_list">
    <div class="row">
        <?php
        $i = 1;
//        print_r($records);
        foreach ($records as $det):
            ?>

            <div class="col-xs-3"  >
                <a href="#" onclick="get_project_details(<?php echo $det['id']; ?>,<?php echo $record_id; ?>)" data-toggle="modal" data-target="#DashboradModal">
                    <div class="boxTile">
                        <div class="square info easeAni">
                            <div class="text">
                                <h2><?php echo $det['project_name']; ?></h2>
                            </div>
                        </div>
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
            <div class="modal-body" id="get_dashboard_details">

            </div>
            <div class="modal-footer" style="border-top:0px">
                <button type="button" class="btn btn-default" data-dismiss="modal" area-hidden="true">Close</button>
            </div>
        </div>

    </div>
</div>
