<?php echo $this->load->view('layout/left-menu'); ?>

<h1>Add Dependency</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Dependency</h3>
        </div>
        <div class="panel-body">
            <form name="add_dependency_form" data-parsley-validate="" id="add_dependency_form" method="post" action="<?php echo frontend_url() . 'tasks/insert_dependency' ?>">
                <div class="form-group">
                    <label>Select Project <span style="color:red">*</span></label>
                    <select required="" name="select_project" id="select_project" class="form-control" onchange="get_dependency_task_details(this.value)">
                        <option value="">-Select Project-</option>
                        <?php
                        foreach ($project_details as $details):
                            ?>
                            <option value="<?php echo $details['projects_id']; ?>"><?php echo $details['project_name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div id="task_details">
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-8">
                        <input type="submit" name="dependency_submit" id="dependency_submit" class="btn btn-success" value="Add"/>
                        <input type="reset" name="dependency_clear" id="dependency_clear" class="btn btn-danger" value="Clear"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>