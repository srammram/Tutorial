
<?php  if($this->session->flashdata('action_error'))
{ ?>

<div role="alert" class="alert alert-danger alert-dismissible cmmn_error">
    <i class="fa fa-exclamation-circle"></i>
   <?php echo $this->session->flashdata('action_error');?>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>         
        </div>


       
<?php   
}
elseif($this->session->flashdata('action_warning')) { ?>       

 <div role="alert" class=" alert alert-warning alert-dismissible cmmn_error">
        <i class="fa fa-info-circle"></i>
         <?php echo $this->session->flashdata('action_warning');?>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>
         
        </div> 

 

<?php   
}
elseif($this->session->flashdata('action_success')) { ?>

   <div role="alert" class="alert alert-success alert-dismissible cmmn_error">
        <i class="fa fa-check-circle"></i>
       <?php echo $this->session->flashdata('action_success');?>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>
         
        </div>



<?php } ?>


    
