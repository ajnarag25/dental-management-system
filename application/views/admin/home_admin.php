
<?php if($this->session->userdata('success') != NULL): ?>
    <div class="alert alert-success">
        <?php echo $this->session->userdata('success'); ?>
    </div>
<?php endif; ?>    

<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
</head>
<body>
 
  


