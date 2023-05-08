<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/patient_sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/user_update.css'); ?>">

</head>
<body>
<div class="container">

    <div class="row">
        <div class="col col-md-6" style="margin: auto">
    
        <?php if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger dismissible fade show" role="alert">
                <button type="button" class="btn-close " data-bs-dismiss="alert" role="alert"></button>  <?php echo $this->session->flashdata('error') ?>
            </div>
        
        <?php }elseif($this->session->flashdata('success')){ ?>
            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert"role="alert" ></button> <?php echo $this->session->flashdata('success') ?>   
            </div>

        <?php } elseif(validation_errors()){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" >
                <button type="button" class="btn-close" data-bs-dismiss="alert" role="alert" ></button><?php echo validation_errors() ?>
            </div>

        <?php } else {?>

        <?php } ?>

        </div>
    </div>
    
    
    <?php echo form_open('Patient/Patient_changepassword'); ?>
        <input type="hidden" name="id" value="<?= $this->session->userdata['id'];?>">

         <!--first row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="currentpassword" class="form-label">Current Password: </label>
                <input type="password" class="form-control" name="cur_password" id="cur_password"  value=""/>    
            </div>
        </div>   
        <!--second row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="newpassword" class="form-label">New Password: </label>
                <input type="password" class="form-control" name="new_password" id="new_password"  value=""/>      
            </div>
        </div>   
        <!--third row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="confirmpassword" class="form-label">Confirm New Password:</label>
                <input type="password" class="form-control" name="con_password" id="con_password"  value=""/>      
            </div>
        </div> 
        <!-- button -->
        <div class="row">
            <div class="col form-group">
            <a href="<?= base_url('Patient/View_user/'.$this->session->userdata('id')); ?>" class="btn btn-danger" id="back-btn">Back</a>
            <button type=submit name="submit" class="btn btn-primary">Update Password</button>
                
            </div>
        </div>

    <?php echo form_close();?>
</div>
