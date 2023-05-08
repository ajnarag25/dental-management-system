<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_manage_accounts.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/general_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_registration.css'); ?>">
    <title> iSmile Dental Care </title>
</head>
<body>
    <div class="container">
        <?php echo form_open('Admin_Procedure/admin_add_procedure_func');?>
        <!-- first row -->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="procedure_name">Procedure name: </label>
                <input type="text" class="form-control" name="procedure_name" id="procedure_name" value="<?php echo set_value('procedure_name'); ?>"/>
                <span class="field_error"><?php echo form_error('procedure_name'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="procedure_legend">Procedure Legend:</label>
                <input type="color" class="form-control" name="procedure_legend" id="procedure_legend" value="<?php echo set_value('procedure_legend'); ?>"/>
                <span class="field_error"><?php echo form_error('procedure_legend'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="procedure_duration">Procedure Duration:</label>
                <select name="procedure_duration" id="procedure_duration" class="form-control" value="<?php echo set_value('procedure_duration'); ?>">
                    <option name="procedure_duration" value="0" <?php echo set_select('procedure_duration', '0'); ?> selected>Select duration</option>
                    <option name="procedure_duration" value="15"<?php echo set_select('procedure_duration', '15'); ?> >15 minutes</option>
                    <option name="procedure_duration" value="30"<?php echo set_select('procedure_duration', '30'); ?> >30 minutes</option>
                    <option name="procedure_duration" value="45"<?php echo set_select('procedure_duration', '45'); ?> >45 minutes</option>
                    <option name="procedure_duration" value="60"<?php echo set_select('procedure_duration', '60'); ?> >60 minutes</option>
                    <option name="procedure_duration" value="90"<?php echo set_select('procedure_duration', '90'); ?> >90 minutes</option>
                    <option name="procedure_duration" value="120"<?php echo set_select('procedure_duration', '120'); ?> >120 minutes</option>
                </select>
                <span class="field_error"><?php echo form_error('procedure_duration'); ?></span>
            </div>
            
        </div>

        <!-- second row -->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="procedure_price">Procedure Price:</label>
                <input type="text" class="form-control" name="procedure_price" id="procedure_price" oninput="validatePrice(this)"
                value="<?php echo set_value('procedure_price'); ?>"/>
                <span class="field_error"><?php echo form_error('procedure_price'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="procedure_desc">Procedure Description: </label>
                <input type="text" class="form-control" name="procedure_desc" id="procedure_desc" value="<?php echo set_value('procedure_desc'); ?>"/>
                <span class="field_error"><?php echo form_error('procedure_desc'); ?></span>  
            </div>

            
        </div>

            <div class="form-group">
                <button type=submit name="submit" class="btn btn-primary">Add Procedure</button>
                <a href="<?php echo base_url('Admin_Procedure/admin_manage_procedures'); ?>" class="btn btn-danger">Cancel</a>
            </div>
    <?php echo form_close();?>
</div>





<script>
    function validatePrice(input) {
    var regex = /^[0-9]+(\.[0-9]{0,2})?$/;
    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^0-9\.]/g, '');
    }
    }
</script>

</body>
</html>