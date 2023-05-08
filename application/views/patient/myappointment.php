<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_update.css'); ?>">

<script>
    // Show the service duration on page load
    showProcedureDuration(document.getElementById('service_name'));

    // Update the appointment end time based on the start time and service duration
    function updateAppointmentEnd() {
        var startTime = document.getElementById('app_start').value;
        var serviceDur = document.getElementById('service_dur').value;
        if (startTime && serviceDur) {
            var startDateTime = new Date(document.getElementById('app_date').value + 'T' + startTime);
            var serviceDuration = parseInt(serviceDur.split(' ')[0]); // extract duration value from string
            var endDateTime = new Date(startDateTime.getTime() + (serviceDuration * 60 * 1000)); // add duration in milliseconds
            var endTimeString = endDateTime.toTimeString().substring(0, 5);
            document.getElementById('app_end').value = endTimeString;
        }
    }
    // Show the selected procedure's duration
    function showProcedureDuration(select) {
        var duration = select.options[select.selectedIndex].getAttribute('data-duration');
        document.getElementById('service_dur').value = duration + ' minutes';
        updateAppointmentEnd();
    }
</script>

</head>
<body>

<div class="container">

    <div class="row">
        <div class="col col-md-6" style="margin: auto">
        <?php if(isset($error)): ?>
                <div class="alert alert-danger dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button><?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if($this->session->userdata('success') != NULL): ?>
                <div class="alert alert-success alert-dismissible fade show" style="margin:auto;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" ></button><?php echo $this->session->userdata('success'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
      
   



        <div class="row">
            <div class="col-md-4 form-group">
                <label for="fullname" class="form-label">Patient Name: </label>
            
                <input type="text" class="form-control" name="fullname" id="fullname"  value="<?php  echo $user['firstname'] .' ' .$user['middlename'] . ' ' .$user['lastname'] ?> " readonly/>  
               
            </div>
        </div>   
       
        <!--second row-->
     
        <!--third row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="contactno" class="form-label">Contact Number:</label>
                <input type="text" class="form-control" name="contactno" id="contactno"  value="<?php  echo $user['contactno']; ?> "readonly/>      
            </div>
        </div> 
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="service_name" class="form-label">Service Name:</label>
                <input type="text" class="form-control" name="service_name" id="service_name"  value="<?php  echo $my_appointment_details['service_name']; ?> " readonly/>      
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="service_dur" class="form-label">Service Duration:</label>
                <input type="text" class="form-control" name="service_dur" id="service_dur" value="<?= $my_appointment_details['service_duration'] ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="app_date" class="form-label">Appointment Date:</label>
                <input type="text" class="form-control" name="app_date" id="app_date" value="<?php echo date('M j, Y', strtotime($my_appointment_details['appointment_date'])); ?>" readonly>
            </div>
        </div> 
        
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="service_dur" class="form-label">Service Duration:</label>
                <input type="text" class="form-control" name="service_dur" id="service_dur" value="<?= $my_appointment_details['service_duration']; ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="app_start" class="form-label">Appointment Start Time:</label>
                <input type="text" class="form-control" name="app_start" id="app_start" value="<?= date('g:i a', strtotime($my_appointment_details['start_time'])); ?>" onchange="updateAppointmentEnd()" >

            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="app_end" class="form-label">Appointment End Time:</label>
                <input type="text" class="form-control" name="app_end" id="app_end" value="<?php echo date('h:i A', strtotime($my_appointment_details['end_time'])); ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="description" class="form-label"> Description:</label>
                <input type="text" class="form-control" name="description" id="description"  value="<?php  echo $my_appointment_details['description']; ?>" readonly/>      
            </div>
        </div> 
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="status" class="form-label">Status:</label>
                <input type="text" class="form-control" name="status" id="status"  value="<?php  echo $my_appointment_details['status']; ?>" readonly/>      

            </div>
            
        </div> 
       
        <!-- button -->
        <div class="row">
            <div class="col form-group">
                <a href="<?= base_url('Patient/myappointments_view/'); ?>" class="btn btn-danger"id="back-btn" >Back</a>
           
            </div>
        </div>
  

 
</div>









