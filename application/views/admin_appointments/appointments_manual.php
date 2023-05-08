    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_view.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_manage_accounts.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">

</head>
<body>

<div class="container">
    <h1>Manual Appointments</h1>
    <div style="float: right;">
                
                <?php echo form_open('Appointments/searchPatient/'); ?>
                    <input type="text" name="search" placeholder="Search Patient">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?php echo base_url('Appointments/manualAppointments'); ?>" class="btn btn-secondary">Show All</a>
                <?php echo form_close(); ?>
            </div>
    <table class = "table table-striped">
        <thead>
            <tr>
                <th scope="col"colspan ="1">Patient Name</th>
                <th scope="col"colspan ="1">Age</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach($patient as $row):
            $birthday_date = new DateTime($row['birthday']);

            // Get the current date as a DateTime object
            $current_date = new DateTime();

            // Calculate the difference between the two dates
            $age_interval = $birthday_date->diff($current_date);

            // Get the age in years from the interval object
            $age = $age_interval->y?>    
            
                
            <tr>
                <td><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td>
                <td><?php echo $age ?></td>
                <td><?php echo $row['contactno']; ?></td>
                <td>
                    <!-- Button -->
                    <a href="<?php echo base_url('Appointments/create_ManualAppointmentView/').$row['id']?>">Select</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <?php 
            echo $links; ?>
</div>