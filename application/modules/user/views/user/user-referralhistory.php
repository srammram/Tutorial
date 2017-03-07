<div class="container-fluid">
	<div class="side-body">
	   <?php echo get_template('layout/notifications','')?>
		<div class="page-title">
			<span class="title"><?php echo $module_labels; ?></span>
            
        </div>

		<div class="row">
			<div class="col-xs-12">
				<div class="card ">
					<div class="card-header">

                        <div class="card-title"> 
                            
                            <?php echo form_open('',' id="common_search" class="form-inline"');?>
                             <?php  $search_array = array(
                             		 '' => get_label('select'),
                             	     'ref_friend_name' => get_label('name'),
                             		 'ref_friend_email' =>  get_label('email'));
                             
                             echo form_dropdown('search_field',$search_array,get_session_value($module."_search_field"));
                             
                             ?>
                            
                               
                                <?php echo form_input('search_value',get_session_value($module."_search_value"),'class="form-control"');?>
                                <button class="btn btn-primary" type="button" id="submit_search" onclick="get_content('')"><i class="fa fa-search"></i></button> <a class="btn btn-info"  id="reset_search"  href="<?php echo frontend_url().$module."/refresh"?>"><i class="fa fa-refresh"></i>&nbsp; Refresh</a> 
                             <?php echo form_close(); ?>                        </div>
                    </div>
					<div class="card-body">
                        
						
						
					  <?php echo form_open(admin_url().$module."/action",array("id"=>"mainform","class"=>"action_form"));?>
						<input  type="hidden"  name="postaction"  id="actionid" value=""> 
						<input  type="hidden"  name="changeId"  id="changeId"  value="">
						<input  type="hidden"  name="multiaction"  id="multiaction"  value="">
					    <input  type="hidden"  name="page_id"  id="page_id" value="0">
						<div class="cntloading_wrapper min_height" > <?php echo loading_image('cnt_loading');?>  <div class="append_html"></div></div>
							
                                    <?php // echo $paging;?>
                                  <?php echo form_close();?>  
                                             
                                </div>
				</div>
			</div>
		</div>

	</div>
</div>

<script>
/*  load initial content.. */
$(window).load(function(){
	  get_content({paging:"true"});
});
</script>