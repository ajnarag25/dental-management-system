<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/patient_sidebar.css'); ?>">
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
                <?php echo form_open('Patient/search/'); ?>
                    <input type="text" name="search" placeholder="Search Appointment">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?php echo base_url('Patient/myappointments_view/'); ?>" class="btn btn-secondary">Show All</a>
                <?php echo form_close(); ?>
            </div>
            <center>
            <table class = "table table-striped">
                <thead>
                    <tr>
                       
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Start Time</th>
                        <th scope="col">Appointment Concern</th>
                        <th scope="col">Status</th>
                        <th scope="col" >Action</th>
   
                    </tr>

                </thead>
                <tbody>
                


                <?php 
                $x = 1;
                foreach ($my_appointment as $my_appointment): ?>
           
                    
                    <tr>

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
                    <td>
                              <a href="<?php echo base_url('Patient/myappointments/'.$my_appointment['appointment_id']); ?>" class="btn btn-warning" id="edit">
                            <img class="icon" src="<?php echo base_url('./uploads/images/system_images/icons/edit.png'); ?>" />
                                    View
                        </a>
                      
                   
                    </td>
       
                    
                </tr>
                <?php endforeach; ?>
                </tbody>


            </table>
                    <?php echo  $links; ?>
        </div>
    </div>
</div>
</body>