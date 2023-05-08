<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_update.css'); ?>">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Disabled buttons -->
<script>
    $(document).ready(function() {
        $('.form-control').each(function() {
            $(this).data('initial-value', $(this).val());
            $(this).on('input', function() {
            if ($(this).val() === $(this).data('initial-value')) {
                $('#submit-btn').prop('disabled', true);
            } else {
                $('#submit-btn').prop('disabled', false);
            }
            });
        });
    });

</script>

</head>
<body>
<div class="container">

    <div class="row">
        <div class="col col-md-6" style="margin: auto">
        <h3>Update My Account</h3>
            <?php if(isset($error)): ?>
                <div class="alert alert-danger dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button><?php echo $error; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php echo form_open('Admin/admin_update_account'); ?>
        <input type="hidden" name="id" value="<?= $user['id']?>">

         <!--first row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="firstname" class="form-label">First name: </label>
                <input type="text" class="form-control" name="firstname" id="firstname"  value="<?= $user['firstname'];  ?>"/>    
            </div>
            <div class="col-md-4 form-group">
                <label for="middlename" class="form-label">Middle name:</label>
                <input type="text" class="form-control" name="middlename" id="middlename"   value="<?= $user['middlename'];  ?>"/>    
            </div>
            <div class="col-md-4 form-group">
                <label for="lastname" class="form-label">Last name:</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $user['lastname'];  ?>"/>    
            </div>
        </div>   
       
        <!--second row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="birthday" class="form-label">Birthday: </label>
                <input type="date" class="form-control" name="birthday" id="birthday"  value="<?= $user['birthday'];  ?>"/>      
            </div>
            <div class="col-md-4 form-group">
                <label for="gender" class="form-label">Gender:</label>
                <select class="form-control" aria-label="Default select example" name ="gender" value="<?=  $user['gender'];  ?>">
                    <option name ="gender" value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option name ="gender" value="Female"<?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                </select>    
            </div>
            <div class="col-md-4 form-group">
                <label for="occupation" class="form-label">Occupation:</label>
                <input type="text" class="form-control" name="occupation" id="occupation"  value="<?= $user['occupation'];  ?>"/>     
            </div>
        </div>   

        <!--third row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="email"  value="<?= $user['email'];  ?>"/>      
            </div>
            <div class="col-md-4 form-group">
                <label for="contactnumber" class="form-label">Contact Number:</label>
                <input type="tel" class="form-control" name="contactnumber" id="contactnumber" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= $user['contactno'];  ?>"/> 
            </div>
            <div class="col-md-4 form-group">
                <label for="province" class="form-label">Province:</label>
                <input type="text" class="form-control" name="province" id="province"  value="<?= $user['province'];  ?>"/>    
            </div>
        </div> 

        <!--fourth row-->
        <div class="row">
            <div class="col form-group">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" name="address" id="address"  value="<?= $user['address'];  ?>"/> 
            </div>
        </div> 
        
        <!-- button -->
        <div class="row" id="btns">
            <div class="col form-group">
                <a href="<?= base_url('Admin/View_admin/').$user['id']; ?>" class="btn btn-danger" id="back-btn" >Back</a>
                <button type=submit name="submit" class="btn btn-primary" style="float:right" id="submit-btn" disabled>Update Account</button>
                
            </div>
        </div>
    <?php echo form_close();?>
</div>
