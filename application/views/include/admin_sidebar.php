<!-- The sidebar -->


<div class="sidebar">
        <div class="greet-container">
            <div class="row">
                <div class="col">
                    <img src="/iSmileDentalCare/uploads/images/system_images/Admin_greet.png" alt="greet" class="greet-pic">
                </div>
                <div class="col greet-name">
                    <p>Welcome Dr.<?php echo $data['firstname'] = $this->session->userdata('firstname'); ?>!</p>
                </div>
            </div>
        </div>
        
        <div class="navgroup">
            <ul class="nav flex-column" id="nav_accordion">
                
                <!-- DASHBOARD -->
                <li <?php if ($active_page == 'home') { echo 'class="active"'; } ?>><a href="<?php echo base_url('AdminDashboard'); ?>">Dashboard</a></li>
                
                <!-- DENTAL PROCEDURE -->
                <li <?php if ($active_page == 'procedure') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Admin_Procedure/admin_manage_procedures'); ?>">Dental Procedures</a></li>
                
                
                <!-- DENTAL RECORDS -->
                <li <?php if ($active_page == 'manage') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Admin/admin_manage_accounts'); ?>">Dental Records</a></li>
                
                <!-- <li <?php if ($active_page == 'my_acc') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Admin/View_admin/').$this->session->userdata('id'); ?>">My Account</a></li> -->
                
   


                <!-- APPOINTMENTS -->
                <li class="nav-item has-submenu" >
                    <a onclick = "active" <?php if ($active_page == 'manual_appointment' || $active_page == 'appointmentapp' || $active_page == 'appointmentpen'){
                                echo 'class="active nav-link"';
                            }else{
                                echo 'class="nav-link"';    
                            } ?>>Appointments</a>
                    <ul <?php if ($active_page == 'manual_appointment' || $active_page == 'appointmentapp' || $active_page == 'appointmentpen') {
                                echo 'class="submenu"';
                            } else {
                                echo 'class="submenu collapse"';
                            } ?>>
                        <li <?php if ($active_page == 'manual_appointment') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Appointments/manualAppointments/');?>">Manual Appointment</a></li>
                        <li <?php if ($active_page == 'appointmentapp') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Appointments/viewApprovedAppointments/');?>">Approved Appointments</a></li>
                        <li <?php if ($active_page == 'appointmentpen') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Appointments/viewPendingAppointments/');?>"> Appointment Request</a></li>
                    </ul>
	            </li>
                
                <!-- ACCOUNTS -->
                <!-- Drop Down -->
                <li class="nav-item has-submenu">
                    <a onclick = "active" <?php if ($active_page == 'my_acc' || $active_page == 'manage_assistants'){
                                echo 'class="active nav-link"';
                            }else{
                                echo 'class="nav-link"';    
                            } ?>>Accounts</a>
                    <ul <?php if ($active_page == 'my_acc' || $active_page == 'manage_assistants') {
                                echo 'class="submenu"';
                            } else {
                                echo 'class="submenu collapse"';
                            } ?>>
                        <li <?php if ($active_page == 'my_acc') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Admin/View_admin/').$this->session->userdata('id'); ?>">My Account</a></li>
                        <li <?php if ($active_page == 'manage_assistants') { echo 'class="active"'; } ?>><a href="<?php echo base_url('Admin_Assistant/admin_manage_accounts_assistants/'); ?>">Manage Dental Assistants</a></li>
                    </ul>
	            </li>

            </ul>
        
        </div>
</div>

<script>

    // document.getElementById("sub").onclick = function() {
    // let myDiv = document.getElementById('sub');
    // myDiv.id = 'drop';
    // }


    document.addEventListener("DOMContentLoaded", function(){
        document.querySelectorAll('.has-submenu > a').forEach(function(element){
            element.addEventListener('click', function (e) {
                let nextEl = element.nextElementSibling;
                let parentEl  = element.parentElement;	
                if(nextEl) {
                    e.preventDefault();	
                    let mycollapse = new bootstrap.Collapse(nextEl);
                    if(nextEl.classList.contains('show')){
                        mycollapse.hide();
                    } else {
                        mycollapse.show();
                        // find other submenus with class=show
                        document.querySelectorAll('.has-submenu .submenu.show').forEach(function(el) {
                            if (el !== nextEl) {
                                new bootstrap.Collapse(el);
                            }
                        });
                    }
                }
            }); // addEventListener
        }); // forEach
    }); 




</script>