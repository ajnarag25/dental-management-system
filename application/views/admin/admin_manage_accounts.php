<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_manage_accounts.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">
<title> iSmile Dental Care </title>
</head>
<body>

<div class="container form-control">
    <div class="row">
        <div class="col-md-10" style="margin: auto">
            <?php if($this->session->userdata('success') != NULL): ?>
                <div class="alert alert-success alert-dismissible fade show" style="margin:auto;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" ></button><?php echo $this->session->userdata('success'); ?>
                </div>
            <?php endif; ?>
            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            

            <div style="float: left;">
                <a href="<?= base_url('Admin/admin_registration') ?>" class="btn btn-primary" id="add_user">
                <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/add.png'); ?>" />
                Add Patient
                </a>
            </div>
            <div style="float: right;">
                <?php echo form_open('Admin/search'); ?>
                    <input type="text" name="search" placeholder="Search Account">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?php echo base_url('Admin/admin_manage_accounts'); ?>" class="btn btn-secondary">Show All</a>
                <?php echo form_close(); ?>
            </div>
            <table class = "table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Profile Picture</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Middle Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <!-- <th scope="col">Password</th> -->
                        <th scope="col">Contact Number</th>
                        <th scope="col">Role</th>
                        <th scope="col"  colspan ="3" >Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php foreach($users as $account): ?>
                    <?php 
                        if(!empty($account['profilepicture'])){
                            $profile_picture = base_url('./uploads/images/thumbs/'.$account['profilepicture']);
                        } else {
                            if($account['gender'] == 'Male'){
                                $profile_picture = base_url('./uploads/images/thumbs/default_male_profile.png');
                            } else {
                                $profile_picture = base_url('./uploads/images/thumbs/default_female_profile_picture.png');
                            }
                        }
                    ?>
                        <tr>
                            <td> <img src="<?php echo $profile_picture?>"></td>
                            <td><?php echo $account['firstname']; ?></td>
                            <td><?php echo $account['middlename']; ?></td>
                            <td><?php echo $account['lastname']; ?></td>
                            <td><?php echo $account['email']; ?></td>
                            <td><?php echo $account['contactno']; ?></td>
                            <td><?php echo $account['role']; ?></td>
                           
                            <td >
                                <a href="<?php echo base_url('Admin/admin_update_view/').$account['id']; ?>" class="btn btn-warning" id="edit">
                                    <img class="icon" id="view"src="<?php echo base_url('./uploads/images/system_images/icons/view.png'); ?>" />
                                    View
                                </a>

                                <?php if($account['state'] == 'active'){ ?>
                                    <a href="<?php echo base_url('Admin/archive_account_btn/').$account['id']; ?>" class="btn btn-danger"id="delete">
                                        <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/trash.png'); ?>" />
                                        Disable
                                    </a>
                                <?php }else{  ?>
                                    <a href="<?php echo base_url('Admin/activate_account_btn/').$account['id']; ?>" class="btn btn-danger"id="delete">
                                        <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/trash.png'); ?>" />
                                        Enable
                                    </a>
                              <?php   } ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <?php 
            echo $links; ?>
        </div>
    </div>
</div>
