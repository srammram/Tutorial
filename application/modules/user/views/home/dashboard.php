
<?php echo $this->load->view('layout/left-menu'); ?>


<div class="clear" style="clear: both;height:3em"></div>
<div class="common">

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_red one accord active" onclick="accord(1)" title="one">
        <div class="half-circle"></div>
        <h3><?php echo $dashboard_count[0]['ongoing']; ?></h3>
        <p>Ongoing Project</p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_green two accord " onclick="accord(2)" title="two">
        <div class="half-circle"></div>
        <h3><?php echo $dashboard_count[0]['Upcoming']; ?></h3>
        <p>Upcoming Projects</p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 circle_yellow three accord " onclick="accord(3)" title="three">
        <div class="half-circle"></div>
        <h3><?php echo $dashboard_count[0]['Pipeline']; ?></h3>
        <p>Pipeline Projects</p>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section_accord">
    <div class="accord_box" id="one">
        <div class="card card-block">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
    </div>
    <div class="accord_box" id="two" style="display:none;">
        <div class="card card-block">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
    </div>
    <div class="accord_box" id="three" style="display:none;">
        <div class="card card-block">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.

        </div>
    </div>

</div>

<div class="row">
    <!-- bar chart -->

</div>
<div class="clearfix"></div>
</div>