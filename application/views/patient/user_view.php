<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_view.css'); ?>">

</head>
<body>
<div class="container">

    <?php if($this->session->userdata('success') != NULL): ?>
        <div class="alert alert-success alert-dismissible fade show" style="margin:auto;">
            <button type="button" class="btn-close" data-bs-dismiss="alert" ></button><?php echo $this->session->userdata('success'); ?>
        </div>
        <?php 
            $this->session->unset_userdata('success'); // remove success message from session data
        ?>
    <?php endif; ?>

    <div class="row"><!-- pic, name, title -->
    
        <div class="col-md-4">

            <!--error message-->
            <?php if(isset($error)): ?>
            <div class="alert alert-danger dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button><?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <!--pic-->
            <?php 
                if(!empty($user['profilepicture'])){
                    $profile_picture = base_url('./uploads/images/profile_pictures/'.$user['profilepicture']);
                } else {
                    if($user['gender'] == 'Male'){
                        $profile_picture = base_url('./uploads/images/system_images/default_male_profile.png');
                    } else {
                        $profile_picture = base_url('./uploads/images/system_images/default_female_profile_picture.png');
                    }
                }                
            ?>

            <center>
                <a href="<?= base_url('Patient/Edit_profilepic/').$this->session->userdata('id'); ?>">
                    <img src="<?php echo $profile_picture; ?>" class="profile-pic"/>
                </a>
            </center>
        </div>

        <div class="col-md-4">
            <h1><?php echo $user['firstname']." ".$user['middlename']." ".$user['lastname'];?></h1>
        </div>

        <div class="col-md-4">
            <a href="<?= base_url('Patient/Edit_user/').$this->session->userdata('id'); ?>" class="btn btn-primary" style="float: right;">Edit Profile</a>
            <a href="<?= base_url('Patient/Changepassword_view/').$this->session->userdata('id'); ?>" class="btn btn-danger"style="float: right; ">Reset Password</a>
        </div>
    </div>

    
    <?php echo form_open(''); ?>

    <!--first row-->
    <div class="row">
            <div class="col-md-4 form-group">
                <label for="firstname" class="form-label">First name: </label>
                <input type="text" class="form-control" name="firstname" id="firstname" readonly value="<?= $user['firstname'];  ?>"/>    
            </div>
            <div class="col-md-4 form-group">
                <label for="middlename" class="form-label">Middle name:</label>
                <input type="text" class="form-control" name="middlename" id="middlename"  readonly value="<?= $user['middlename'];  ?>"/>    
            </div>
            <div class="col-md-4 form-group">
                <label for="lastname" class="form-label">Last name:</label>
                <input type="text" class="form-control" name="lastname" id="lastname"readonly value="<?= $user['lastname'];  ?>"/>    
            </div>
    </div>   
    
    <!--second row-->
    <div class="row">
            <div class="col-md-4 form-group">
                <label for="birthday" class="form-label">Birthday: </label>
                <input type="date" class="form-control" name="birthday" id="birthday" readonly value="<?= $user['birthday'];  ?>"/>      
            </div>
            <div class="col-md-4 form-group">
                <label for="gender" class="form-label">Gender:</label>
                <input type="text" class="form-control" name="gender" id="gender" readonly value="<?=   $user['gender'];  ?>"/>    
            </div>
            <div class="col-md-4 form-group">
                <label for="occupation" class="form-label">Occupation:</label>
                <input type="text" class="form-control" name="occupation" id="occupation" readonly value="<?= $user['occupation'];  ?>"/>     
            </div>
    </div>   

    <!--third row-->
    <div class="row">
            <div class="col-md-4 form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="email" readonly value="<?= $user['email'];  ?>"/>      
            </div>
            <div class="col-md-4 form-group">
                <label for="contactnumber" class="form-label">Contact Number:</label>
                <input type="text" class="form-control" name="contactnumber" id="contactnumber" readonly  value="<?= $user['contactno'];  ?>"/> 
            </div>
            <div class="col-md-4 form-group">
                <label for="province" class="form-label">Province:</label>
                <input type="text" class="form-control" name="province" id="province" readonly value="<?= $user['province'];  ?>"/>    
            </div>
    </div> 

    <!--fourth row-->
    <div class="row">
            <div class="col form-group">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" name="address" id="address" readonly value="<?= $user['address'];  ?>"/> 
            </div>
    </div> 
            
            <?php echo form_close();?>
    
</div>