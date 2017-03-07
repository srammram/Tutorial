
<?php  if($this->session->flashdata('admin_error'))
{ ?>

<div role="alert" class="alert alert-danger alert-dismissible cmmn_error">
    <i class="fa fa-exclamation-circle"></i>
   <?php echo $this->session->flashdata('admin_error');?>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>         
        </div>


       
<?php   
}
elseif($this->session->flashdata('admin_warning')) { ?>       

 <div role="alert" class=" alert alert-warning alert-dismissible cmmn_error">
        <i class="fa fa-info-circle"></i>
         <?php echo $this->session->flashdata('admin_warning');?>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>
         
        </div> 

 

<?php   
}
elseif($this->session->flashdata('admin_success')) { ?>

   <div role="alert" class="alert alert-success alert-dismissible cmmn_error">
        <i class="fa fa-check-circle"></i>
       <?php echo $this->session->flashdata('admin_success');?>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>
         
        </div>



<?php } ?>


    
