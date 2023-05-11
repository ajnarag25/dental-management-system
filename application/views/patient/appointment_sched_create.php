<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_view.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/appointments.css'); ?>">
<style>
  .btn.active {
    background-color: #007bff;
    color: #fff;
  }
</style>

<script>
    window.onload = function() {
    disableOverlapAppointments();
    }
    // Show the service duration on page load
    showProcedureDuration(document.getElementById('service_name'));

    // Update the appointment end time based on the start time and service duration
    function updateAppointmentEnd() {
        var startDate = document.getElementById('app_date').value;
        var startTime = document.getElementById('app_start').value;
        var serviceDur = document.getElementById('service_dur').value;
        if (startDate && startTime && serviceDur) {
            var startDateTime = new Date(startDate + 'T' + startTime);
            var serviceDuration = parseInt(serviceDur.split(' ')[0]); // extract duration value from string
            var endDateTime = new Date(startDateTime.getTime() + (serviceDuration * 60 * 1000)); // add duration in milliseconds
            var endTimeString = endDateTime.toTimeString().substring(0, 5);
            document.getElementById('app_end').value = endTimeString;
            
            // check if there is an existing appointment for the selected date and time
            var existingAppointments = <?php echo json_encode($existing_appointments); ?>;
            var isExisting = false;
            for (var i = 0; i < existingAppointments.length; i++) {
                var existingStart = existingAppointments[i].start_time;
                var existingEnd = existingAppointments[i].end_time;
                var existingDate = existingAppointments[i].appointment_date;
                var existingStartDateTime = new Date(existingDate + 'T' + existingStart);
                var existingEndDateTime = new Date(existingDate + 'T' + existingEnd);
                if (startDateTime >= existingStartDateTime && startDateTime < existingEndDateTime) {
                    isExisting = true;
                    break;
                }
            }
            
            // check if the selected appointment time will overlap with an existing appointment
            var isOverlap = false;
            for (var i = 0; i < existingAppointments.length; i++) {
                var existingStart = existingAppointments[i].start_time;
                var existingEnd = existingAppointments[i].end_time;
                var existingDate = existingAppointments[i].appointment_date;
                var existingStartDateTime = new Date(existingDate + 'T' + existingStart);
                var existingEndDateTime = new Date(existingDate + 'T' + existingEnd);
                if (startDateTime < existingStartDateTime && endDateTime > existingStartDateTime) {
                    isOverlap = true;
                    break;
                } else if (startDateTime >= existingStartDateTime && startDateTime < existingEndDateTime) {
                    isOverlap = true;
                    break;
                }
            }
            
            // disable the appointment start time button if necessary
            var buttons = document.querySelectorAll('.btn');
            for (var i = 0; i < buttons.length; i++) {
                if (isExisting || isOverlap) {
                    buttons[i].disabled = true;
                } else {
                    buttons[i].disabled = false;
                }
            }
        }
    }

    // Show the selected procedure's duration
    function showProcedureDuration(select) {
    var duration = select.options[select.selectedIndex].getAttribute('data-duration');
    if (duration) {
        document.getElementById('service_dur').value = duration + ' minutes';
    } else {
        document.getElementById('service_dur').value = '';
    }
    updateAppointmentEnd();
    }


        //Highlights the selected start time
    function selectStartTime(button, time) {
    var buttons = document.querySelectorAll('.btn');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('active');
    }
    button.classList.add('active');
    document.getElementById('app_start').value = time;
    updateAppointmentEnd();
    disableOverlapAppointments();
    }

    function convertTo24Hour(time) {
    var hours = parseInt(time.substr(0, 2));
    var modifier = time.substr(6, 2);
    if (modifier === "PM" && hours < 12) {
        hours = hours + 12;
    }
    if (modifier === "AM" && hours === 12) {
        hours = hours - 12;
    }
    var minutes = parseInt(time.substr(3, 2));
    return hours.toString().padStart(2, "0") + ":" + minutes.toString().padStart(2, "0");
}

function disableOverlapAppointments() {
    var buttons = document.querySelectorAll('.btn');
    var app_start = document.getElementById('app_start').value;
    var service_dur = parseInt(document.getElementById('service_dur').value.split(' ')[0]); // extract duration value from string
    var app_date = document.getElementById('app_date').value;
    
    // fetch existing appointments from the database
    var existingAppointments = <?php echo json_encode($existing_appointments); ?>;
    
    for (var i = 0; i < buttons.length; i++) {
        var button_time = buttons[i].innerHTML;
        var app_start_time = new Date(app_date + 'T' + app_start);
        var start_time = new Date(app_date + 'T' + convertTo24Hour(button_time));
        var end_time = new Date(start_time.getTime() + (service_dur * 60 * 1000)); // add duration in milliseconds

        // check if the appointment overlaps with the selected start time
        var overlaps = false;
        for (var j = 0; j < existingAppointments.length; j++) {
            var appt_start_time = new Date(existingAppointments[j]['appointment_date'] + 'T' + existingAppointments[j]['start_time']);
            var appt_end_time = new Date(existingAppointments[j]['appointment_date'] + 'T' + existingAppointments[j]['end_time']);
            if ((start_time >= appt_start_time && start_time < appt_end_time) || (end_time > appt_start_time && end_time <= appt_end_time) || (start_time <= appt_start_time && end_time >= appt_end_time)) {
                overlaps = true;
                break;
            }
        }

        if (overlaps) {
            buttons[i].setAttribute('disabled', 'disabled');
            buttons[i].classList.remove('active');
            if (app_start == button_time) {
                document.getElementById('app_start').value = '';
                document.getElementById('app_end').value = '';
            }
        } else {
            buttons[i].removeAttribute('disabled');
        }
    }
}


</script>



</head>
<body>  

<div class="container" id="appointment-form">
    <center><h1>Schedule Appointment</h1><hr></center>
    <h2>
                <?php   echo $user['firstname']." ".$user['middlename']." ".$user['lastname'];?></h2>


    <?php echo form_open('Patient/create_ScheduleAppointment_CovidScreening/'.$user['id']) ?>
        <input type="text" name="user_id" id="user_id" value="<?= $user['id'];?>" >
        
        <div class="row">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="app_date" class="form-label">Appointment Date:</label>
                    <?php
                        $session_date = $this->session->userdata('appointment_date');
                        $date_value = !empty($session_date) ? $session_date : set_value('app_date');
                    ?>
                    
                    <input type="date" min="<?php echo date('Y-m-d'); ?>"class="form-control" name="app_date" id="app_date" value="<?php echo $date_value; ?>" onchange="disableOverlapAppointments()"/>
                    <span class="field_error"><?php echo form_error('app_date'); ?></span>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="service_name" class="form-label">Service Name:</label>
                <?php
                    $posted_service_name = $this->input->post('service_name');
                    $session_service_name = $this->session->userdata('service_name');
                ?>
                <select class="form-control" name="service_name" id="service_name" onchange="showProcedureDuration(this), disableOverlapAppointments()">
                    <option value="">Select a procedure</option>
                    <?php foreach ($procedures as $procedure): ?>
                        <?php $selected = '';
                        if ($posted_service_name && $posted_service_name == $procedure['procedure_name']) {
                            $selected = 'selected';
                        } elseif ($session_service_name && $session_service_name == $procedure['procedure_name']) {
                            $selected = 'selected';
                        } ?>
                        <option value="<?= $procedure['procedure_name'] ?>" data-duration="<?= $procedure['procedure_duration'] ?>" <?= $selected ?>>
                            <?= $procedure['procedure_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="field_error"><?php echo form_error('service_name'); ?></span>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="service_dur" class="form-label">Service Duration:</label>
                <?php
                        $session_duration = $this->session->userdata('service_duration');
                        $duration_value = !empty($session_duration) ? $session_duration : set_value('service_dur');
                    ?>
                
                <input type="text" class="form-control" name="service_dur" id="service_dur" value="<?php echo $duration_value; ?>" readonly/>
            </div>
        </div>

        <div class="row">
        <div class="col-md-4 form-group">
            <label for="app_start" class="form-label">Appointment Start Time:</label>
            <?php
            $session_start_time = $this->session->userdata('start_time');
            $start_time_value = !empty($session_start_time) ? $session_start_time : set_value('app_start');
            ?>
            <div class="btn-group time-container" role="group" aria-label="Appointment Start Time">
            <?php
                $start_time = strtotime('9:00 AM');
                $end_time = strtotime('3:00 PM');
                $interval = 15 * 60; // 15 minutes in seconds
                for ($time = $start_time; $time < $end_time; $time += $interval) {
                    $time_value = date('H:i', $time);
                    $active_class = $start_time_value == $time_value ? ' active' : '';
                    $time_value_12 = date("h:i A", strtotime($time_value)); //converts the 24 hour format to 12 hour format
                    echo '<button type="button" class="btn btn-outline-secondary time-item' . $active_class . '" onclick="selectStartTime(this, \'' . $time_value . '\')">' . $time_value_12 . '</button>';
                }
                
                
            ?>
            </div>
            <input type="hidden" name="app_start" id="app_start" value="<?php echo $start_time_value; ?>" onchange="updateAppointmentEnd(), disableOverlapAppointments()" />
            <span class="field_error"><?php echo form_error('app_start'); ?></span>
        </div>
        </div>

        <div class="row">
            <div class="col-md-4 form-group">
                <label for="app_end" class="form-label">Appointment End Time:</label>
                <?php
                    $session_end_time = $this->session->userdata('end_time');
                    $end_time_value = !empty($session_end_time) ? $session_end_time : set_value('app_end');
                ?>

                <input type="time" class="form-control" name="app_end" id="app_end" value="<?php echo $end_time_value; ?>" readonly />
                <span class="field_error"><?php echo form_error('app_end'); ?></span>
            </div>
        </div> 
        
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="description" class="form-label"> Description:</label>
                <?php
                    $session_description = $this->session->userdata('description');
                    $description_value = !empty($session_description) ? $session_description : set_value('description');
                ?>
                <input type="text" class="form-control" name="description" id="description"  value="<?php echo $description_value; ?>"/>      
                <span class="field_error"><?php echo form_error('description'); ?></span>
                <?php
                $session_patient = $this->session->userdata('patient');
                $patient_name = $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname'];
                $patient_value = !empty($session_patient) ? $session_patient : $patient_name;
                $data = array(
                    'patient' => $patient_value
                );
                $this->session->set_userdata($data);
                ?>
                <input type="hidden" name="patient" value="<?php echo $patient_value ?>">
                <span class="field_error"><?php echo form_error('patients'); ?></span>

            </div>
        </div> 

         <!-- button -->
         <center>   
         <div class="row">
            <div class="col form-group">
                <button type=submit name="submit" class="btn btn-primary item"id="next">
                <img class="icon"id="arrow-right" src="<?php echo base_url('./uploads/images/system_images/icons/arrow-right.png'); ?>" />
                    Next</button>
            </div>
        </div></center>
                        
        <?php echo form_close();?>
</div>
