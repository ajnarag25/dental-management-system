<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/assistant_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/all_profilepic.css'); ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  $('#profilepicture').on('change', function() {
    if ($(this).val()) {
      $('#submit-btn').prop('disabled', false);
    } else {
      $('#submit-btn').prop('disabled', true);
    }
  });
});

</script>

</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-lg-6 col-lg-offset-4" style="margin: auto">
            <h3>Update Profile Picture</h3>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button><?php echo $error; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>

    
    <?php echo form_open_multipart('Assistant/update_profilepic'); ?>
        <input type="hidden" name="id" value="<?= $user['id']?>">

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

        <!--first row-->
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4" style="margin: auto">
                <img src="<?php echo $profile_picture ?>" class="profile-pic"/>
            </div>
        </div> 
        <!--second row-->
        <div class="row">
            <div class="col">
                <div class="col-lg-4 col-lg-offset-4" style="margin: auto; margin-top:10px;">
                <input type="file" class="form-control" name="profilepicture" id="profilepicture">
                </div>
            </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col form-group">
            <a href="<?= base_url('Assistant/View_user/').$user['id']; ?>" class="btn btn-danger">Back</a>
                <button type=submit name="submit" class="btn btn-primary"id="submit-btn" style="float: right;" disabled>Update Profile Picture</button>
                
            </div>
        </div>
    <?php echo form_close();?>
</div>

</body>
</html>