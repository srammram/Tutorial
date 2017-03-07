 <title><?php  echo get_label('site_title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php load_meta_tags(isset($data)); ?>
    
    <?php
	if(!empty($facebook_url)){
	?>
    <meta property="og:url"                content="<?php echo $facebook_url; ?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?php echo $facebook_title; ?>" />
    <meta property="og:description"        content="<?php echo $facebook_summary; ?>" />
    <meta property="og:image"              content="<?php echo $facebook_image; ?>" />
	<?php
	}
	?>
    
    <!-- Fonts -->
    <link href='<?php echo  load_font('google_lato.css')?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo  load_font('google_roboto_condensed.css')?>' rel='stylesheet' type='text/css'>  
   
    <link href='<?php echo skin_url(); ?>css/style.css' rel='stylesheet' type='text/css'>
    <link href='<?php echo skin_url(); ?>css/pgwslideshow.min.css' rel='stylesheet' type='text/css'>
   
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>font-awesome/font-awesome.min.css">
       
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo skin_url();?>css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo skin_url();?>css/jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo skin_url();?>css/minimal-white/rs-minimal-white.css"></link>
	
	<link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/dropzone.css">
    
    <!-- CSS App -->
    
   <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/custom.css">
   <link rel="stylesheet" type="text/css" href="<?php echo load_lib(); ?>theme/css/jquery.tagit.css">
<link rel="stylesheet" type="text/css" href="<?php echo load_lib(); ?>theme/css/tagit.ui-zendesk.css">
   <?php echo load_css(array('style.css','pgwslideshow.min.css')); ?>
    <!--  load js  -->   
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.form.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/additional-methods.min.js"></script>
	
	<script type="text/javascript" src="<?php echo load_lib();?>theme/js/dropzone.js"></script>
	
 	<script>
      var BASE_URL =  "<?php echo frontend_url();?>";
      var SITE_URL =  "<?php echo frontend_url();?>";    
    </script>
	<script src="http://jwpsrv.com/library/qVj+DnDmEeOpQCIACi0I_Q.js" type="text/javascript"></script>
   
   <!-- <script type="text/javascript" src="<?php echo skin_url(); ?>js/jquery-3.1.1.min.js"></script>-->
	<script type="text/javascript" src="<?php echo skin_url(); ?>js/pgwslideshow.min.js"></script>
	<script type="text/javascript" src="<?php echo skin_url(); ?>js/common.js"></script>
	<!-- Chart and Map js -->
	<script type="text/javascript" src="<?php echo load_lib();?>amcharts/amcharts.js"></script>
	<script type="text/javascript" src="<?php echo load_lib();?>amcharts/pie.js"></script>
	<script type="text/javascript" src="<?php echo load_lib();?>amcharts/serial.js"></script>
	<!-- Map Js -->
	<script type="text/javascript" src="<?php echo load_lib();?>ammap/ammap.js"></script>
	<script type="text/javascript" src="<?php echo load_lib();?>ammap/themes/light.js"></script>

<?php /* common javascript varibles ...*/ ?>
<script>
 var admin_url ="<?php echo frontend_url(); ?>";
 var lod_lib = "<?php echo load_lib(); ?>";
 var module ="<?php echo $module; ?>";
 var module_label = "<?php echo $module_label; ?>";
 var module_labels = "<?php echo $module_labels; ?>";
 var module_action  = "<?php echo (isset($module_action)? $module_action : '' );?>"; 
 var secure_key = "<?php echo $this->security->get_csrf_hash(); ?>";
</script>

<script type="text/javascript">

 <?php /* Change  status */ ?>  
$(document).ready(function(){

$('body').on('click', '.status,.delete_record', function() { 
var id = this.id;
var action = $(this).attr('data');

  if ( (typeof (id) != 'undefined') && (typeof (action) != 'undefined') )
  {
	  var result= confirm_alert("Are you sure you want to " + action + " this "+ module_label + "?");	
		 if(result)
		  {
		   $("#actionid").val(action);
		   $("#changeId").val(id);  
		   action_submit( {id:id, action: action });	
	      }

	      return false;
  }
 
});

<?php /* check and uncheck all rdio buttons  */ ?>
		$('body').on('click', '.multicheck_top, .multicheck_bottom', function() {     
	 		if($(this).is(':checked')==true)
	  		{  
	    		  $('.multi_check,.multicheck_top, .multicheck_bottom').attr("checked", "checked");
	    		   $('.multi_check,.multicheck_top, .multicheck_bottom').prop('checked', true);
	  		}
	 		else
	  		{       
	    		$(".multi_check,.multicheck_top, .multicheck_bottom").removeAttr("checked");  
	    		 $('.multi_check,.multicheck_top, .multicheck_bottom').prop('checked', false);
	   		}     
	  	});

<?php /*  if check all checkbox selct parent check box */  ?>
	$('body').on('click', '.multi_check', function() { 
	var multichecklength = $('.multi_check').length;
	var multiunchecklength = $('.multi_check:checked').length; 
		if(multichecklength == multiunchecklength)
	{
		 $(".multicheck_top, .multicheck_bottom").attr('checked','checked');
		  $('.multicheck_top, .multicheck_bottom').prop('checked', true);
	}
	else
	{
		$(".multicheck_top, .multicheck_bottom").removeAttr('checked');
		  $('.multicheck_top, .multicheck_bottom').prop('checked', false);
	}
});

<?php /* Submit action form   */ ?>
function action_submit(str)
{
	id = str.id;
	show_content_loading();
  $.ajax({
        url: admin_url+module+"/action",
        data :  $('#mainform').serialize(),
        type :'POST', 
        dataType:"json",
        success:function(data){
        hide_content_loading();
	        
        	if(data.status=="success") { 

	        	 if(data.action=="Activate") {

                      if(data.multiaction == "Yes")
                       {
                    	  $('input[type=checkbox]').each(function () {
		                      if(this.checked)
		                 		 {  
		                             $(this).parents('tr').find('.status').removeClass('fa-lock').addClass('fa-unlock');
		                             $(this).parents('tr').find('.status').attr('title', 'Active');
		                             $(this).parents('tr').find('.status').attr('data', 'Deactivate');
		                 		 }
                    	  });

                       }
                      else
                       {
                    	  $('#'+ id ).removeClass('fa-lock').addClass('fa-unlock');
 		        		  $('#'+ id  ).attr('title', 'Active');
 		        		  $( '#'+ id ).attr('data', 'Deactivate');
                       }
		        	    	        		 
	        		 }
	
	         	if(data.action=="Deactivate") { 
			         		if(data.multiaction == "Yes")
		                    {

			         			$('input[type=checkbox]').each(function () {
				                      if(this.checked)
				                 		 {  
				                             $(this).parents('tr').find('.status').removeClass('fa-unlock').addClass('fa-lock');
				                             $(this).parents('tr').find('.status').attr('title', 'Inactive');
				                             $(this).parents('tr').find('.status').attr('data', 'Activate');
				                 		 }
		                    	  });
		                    	  
		                    }
			         		else
				         	{
			         			$('#'+ id ).removeClass('fa-unlock').addClass('fa-lock');
				         		$('#'+ id  ).attr('title', 'Inactive');
				         		$('#'+ id  ).attr('data', 'Activate');
			         		}
		         		
	            	}

	        	if(data.action=="Delete") { 
                    var page_id = $("#page_id").val();
	         		get_content({ page : page_id });
	         	
            	 }

	        	 $(".multi_check, .multicheck_top, .multicheck_bottom").removeAttr("checked");  
	    		 $('.multi_check, .multicheck_top, .multicheck_bottom').prop('checked', false);
	    		 $("#multiaction").val('');
	    		 $("#actionid").val();
        	}
        }
    });
}

<?php /*  multiselct action */ ?>
$('body').on('click', '.multi_action', function() { 

	 var this_action  = $(this).attr('data');  
	if($(".multi_check:checked").length < 1)
    {
    	alert("<?php echo $this->lang->line("alert_multibleaction");?>");
    	$("#multiselect").val('');
    	return false;
 	} 
	if ( typeof (this_action) != 'undefined' )
	  {

	 <?php /*   Activate action  */?>
		if(this_action=="Activate")
		{    
			var result= confirm_alert("<?php echo sprintf($this->lang->line('confirm_activate'), ucfirst($module_labels)); ?>");	
			if(result)
			 {  
	   			$("#actionid").val("Activate");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 }else{
					$("#multiaction").val('');
			 }
		}

		<?php /*   deactivation action  */?>
		if(this_action=="Deactivate")
		{    
			var result= confirm_alert("<?php echo sprintf($this->lang->line('confirm_deactivate'), ucfirst($module_label)); ?>");	
			if(result)
			 {  
	   			$("#actionid").val("Deactivate");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 }else{
					$("#multiaction").val('');
			 }
		}

		<?php /*  Delete  action  */?>
		if(this_action=="Delete")
		{    
			var result= confirm_alert("<?php echo sprintf($this->lang->line('confirm_delete'), ucfirst($module_labels)); ?>");	
			if(result)
			 {  
	   			$("#actionid").val("Delete");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 }else{
					$("#multiaction").val('');
			 }
		}
		
	 } 	
 	
});

}); /* end of ready */

<?php /*  alert for conformation in multible actions  */ ?>
function confirm_alert(error)
{
	var x=window.confirm(error);
	if (x) { 
            return true;
	} else {
	        return false;
	}
}

<?php /* cancel form to redirect parent module  */ ?>
function cancelform(url)
{ 
    var url;
	window.location=url; 
}
</script>

<?php
if(!empty($homepageurl)){
?>
<!-- Loading -->
<div class="load_div" id="load_div">
<img src="<?php echo media_url('loading.gif'); ?>">
</div> 
<?php
}
?> 
    
