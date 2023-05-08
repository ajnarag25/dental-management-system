<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_view.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">

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
            
            

      
            <div style="float: right;">
                <?php $status='approved'?>
                <?php echo form_open('Appointments/search/'.$status); ?>
                    <input type="text" name="search" placeholder="Search Appointment">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?php echo base_url('Appointments/viewApprovedAppointments'); ?>" class="btn btn-secondary">Show All</a>
                <?php echo form_close(); ?>
            </div>
            <table class = "table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Start Time</th>
                        <th scope="col">Appointment End Time</th>
                        <th scope="col">Service name</th>
                        <th scope="col">Service Duration</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                       
                        <th scope="col"  colspan ="3" >Action</th>
   
                    </tr>

                </thead>
                <tbody>
                



                
                <?php foreach($appointments as $appointment): 
                    $birthday_date = new DateTime($appointment['birthday']);

                    // Get the current date as a DateTime object
                    $current_date = new DateTime();
    
                    // Calculate the difference between the two dates
                    $age_interval = $birthday_date->diff($current_date);
    
                    // Get the age in years from the interval object
                    $age = $age_interval->y;?>
                    
                    
                    <tr>
                            <td><?php echo $appointment['firstname']." ".$appointment['middlename']." ".$appointment['lastname']; ?></td>
                            <td><?php echo $age ?></td>
                            <td><?php echo $appointment['contactno']; ?></td>
                            <td><?php echo date('M j, Y', strtotime($appointment['appointment_date'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($appointment['start_time'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($appointment['end_time'])); ?></td>
                            <td><?php echo $appointment['service_name']; ?></td>
                            <td><?php echo $appointment['service_duration']; ?></td>
                            <td><?php echo $appointment['description']; ?></td>

                           
                            <td style="background-color:
                            <?php
                            switch($appointment['status']) {
                                case 'approved':
                                    echo '#ABDF84';
                                    break;
                                case 'pending':
                                    echo '#FFFF00';
                                    break;
                                case 'rejected':
                                    echo '#FF0000'; 
                                    break;
                                default:
                                    echo '';
                            }
                            ?>"><?php echo $appointment['status']; ?></td>
                    <td>
                        <a href="<?php echo base_url('Appointments/displayApprovedAppointment_view/'.$appointment['appointment_id']); ?>" class="btn btn-warning" id="edit">
                            <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/edit.png'); ?>" />
                                    View
                        </a>
                        <a href="<?php echo base_url('Appointments/Conclude_Appointment_btn/'.$appointment['appointment_id']); ?>" class="btn btn-warning" id="approve">
                            <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/edit.png'); ?>" />
                                    Conclude
                        </a>
                   
                    </td>
                    <?php endforeach; ?>
                    
                </tr>
                </tbody>
            </table>
            <?php 
            echo $links; ?>
        </div>
    </div>
</div>
</body>