<!-- The sidebar -->


<div class="sidebar">
        <div class="greet-container">
            <div class="row">
                <div class="col">
                    <img src="/iSmileDentalCare/uploads/images/system_images/Admin_greet.png" alt="greet" class="greet-pic">
                </div>
                <div class="col greet-name">
                <p>Welcome <?php echo $data['firstname'] = $this->session->userdata('firstname'); ?>!</p>
                </div>
            </div>
        </div>
        <div class="navgroup">
            <ul>
                <li <?php if ($active_page == 'home') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Patient'); ?>">Home</a></li>
                <li <?php if ($active_page == 'my_acc') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Patient/View_user/').$this->session->userdata('id'); ?>">My Account</a></li>
                <li <?php if ($active_page == 'schedule_appointment') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Patient/displayScheduleappointment_view/').$this->session->userdata('id'); ?>">Schedule Appointment</a></li>
                <li <?php if ($active_page == 'my_appointment') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Patient/myappointments_view/') ?>">My Appointments</a></li>

            </ul>
        
    </div>
</div>


