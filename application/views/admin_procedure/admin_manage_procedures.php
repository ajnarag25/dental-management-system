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
            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            

            <div style="float: left;">
                <a href="<?= base_url('Admin_Procedure/admin_add_procedure_view') ?>" class="btn btn-primary" id="add_user">
                <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/add.png'); ?>" />
                Add Procedure
                </a>
            </div>
            <div style="float: right;">
                <?php echo form_open('Admin_Procedure/search'); ?>
                    <input type="text" name="search" placeholder="Search Account">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?php echo base_url('Admin_Procedure/admin_manage_procedures'); ?>" class="btn btn-secondary">Show All</a>
                <?php echo form_close(); ?>
            </div>
            <table class = "table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Procedure Id</th>
                        <th scope="col">Procedure Name</th>
                        <th scope="col">Procedure Legend</th>
                        <th scope="col">Procedure Duration</th>
                        <th scope="col">Procedure Price</th>
                        <th scope="col" >Procedure Description</th>
                        <!-- <th scope="col">Password</th> -->
                        <th scope="col"  colspan ="3" >Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php foreach($procedures as $procedure): ?>
                    
                        <tr>
                            
                            <td><?php echo $procedure['procedure_id']; ?></td>
                            <td><?php echo $procedure['procedure_name']; ?></td>

                            <td><div class="legend" style= "background-color: <?php echo $procedure['procedure_legend']; ?>"></div></td>
                            <td><?php echo $procedure['procedure_duration']; ?> mins</td>
                            <td><?php echo $procedure['procedure_price']; ?></td>
                            <td><?php echo $procedure['procedure_desc']; ?></td>
                           
                            <td >
                                <a href="<?php echo base_url('Admin_Procedure/admin_update_procedure_view/').$procedure['procedure_id']; ?>" class="btn btn-warning" id="edit">
                                    <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/edit.png'); ?>" />
                                    Edit
                                </a>

                                <?php if($procedure['procedure_activeness'] == 'active'){ ?>
                                    <a href="<?php echo base_url('Admin_Procedure/archive_procedure_btn/').$procedure['procedure_id']; ?>" class="btn btn-danger"id="delete">
                                        <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/trash.png'); ?>" />
                                        Archive
                                    </a>
                                <?php }else{  ?>
                                    <a href="<?php echo base_url('Admin_Procedure/activate_procedure_btn/').$procedure['procedure_id']; ?>" class="btn btn-danger"id="delete">
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
