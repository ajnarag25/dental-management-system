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
    

    <?php echo form_open('Appointments/UpdatePendingAppointment/') ?>

    <?php foreach($appointments as $appointment): ?>

        <input type="hidden" name="user_id" id="user_id" value="<?= $appointment->id;?>" >
        <input type="hidden" name="user_id" id="user_id" value="<?= $appointment->appointment_id;?>" >
         <!--first row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="fullname" class="form-label">Patient Name: </label>
                <input type="text" class="form-control" name="fullname" id="cur_password"  value="<?=   $appointment->firstname.$appointment->middlename.$appointment->lastname; ?>" disabled/>  
               
            </div>
        </div>   
        <!--second row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="email" class="form-label">Email: </label>
                <input type="text" class="form-control" name="email" id="email"  value="<?= $appointment->email; ?>"disabled/>      
            </div>
        </div>   
        <!--third row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="confirmpassword" class="form-label">Contact Number:</label>
                <input type="text" class="form-control" name="contactno" id="contactno"  value="<?= $appointment->contactno; ?>" disabled/>      
            </div>
         
        </div> 
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="service_name" class="form-label">Service Name:</label>
                <select class="form-control" name="service_name" id="service_name" onchange="showProcedureDuration(this)">
                    <?php foreach ($procedures as $procedure): ?>
                        <option value="<?= $procedure['procedure_name'] ?>" data-duration="<?= $procedure['procedure_duration'] ?>"
                            <?php if ($appointment->service_name == $procedure['procedure_name']) echo 'selected'; ?>>
                            <?= $procedure['procedure_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="service_dur" class="form-label">Service Duration:</label>
                <input type="text" class="form-control" name="service_dur" id="service_dur" value="<?= $appointment->service_duration ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="app_date" class="form-label">Appointment Date:</label>
                <input type="date" class="form-control" name="app_date" id="app_date"  value="<?= $appointment->appointment_date;?>" />      
            </div>
        </div> 
        
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="service_dur" class="form-label">Service Duration:</label>
                <input type="text" class="form-control" name="service_dur" id="service_dur" value="<?= $appointment->service_duration; ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="app_start" class="form-label">Appointment Start Time:</label>
                <input type="time" class="form-control" name="app_start" id="app_start" value="<?= $appointment->start_time; ?>" onchange="updateAppointmentEnd()">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="app_end" class="form-label">Appointment End Time:</label>
                <input type="time" class="form-control" name="app_end" id="app_end" value="<?= $appointment->end_time; ?>" readonly>
            </div>
        </div>




        <div class="row">
            <div class="col-md-4 form-group">
                <label for="description" class="form-label"> Description:</label>
                <input type="text" class="form-control" name="description" id="description"  value="<?= $appointment->description; ?>"/>      
            </div>
        </div> 
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" aria-label="Default select example" name ="status" value="<?=  $appointment->status;  ?>">
                    <option name ="status" value="approved" <?php if ($appointment->status == 'approve') echo 'selected'; ?>>Approve</option>
                    <option name ="status" value="pending"<?php if ($appointment->status == 'pending') echo 'selected'; ?>>Pending</option>
                    <option name ="status" value="reject"<?php if ($appointment->status == 'reject') echo 'selected'; ?>>Reject</option>
                </select>   
            </div>
            
        </div> 
       
        <!-- button -->
        <div class="row">
            <div class="col form-group">
                <a href="<?= base_url('Appointments/displayPendingAppointment/'.$appointment->appointment_id); ?>" class="btn btn-danger"id="back-btn" >Back</a>
                <button type=submit name="submit" class="btn btn-primary">Update Appointment</button>
            </div>
        </div>
        <?php endforeach; ?>  
    <?php echo form_close();?>
</div>
