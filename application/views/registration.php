<link rel="stylesheet" href="<?php echo base_url('assets/css/general_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/registration.css'); ?>">
</head>
<body>

<div class="container justify-content-center">
    <?php echo form_open('Users/signup');?>
    <a href="<?php echo base_url('Login/'); ?>"><img src="/iSmileDentalCare/uploads/images/system_images/icons/chevron-left.png" alt="Back" class="back-btn"></a>
    
    <div class="row justify-content-center">
        <img src="/iSmileDentalCare/uploads/images/system_images/Tooth_Logo.png" alt="Tooth Logo" class="tooth-logo">
        <h1>Create an Account</h1>
    </div>

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
            <input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password'); ?>"/>
            <span class="field_error"><?php echo form_error('password'); ?></span>
        </div>
        <div class="col-md-4 form-group">
            <label for="cpassword">Confirm Password:</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword" value="<?php echo set_value('cpassword'); ?>"/>
            <span class="field_error"><?php echo form_error('cpassword'); ?></span>
        </div>
    </div>
        
    <div class="row justify-content-center">
        <button type=submit name="submit" class="btn btn-primary">Sign Up</button>
    </div>

        <?php echo form_close();?>
</div>
</body>
</html>