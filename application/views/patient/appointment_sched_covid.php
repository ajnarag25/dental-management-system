<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/patient_view.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/appointments.css'); ?>">
</head>
<body>  

<div class="container" style="margin: auto;">
    <center><h1>COVID Screening</h1><hr></center>
    <h2>

    <!-- FORM -->
    <div class="row">
        <div class="col col-md-6" style="margin: auto">
            <?php if($this->session->userdata('success') != NULL): ?>
                <div class="alert alert-success alert-dismissible fade show" style="margin:auto;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" ></button><?php echo $this->session->userdata('success'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php echo form_open('Patient/create_ScheduleAppointment_Submit/'.$this->session->userdata('user_id')) ?>
    <input type="text" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>" >

    <?php
        $session_service_name = $this->session->userdata('service_name');
        $session_patient = $this->session->userdata('patient');
        $session_duration = $this->session->userdata('service_duration');
        $session_date = $this->session->userdata('appointment_date');
        $session_start_time = $this->session->userdata('start_time');
        $session_end_time = $this->session->userdata('end_time');
        $session_description = $this->session->userdata('description');
    ?>
    <input type="hidden" class="form-control" name="patient" id="patient" value="<?php echo $session_patient; ?>" readonly/>
    <input type="hidden" class="form-control" name="service_name" id="service_name" value="<?php echo $session_service_name; ?>" readonly/>
    <input type="hidden" class="form-control" name="service_dur" id="service_dur" value="<?php echo $session_duration; ?>" readonly/>
    <input type="hidden" class="form-control" name="app_date" id="app_date" value="<?php echo $session_date; ?>" readonly/>
    <input type="hidden" class="form-control" name="app_start" id="app_start" value="<?php echo $session_start_time; ?>" readonly/>
    <input type="hidden" class="form-control" name="app_end" id="app_end" value="<?php echo $session_end_time; ?>" readonly/>
    <input type="hidden" class="form-control" name="description" id="description" value="<?php echo $session_description; ?>" readonly/>

        <div class="row" id="choice">Yes No</div>
        <div class="row">
            <div class="form-group">
                <?php
                    $session_exp_con = $this->session->userdata('exp_con');
                ?>
                <li class="lists">
                    <label>Have you had an exposure with a confirmed case of COVID-19 in the last 14 DAYS?</label>
                    <div class="choice">
                        <input class="form-check-input" type="radio" name="exp_con" value="yes" <?php echo set_radio('exp_con', 'yes', ($session_exp_con === 'yes')); ?>>
                        <input class="form-check-input" type="radio" name="exp_con" value="no" <?php echo set_radio('exp_con', 'no', ($session_exp_con === 'no')); ?>>
                    <div>
                </li>
                <span class="field_error" id="covid-error"><?php echo form_error('exp_con'); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <?php
                    $session_exp_inv = $this->session->userdata('exp_inv');
                ?>
                <li class="lists">
                    <label>Have you had an exposure with a person under investigation in the last 14 DAYS?</label>
                    <div class="choice">
                        <input class="form-check-input" type="radio" name="exp_inv" value="yes" <?php echo set_radio('exp_inv', 'yes', ($session_exp_inv === 'yes')); ?>>
                        <input class="form-check-input" type="radio" name="exp_inv" value="no" <?php echo set_radio('exp_inv', 'no', ($session_exp_inv === 'no')); ?>>
                    </div>
                </li>
                <span class="field_error" id="covid-error"><?php echo form_error('exp_inv'); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <?php
                    $session_exp_mon = $this->session->userdata('exp_mon');
                ?>
                <li class="lists">
                    <label>Have you had an exposure with a person under monitoring in the last 14 days?</label>
                    <div class="choice">
                        <input class="form-check-input" type="radio" name="exp_mon" value="yes" <?php echo set_radio('exp_mon', 'yes', ($session_exp_mon === 'yes'));  ?>>
                        <input class="form-check-input" type="radio" name="exp_mon" value="no" <?php echo set_radio('exp_mon', 'no', ($session_exp_mon === 'no'));  ?>>
                    </div>
                </li>
                <span class="field_error" id="covid-error"><?php echo form_error('exp_mon'); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <?php
                    $session_fever = $this->session->userdata('fever');
                ?>
                <li class="lists">
                    <label>Have you had an exposure with a person under investigation in the last 14 DAYS?</label>
                    <div class="choice">
                        <input class="form-check-input" type="radio" name="fever" value="yes" <?php echo set_radio('fever', 'yes', ($session_fever === 'yes'));  ?>>
                        <input class="form-check-input" type="radio" name="fever" value="no" <?php echo set_radio('fever', 'no', ($session_fever === 'no'));  ?>>
                     </div>
                </li>
                <span class="field_error" id="covid-error"><?php echo form_error('fever'); ?></span>
            </div>
        </div>
        
        <hr>
        <h3>Have you had any symptoms in the last 14 DAYS such as:</h3  >

        <div class="row">
            
            <div class="col form-group" id="columnline">
                    
                    <div class="row">
                        <li class="list_choice" style="list-style:none;">
                            <div class="row" id="choice">Yes No</div>
                        </li>
                    </div>
                    <div class="row">
                        <?php
                            $session_sore_throat = $this->session->userdata('sore_throat');
                        ?>
                        <li class="lists">
                            <label>Sore Throat</label>
                            <div class="choice">
                                <input class="form-check-input" type="radio" name="sore_throat" value="yes" <?php echo set_radio('sore_throat', 'yes', ($session_sore_throat === 'yes'));  ?>>
                                <input class="form-check-input" type="radio" name="sore_throat" value="no" <?php echo set_radio('sore_throat', 'no', ($session_sore_throat === 'no'));  ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('sore_throat'); ?></span>
                    </div>

                    <div class="row">
                        <?php
                            $session_runny_nose = $this->session->userdata('runny_nose');
                        ?>
                        <li class="lists">
                            <label>Runny Nose</label>
                            <div class="choice">
                                <input class="form-check-input" type="radio" name="runny_nose" value="yes" <?php echo set_radio('runny_nose', 'yes', ($session_runny_nose === 'yes'));  ?>>
                                <input class="form-check-input" type="radio" name="runny_nose" value="no" <?php echo set_radio('runny_nose', 'no', ($session_runny_nose === 'no'));  ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('runny_nose'); ?></span>
                    </div>

                    <div class="row">
                        <?php
                            $session_cough = $this->session->userdata('cough');
                        ?>
                        <li class="lists">
                            <label>Cough</label>
                            <div class="choice">
                                <input class="form-check-input" type="radio" name="cough" value="yes" <?php echo set_radio('cough', 'yes', ($session_cough === 'yes'));  ?>>
                                <input class="form-check-input" type="radio" name="cough" value="no" <?php echo set_radio('cough', 'no', ($session_cough === 'no'));  ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('cough'); ?></span>
                    </div>
            </div>

            <div class="col form-group" id="columnline">
                    <div class="row">
                        <li class="list_choice" style="list-style:none;">
                            <div class="row" id="choice">Yes No</div>
                        </li>
                    </div>
                    <div class="row">
                    <?php
                        $session_diff_breath = $this->session->userdata('diff_breath');
                    ?>
                        <li class="lists">
                            <label>Difficulty of Breathing</label>
                            <div class="choice">
                                <input class="form-check-input" type="radio" name="diff_breath" value="yes" <?php echo set_radio('diff_breath', 'yes', ($session_diff_breath === 'yes'));  ?>>
                                <input class="form-check-input" type="radio" name="diff_breath" value="no" <?php echo set_radio('diff_breath', 'no', ($session_diff_breath === 'no'));  ?>>
                            </div>    
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('diff_breath'); ?></span>
                    </div>
                    <div class="row">
                        <?php
                            $session_nausea = $this->session->userdata('nausea');
                        ?>
                        <li class="lists">
                            <label>Nausea</label>
                            <div class="choice">
                                <input class="form-check-input" type="radio" name="nausea" value="yes" <?php echo set_radio('nausea', 'yes', ($session_nausea === 'yes'));  ?>>
                                <input class="form-check-input" type="radio" name="nausea" value="no" <?php echo set_radio('nausea', 'no', ($session_nausea === 'no'));  ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('nausea'); ?></span>
                    </div>
                    <div class="row">
                        <?php
                            $session_body_ache = $this->session->userdata('body_ache');
                        ?>
                        <li class="lists">
                            <label>Body Ache</label>
                            <div class="choice">
                                <input class="form-check-input" type="radio" name="body_ache" value="yes" <?php echo set_radio('body_ache', 'yes', ($session_body_ache === 'yes'));  ?>>
                                <input class="form-check-input" type="radio" name="body_ache" value="no" <?php echo set_radio('body_ache', 'no', ($session_body_ache === 'no'));  ?>>
                            </div>    
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('body_ache'); ?></span>
                    </div>
            </div>

            <div class="col form-group">
                    <div class="row">
                        <li class="list_choice" style="list-style:none;">
                            <div class="row" id="choice">Yes No</div>
                        </li>
                    </div>
                    <div class="row">
                        <?php
                            $session_diarrhea = $this->session->userdata('diarrhea');
                        ?>
                        <li class="lists">
                            <label>Diarrhea</label>
                            <div class="choice">
                                <input class="form-check-input" type="radio" name="diarrhea" value="yes" <?php echo set_radio('diarrhea', 'yes', ($session_diarrhea === 'yes'));  ?>>
                                <input class="form-check-input" type="radio" name="diarrhea" value="no" <?php echo set_radio('diarrhea', 'no', ($session_diarrhea === 'no'));  ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('diarrhea'); ?></span>
                    </div>
                    <div class="row">
                        <?php
                            $session_loss_smell = $this->session->userdata('loss_smell');
                        ?>
                        <li class="lists">
                            <label>Loss of Smell</label>
                            <div class="choice">
                                <input class="form-check-input" type="radio" name="loss_smell" value="yes" <?php echo set_radio('loss_smell', 'yes', ($session_loss_smell === 'yes'));  ?>>
                                <input class="form-check-input" type="radio" name="loss_smell" value="no" <?php echo set_radio('loss_smell', 'no', ($session_loss_smell === 'no'));  ?>>
                            </div>    
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('loss_smell'); ?></span>
                    </div>
                    <div class="row">
                        <?php
                            $session_loss_taste = $this->session->userdata('loss_taste');
                        ?>
                        <li class="lists"><label>Loss of Taste</label>
                        <div class="choice">
                            <input class="form-check-input" type="radio" name="loss_taste" value="yes" <?php echo set_radio('loss_taste', 'yes', ($session_loss_taste === 'yes'));  ?>>
                            <input class="form-check-input" type="radio" name="loss_taste" value="no" <?php echo set_radio('loss_taste', 'no', ($session_loss_taste === 'no'));  ?>>
                        </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('loss_taste'); ?></span>
                    </div>
            </div>
        </div>
         <!-- button -->
         <center>
         <div class="row">
            <div class="col form-group">
                <!-- <button type=submit name="back" value="Back" onclick="history.back();" class="btn btn-primary">Back</button> -->
                <a href="<?php echo base_url('Patient/displayScheduleappointment_view/'.$this->session->userdata('user_id')); ?>" class="btn btn-primary" id="back"> 
                    <img class="icon"id="arrow-left" src="<?php echo base_url('./uploads/images/system_images/icons/arrow-left.png'); ?>" />
                    Back
                </a>
                <button type=submit name="submit" value="Submit" class="btn btn-primary" id="next">
                    <img class="icon"id="arrow-right" src="<?php echo base_url('./uploads/images/system_images/icons/arrow-right.png'); ?>" />
                    Next
                </button>
            </div>
        </div></center>
     
        <?php echo form_close();?>
</div>

