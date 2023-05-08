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
        <?php echo form_open('Admin/admin_signup');?>
        <!-- first row -->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="firstname">First name: </label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname'); ?>"/>
                <span class="field_error"><?php echo form_error('firstname'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="middlename">Middle name:</label>
                <input type="text" class="form-control" name="middlename" id="middlename" value="<?php echo set_value('middlename'); ?>"/>
                <span class="field_error"><?php echo form_error('middlename'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="lastname">Last name:</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname'); ?>"/>
                <span class="field_error"><?php echo form_error('lastname'); ?></span>
            </div>
        </div>

        <!-- second row -->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="birthday">Birthday: </label>
                <input type="date" class="form-control" name="birthday" id="birthday" value="<?php echo set_value('birthday'); ?>"/>
                <span class="field_error"><?php echo form_error('birthday'); ?></span>  
            </div>
            <div class="col-md-4 form-group">
                <label for="gender">Gender:</label>
                <select class="form-select" aria-label="Default select example" name ="gender" value="<?php echo set_value('gender'); ?>">
                    <option selected></option>
                    <option name ="gender" value="Male" <?php echo set_select('gender', 'Male'); ?>>Male</option>
                    <option name ="gender" value="Female"<?php echo set_select('gender', 'Female'); ?>>Female</option>
                </select> 
                <span class="field_error"><?php echo form_error('gender'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" class="form-control" name="occupation" id="occupation" value="<?php echo set_value('occupation'); ?>"/>
                <span class="field_error"><?php echo form_error('occupation'); ?></span>
            </div>
        </div>

        <!-- third row -->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>"/>  
                <span class="field_error"><?php echo form_error('email'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="contactnumber">Contact Number:</label>
                <input type="tel" class="form-control" name="contactnumber" id="contactnumber" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?php echo set_value('contactnumber'); ?>"/>
                <span class="field_error"><?php echo form_error('contactnumber'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="province">Province:</label>
                <input type="text" class="form-control" name="province" id="province" value="<?php echo set_value('province'); ?>"/>
                <span class="field_error"><?php echo form_error('province'); ?></span>
            </div>
        </div>

        <!-- fourth row -->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" name="address" id="address" value="<?php echo set_value('address'); ?>"/>  
                <span class="field_error"><?php echo form_error('address'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" value=""/>
                <span class="field_error"><?php echo form_error('password'); ?></span>
            </div>
            <div class="col-md-4 form-group">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" class="form-control" name="cpassword" id="cpassword" value=""/>
                <span class="field_error"><?php echo form_error('cpassword'); ?></span>
            </div>
        </div>
        
            <div class="col-md-4 form-group">
                <label for="role">Role:</label>
                <input type="text" class="form-control" value="patient" disabled/>  
                <input type="text" class="form-control" name="role" id="role" value="patient" hidden/>  
                <span class="field_error"><?php echo form_error('role'); ?></span>
            </div>

            <div class="form-group">
                <button type=submit name="submit" class="btn btn-primary">Sign Up</button>
                <a href="<?php echo base_url('Admin/admin_manage_accounts'); ?>" class="btn btn-danger">Cancel</a>
            </div>
    <?php echo form_close();?>
</div>
</body>
</html>