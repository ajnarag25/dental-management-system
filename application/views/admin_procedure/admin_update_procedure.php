<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_update.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Disabled buttons -->
<script>
    $(document).ready(function() {
        $('.form-control').each(function() {
            $(this).data('initial-value', $(this).val());
            $(this).on('input', function() {
            if ($(this).val() === $(this).data('initial-value')) {
                $('#submit-btn').prop('disabled', true);
            } else {
                $('#submit-btn').prop('disabled', false);
            }
            });
        });
    });
    
    function validatePrice(input) {
    var regex = /^[0-9]+(\.[0-9]{0,2})?$/;
    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^0-9\.]/g, '');
    }
    }

</script>
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col col-md-6" style="margin: auto">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button><?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if($this->session->userdata('success') != NULL): ?>
                <div class="alert alert-success alert-dismissible fade show" style="margin:auto;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" ></button><?php echo $this->session->userdata('success'); ?>
                </div>
            <?php endif; ?>
        
        </div>
    </div>
    
    <?php echo form_open('Admin_Procedure/update_procedure_func'); ?>
        <input type="hidden" name="procedure_id" value="<?= $procedure['procedure_id']?>">

         <!--first row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="procedure_name" class="form-label">Procedure Name: </label>
                <input type="text" class="form-control" name="procedure_name" id="procedure_name"  value="<?= $procedure['procedure_name'];  ?>" readonly Disabled/>    
            </div>
            <div class="col-md-4 form-group">
                <label for="procedure_legend" class="form-label">Procedure Legend:</label>
                <input type="color" class="form-control" name="procedure_legend" id="procedure_legend"   value="<?= $procedure['procedure_legend'];  ?>"/>    
            </div>
            <div class="col-md-4 form-group">
                <label for="procedure_duration">Procedure Duration:</label>
                <select name="procedure_duration" id="procedure_duration" class="form-control" value="<?php echo set_value('procedure_duration'); ?>">
                    <option name="procedure_duration" value="0"  <?php if ($procedure['procedure_duration'] == '0') echo 'selected'; ?> disabled>Select duration</option>
                    <option name="procedure_duration" value="15" <?php if ($procedure['procedure_duration'] == '15') echo 'selected'; ?> >15 minutes</option>
                    <option name="procedure_duration" value="30" <?php if ($procedure['procedure_duration'] == '30') echo 'selected'; ?> >30 minutes</option>
                    <option name="procedure_duration" value="45" <?php if ($procedure['procedure_duration'] == '45') echo 'selected'; ?> >45 minutes</option>
                    <option name="procedure_duration" value="60" <?php if ($procedure['procedure_duration'] == '60') echo 'selected'; ?> >60 minutes</option>
                    <option name="procedure_duration" value="90" <?php if ($procedure['procedure_duration'] == '90') echo 'selected'; ?> >90 minutes</option>
                    <option name="procedure_duration" value="120"<?php if ($procedure['procedure_duration'] == '120') echo 'selected'; ?> >120 minutes</option>
                </select>
                
            </div>
        </div>   
       
        <!--second row-->
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="procedure_price" class="form-label">Procedure Price:</label>
                <input type="text" class="form-control" name="procedure_price" id="procedure_price" oninput="validatePrice(this)"
                value="<?= $procedure['procedure_price'];  ?>"/>    
            </div>
            <div class="col-md-4 form-group">
                <label for="procedure_desc" class="form-label">Procedure Description: </label>
                <input type="text" class="form-control" name="procedure_desc" id="procedure_desc"  value="<?= $procedure['procedure_desc'];  ?>"/>      
            </div>
        
        </div>   

        <!-- button -->
        <div class="row">
            <div class="col form-group">
                <a href="<?= base_url('Admin_Procedure/admin_manage_procedures'); ?>" class="btn btn-danger" id="back-btn" >Back</a>
                <button type=submit name="submit" class="btn btn-primary" style="float: right;"id="submit-btn" disabled>Update Account</button>
            </div>
        </div>
    <?php echo form_close();?>
</div>
