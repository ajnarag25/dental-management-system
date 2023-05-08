<link rel="stylesheet" href="<?php echo base_url('assets/css/general_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
</head>
<body>



<?php if($this->session->userdata('success') != NULL): ?>
    <div class="alert alert-success">
        <?php echo $this->session->userdata('success'); ?>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row">
    <div class="col-6">

        <div class="alert alert-danger"id="message">
        <?php   if(isset($error)){
                    echo $error; 
                } 
                else{
                    echo "Hi there! Please log-in to your account.";
                }
                ?>
        </div>


        <img src="/iSmileDentalCare/uploads/images/system_images/Login_Dentist_Cartoon.png" alt="Dentist Cartoon" class="dentist">
        </div>


        <div class="form-container col-6">
            <center><img src="/iSmileDentalCare/uploads/images/system_images/Tooth_Logo.png" alt="iSmile Logo" class="tooth-logo"></center>
            <h1>Login</h1><hr>
            <?php echo form_open('Login/login_user'); ?>
                <div class="form-group">
                    <label for="username">Email</label>
            
                    <input type="text" class="form-control" name="email" id="email" value="" placeholder=""/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password"/>
                </div>
                <div>
                    <p>Don't have an account?</p>
                    <a href="<?php echo base_url('Users'); ?>" class="link">Register here</a>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn">Login</button>
                </div>
                
            <?php echo form_close(); ?>
            <hr>
        </div>
    </div>
</div>
