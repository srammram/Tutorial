<div class="pagination_bar">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
            <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
            <button class="btn btn-default multi_action" data="Deactivate"="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
            <button class="btn btn-default multi_action" data="Delete" type="button"><?php echo get_label('delete');?></button>
        </div>   
    </div>
    <div class="pagination_custom pull-right">
        <div class="pagination_txt">
            <?php echo show_record_info($total_rows,$start,$limit);?>
        </div>
        <?php echo $paging;?>
    </div>
    <div class="clear"></div>
</div>
<table class="table ">
	<thead class="first">
		<tr>
			<th>
                    <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  ');?>
            </th>
			<th><?=get_label('user_name');?></th>
			<th><?= get_label('user_referral_code');?></th>
			<th><?=get_label('user_email');?></th>
			<th><?=get_label('status');?></th>
			<th><?= get_label('created_on');?></th>
			<th><?=get_label('actions');?></th>

		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			?>
<tr>
			<th scope="row"><?php echo form_checkbox('id[]',$val['user_id'],'',' class="multi_check" ');?>
  
	
			
			<td><?php echo output_value($val['user_name']);?></td>
			<td><?php echo output_value($val['user_referral_id']);?></td>
			<td><?php echo output_value($val['user_email_address']);?></td>
			<td><a href="javascript:;"><?php echo show_status($val['user_status'],$val['user_id']);?></a>
	
	</td>
			<td><?php echo get_date_formart(($val['user_created_on']));?></td>
			<td><a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['user_id']);?>"
				data="Delete"><i class="fa fa-trash"
					title="<?php echo get_label('delete')?>"></i></a></td>
		</tr>
<?php  } } else { ?>
<tr class="no_records" >

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_label); ?></td>
		</tr>

<?php } ?>



	</tbody>
		<thead class="last">
		<tr>
			<th><?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_bottom" ');?></th>
			<th><?=get_label('user_name');?></th>
			<th><?= get_label('user_referral_code');?></th>
			<th><?=get_label('user_email');?></th>
			<th><?=get_label('status');?></th>
			<th><?= get_label('created_on');?></th>
			<th><?=get_label('actions');?></th>

		</tr>
	</thead>

</table>
    
				<div class="pagination_bar">
                    <div class="btn-toolbar pull-left">
                        <div class="btn-group">
                        <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
                        <button class="btn btn-default multi_action" data="Deactivate"="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
                        <button class="btn btn-default multi_action" data="Delete" type="button"> <?php echo get_label('delete');?></button>
                        </div>      
                    </div>
                    <div class="pagination_custom pull-right">
                        <div class="pagination_txt">
                            <?php echo show_record_info($total_rows,$start,$limit);?>
                        </div>
                        <?php echo $paging;?>
                    </div>
                    <div class="clear"></div>
				</div>
		