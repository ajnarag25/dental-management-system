<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_view.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/appointments.css'); ?>">
</head>
<body>  

<div class="container" style="margin: auto;">
    <a href="<?php echo base_url('Patient/create_ScheduleAppointment_Submit/'.$this->session->userdata('user_id')); ?>" class="btn btn-danger"id="back-btn" >Back</a>
    <center><h1>COVID Screening</h1><hr></center>
    <h2>

                

    <?php echo form_open('Patient/create_ScheduleAppointment_done/') ?>

    

    <div class="row justify-content-center">
        <img src="/iSmileDentalCare/uploads/images/system_images/Tooth_Logo.png" alt="Tooth Logo" class="tooth-logo">
        <h1>Are you sure you want to submit?</h1>
    </div>
    
         <!-- button -->
         <center>
         <div class="row">
            <div class="col form-group">
        <input type="hidden" class="form-control" name="user_id" id="fullname"  value="<?php  echo $user_id; ?> " />  
        <input type="hidden" class="form-control" name="app_date" id="fullname"  value="<?php  echo $appointment_date ?> " />  
        <input type="hidden" class="form-control" name="app_start" id="fullname"  value="<?php  echo $start_time ?> " />  
        <input type="hidden" class="form-control" name="app_start" id="fullname"  value="<?php  echo $end_time ?> " />  
        <input type="hidden" class="form-control" name="service_name" id="fullname"  value="<?php  echo $service_name ?> " />  
        <input type="hidden" class="form-control" name="service_dur" id="fullname"  value="<?php  echo $service_duration ?> " />  
        <input type="hidden" class="form-control" name="description" id="fullname"  value="<?php  echo $description ?> " />  
        <input type="hidden" class="form-control" name="patient" id="fullname"  value="<?php  echo $patient ?> " />  
        <!-- <input type="text" class="form-control" name="fullname" id="fullname"  value="<?php  echo $status ?> " disabled/>   -->


                <!-- <button type=submit name="back" value="Back" onclick="history.back();" class="btn btn-primary">Back</button> -->
                <a href="<?php echo base_url('Patient/create_ScheduleAppointment_Submit/'.$this->session->userdata('user_id')); ?>" class="btn btn-warning" id="back"> Back </a>

                <button type=submit name="submit" value="Submit" class="btn btn-primary">Next</button>
            </div>
        </div></center>
     
        <?php echo form_close();?>
</div>




