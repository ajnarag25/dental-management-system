<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/assistant_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/assistant_view.css'); ?>">


</head>
<body>

<div class="col col-md-10" style="margin: auto">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->userdata('success') != NULL): ?>
            <div class="alert alert-success">
                <?php echo $this->session->userdata('success'); ?>
            </div>
        <?php endif; ?>



</head>
<body><br><br>
<center><h1> Upcoming Appointments </h1></center>
<div class="container form-control">
    
    <div class="row">
        <div class="col-md-10" style="margin: auto">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            

      
        
            <center>
            <table class = "table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Start Time</th>
                        <th scope="col">Appointment End Time</th>
                        <th scope="col">Appointment Concern</th>
                        <th scope="col">Status</th>
                       
   
                    </tr>

                </thead>
                <tbody>
                


                <?php 
                $x = 1;
                foreach ($assistant_appointments as $assistant_appointments): ?>
           
                    
                    <tr>

                            <td><?php echo $assistant_appointments['firstname']." ".$assistant_appointments['middlename']." ".$assistant_appointments['lastname']; ?></td>
                            <td><?php echo $assistant_appointments['contactno']; ?></td>
                            <td><?php echo date('M j, Y', strtotime($assistant_appointments['appointment_date'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($assistant_appointments['start_time'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($assistant_appointments['end_time'])); ?></td>
                            <td><?php echo $assistant_appointments['service_name']; ?></td>
                  
                       

                           
                            <td style="background-color:
                            <?php
                            switch($assistant_appointments['status']) {
                                case 'approved':
                                    echo '#ABDF84';
                                    break;
                                case 'pending':
                                    echo '#FFFF00';
                                    break;
                                case 'rejected':
                                    echo '#FF0000'; 
                                    break;
                                case 'concluded':
                                    echo '#F8C8DC'; 
                                    break;    
                                default:
                                    echo '';
                            }
                            ?>"><?php echo $assistant_appointments['status']; ?></td>
              
                    
                </tr>
                <?php endforeach; ?>
                </tbody>


            </table>
     
        </div>
    </div>
</div>
</body>   