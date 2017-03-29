<?php for ($i = 0; $i < count($department_id); $i++) { ?>
    <div class="clear" style="clear: both;height:0.1em"></div>    
    <div class="form-group">
        <label><?php echo $department_name[$i]; ?> End Datetime</label>
        <input type="text" name="dependancy_endtime[]" id="dependancy_endtime" class="form-control dependancy_endtime"/>
    </div>
    <script type="text/javascript">
        $('.dependancy_endtime').datetimepicker({
            daysOfWeekDisabled: [0],
            useCurrent: false,
        });
    </script>
<?php }
?>