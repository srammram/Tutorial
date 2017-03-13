<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 project_list">
    <div class="row">
        <?php
        $i = 1;
        foreach ($records as $det):
            ?>

            <div class="col-xs-3" data-toggle="modal" data-target="#myModal" >
                <a href="#">
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
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Projects</h4>
                        </div>
                        <div class="modal-body">
                            <p>Project Title = <?php echo $det['project_name']; ?></p>
                            <p>Project Description = <?php echo $det['project_description']; ?></p>
                            <p>Estimated Hours = <?php echo $det['time_duration']; ?></p>
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
            <?php
            $i++;
        endforeach;
        ?>
    </div>
</div>

