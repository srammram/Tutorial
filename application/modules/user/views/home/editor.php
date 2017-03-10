<textarea cols="40" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>"  class="form-control" style="height: 200px"><?php echo $field_value; ?></textarea>
<script>
        CKEDITOR.replace( '<?php echo $field_name; ?>',{
        	allowedContent: true,
        	forcePasteAsPlainText:	true,
    		toolbar :
            [
                ['Source','-','-'],
    			['PasteFromWord','-', 'SpellChecker'],
    			['SelectAll','RemoveFormat'],
    			['ImageButton'],
    			['Bold','Italic','Underline','-','Subscript','Superscript'],
    			['NumberedList','BulletedList','-','Blockquote'],
    			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    			['Link','Unlink','Anchor'],
    			['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
            ],
    		
            filebrowserBrowseUrl : '<?php echo load_lib();?>ckfinder/ckfinder.html',
    		filebrowserImageBrowseUrl : '<?php echo load_lib();?>ckfinder/ckfinder.html?Type=Images',
    		filebrowserFlashBrowseUrl : '<?php echo load_lib();?>ckfinder/ckfinder.html?Type=Flash',
    		filebrowserUploadUrl : '<?php echo load_lib();?>ckfinder/connector/php/connector.php?command=QuickUpload&type=Files',
    		filebrowserImageUploadUrl : '<?php load_lib();?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    		filebrowserFlashUploadUrl : '<?php load_lib();?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
    		skin:'moono'
    			} );
</script>