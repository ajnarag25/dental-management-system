<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_sidebar.css'); ?>">
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


        <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/patient_sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_view.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">

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
                       
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Start Time</th>
                        <th scope="col">Appointment Concern</th>
                        <th scope="col">Status</th>
                       
   
                    </tr>

                </thead>
                <tbody>
                


                <?php 
                $x = 1;
                foreach ($my_appointment as $my_appointment): ?>
           
                    
                    <tr>
                            <td><?php echo $my_appointment['service_name']; ?></td>
                            <td><?php echo date('M j, Y', strtotime($my_appointment['appointment_date'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($my_appointment['start_time'])); ?></td>
                            <td><?php echo $my_appointment['service_name']; ?></td>
                  
                       

                           
                            <td style="background-color:
                            <?php
                            switch($my_appointment['status']) {
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
                            ?>"><?php echo $my_appointment['status']; ?></td>
              
                    
                </tr>
                <?php endforeach; ?>
                </tbody>


            </table>
     
        </div>
    </div>
</div>
</body>   