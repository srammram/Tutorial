<div class="pagination_bar">
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
			<th><?=get_label('friend_name');?></th>
			<th><?= get_label('friend_email');?></th>
			<th><?=get_label('status');?></th>
			<th><?= get_label('created_on');?></th>
		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			?>
<tr>
			<td><?php echo output_value($val['ref_friend_name']);?></td>
			<td><?php echo output_value($val['ref_friend_email']);?></td>
			<td><?php echo output_value($val['ref_email_status']);?></td>
			<td><?php echo output_value($val['ref_created_on']);?></td>

	</td>
			
		</tr>
<?php  } } else { ?>
<tr class="no_records" >

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_label); ?></td>
		</tr>

<?php } ?>



	</tbody>
		<thead class="last">
		<tr>
			<th><?=get_label('friend_name');?></th>
			<th><?= get_label('friend_email');?></th>
			<th><?=get_label('status');?></th>
			<th><?= get_label('created_on');?></th>

		</tr>
	</thead>

</table>
    
				<div class="pagination_bar">
                   
                    <div class="pagination_custom pull-right">
                        <div class="pagination_txt">
                            <?php echo show_record_info($total_rows,$start,$limit);?>
                        </div>
                        <?php echo $paging;?>
                    </div>
                    <div class="clear"></div>
				</div>
		