<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_view.css'); ?>">
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

    <?php foreach($appointments as $appointment):
    echo form_open('Appointments/displayPendingAppointment_view/'.$appointment['appointment_id']);
    ?>
    


        <div class="row" id="choice">Yes No</div>
        <br>
        <div class="row">
            <div class="form-group">
                <li class="lists">
                    <label>Have you had an exposure with a confirmed case of COVID-19 in the last 14 DAYS?</label>
                    <div class="choice">
                        <input disabled class="form-check-input" type="radio" name="exp_con" value="yes" <?php echo $appointment['exp_con'] == 'yes' ? 'checked' : ''; ?>>
                        <input disabled class="form-check-input" type="radio" name="exp_con" value="no" <?php echo $appointment['exp_con'] == 'no' ? 'checked' : ''; ?>>
                    </div>    
                </li>
                <span class="field_error" id="covid-error"><?php echo form_error('exp_con'); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <li class="lists">
                    <label>Have you had an exposure with a person under investigation in the last 14 DAYS?</label>
                    <div class="choice">
                        <input disabled class="form-check-input" type="radio" name="exp_inv" value="yes" <?php echo $appointment['exp_inv'] == 'yes' ? 'checked' : ''; ?>>
                        <input disabled class="form-check-input" type="radio" name="exp_inv" value="no" <?php echo $appointment['exp_inv'] == 'no' ? 'checked' : ''; ?>>
                    </div>
                </li>
                <span class="field_error" id="covid-error"><?php echo form_error('exp_inv'); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <li class="lists">
                    <label>Have you had an exposure with a person under monitoring in the last 14 days?</label>
                    <div class="choice">
                        <input disabled class="form-check-input" type="radio" name="exp_mon" value="yes" <?php echo $appointment['exp_mon'] == 'yes' ? 'checked' : ''; ?>>
                        <input disabled class="form-check-input" type="radio" name="exp_mon" value="no" <?php echo $appointment['exp_mon'] == 'no' ? 'checked' : ''; ?>>
                    </div>
                </li>
                <span class="field_error" id="covid-error"><?php echo form_error('exp_mon'); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <li class="lists">
                    <label>Have you had an exposure with a person under investigation in the last 14 DAYS?</label>
                    <div class="choice">
                        <input disabled class="form-check-input" type="radio" name="fever" value="yes" <?php echo $appointment['fever'] == 'yes' ? 'checked' : ''; ?>>
                        <input disabled class="form-check-input" type="radio" name="fever" value="no" <?php echo $appointment['fever'] == 'no' ? 'checked' : ''; ?>>
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
                        <li class="lists">
                            <label>Sore Throat</label>
                            <div class="choice">
                            <input disabled class="form-check-input" type="radio" name="sore_throat" value="yes" <?php echo $appointment['sore_throat'] == 'yes' ? 'checked' : ''; ?>>
                            <input disabled class="form-check-input" type="radio" name="sore_throat" value="no" <?php echo $appointment['sore_throat'] == 'no' ? 'checked' : ''; ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('sore_throat'); ?></span>
                    </div>

                    <div class="row">
                        <li class="lists">
                            <label>Runny Nose</label>
                            <div class="choice">
                                <input disabled class="form-check-input" type="radio" name="runny_nose" value="yes" <?php echo $appointment['runny_nose'] == 'yes' ? 'checked' : ''; ?>>
                                <input disabled class="form-check-input" type="radio" name="runny_nose" value="no" <?php echo $appointment['runny_nose'] == 'no' ? 'checked' : ''; ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('runny_nose'); ?></span>
                    </div>

                    <div class="row">
                        <li class="lists">
                            <label>Cough</label>
                            <div class="choice">
                                <input disabled class="form-check-input" type="radio" name="cough" value="yes" <?php echo $appointment['cough'] == 'yes' ? 'checked' : ''; ?>>
                                <input disabled class="form-check-input" type="radio" name="cough" value="no" <?php echo $appointment['cough'] == 'no' ? 'checked' : ''; ?>>
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
                        <li class="lists">
                            <label>Difficulty of Breathing</label>
                            <div class="choice">
                                <input disabled class="form-check-input" type="radio" name="diff_breath" value="yes" <?php echo $appointment['diff_breath'] == 'yes' ? 'checked' : ''; ?>>
                                <input disabled class="form-check-input" type="radio" name="diff_breath" value="no" <?php echo $appointment['diff_breath'] == 'no' ? 'checked' : ''; ?>>
                            </div>    
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('diff_breath'); ?></span>
                    </div>
                    <div class="row">
                        <li class="lists">
                            <label>Nausea</label>
                            <div class="choice">
                                <input disabled class="form-check-input" type="radio" name="nausea" value="yes" <?php echo $appointment['nausea'] == 'yes' ? 'checked' : ''; ?>>
                                <input disabled class="form-check-input" type="radio" name="nausea" value="no" <?php echo $appointment['nausea'] == 'no' ? 'checked' : ''; ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('nausea'); ?></span>
                    </div>
                    <div class="row">
                        <li class="lists">
                            <label>Body Ache</label>
                            <div class="choice">
                                <input disabled class="form-check-input" type="radio" name="body_ache" value="yes" <?php echo $appointment['body_ache'] == 'yes' ? 'checked' : ''; ?>>
                                <input disabled class="form-check-input" type="radio" name="body_ache" value="no" <?php echo $appointment['body_ache'] == 'no' ? 'checked' : ''; ?>>
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
                        <li class="lists">
                            <label>Diarrhea</label>
                            <div class="choice">
                                <input disabled class="form-check-input" type="radio" name="diarrhea" value="yes" <?php echo $appointment['diarrhea'] == 'yes' ? 'checked' : ''; ?>>
                                <input disabled class="form-check-input" type="radio" name="diarrhea" value="no" <?php echo $appointment['diarrhea'] == 'no' ? 'checked' : ''; ?>>
                            </div>
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('diarrhea'); ?></span>
                    </div>
                    <div class="row">
                        <li class="lists">
                            <label>Loss of Smell</label>
                            <div class="choice">
                                <input disabled class="form-check-input" type="radio" name="loss_smell" value="yes" <?php echo $appointment['loss_smell'] == 'yes' ? 'checked' : ''; ?>>
                                <input disabled class="form-check-input" type="radio" name="loss_smell" value="no" <?php echo $appointment['loss_smell'] == 'no' ? 'checked' : ''; ?>>
                            </div>    
                        </li>
                        <span class="field_error" id="covid-error"><?php echo form_error('loss_smell'); ?></span>
                    </div>
                    <div class="row">
                        <li class="lists"><label>Loss of Taste</label>
                        <div class="choice">
                            <input disabled class="form-check-input" type="radio" name="loss_taste" value="yes" <?php echo $appointment['loss_taste'] == 'yes' ? 'checked' : ''; ?>>
                                <input disabled class="form-check-input" type="radio" name="loss_taste" value="no" <?php echo $appointment['loss_taste'] == 'no' ? 'checked' : ''; ?>>
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
                <a href="<?php echo base_url('Appointments/displayPendingAppointment_view/'.$appointment['appointment_id']); ?>" class="btn btn-primary" id="back"> 
                    Close
                </a>
            </div>
        </div></center>
     
        <?php echo form_close();?>
        <?php endforeach; ?>
</div>

