<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_sidebar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/buttons.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/admin_calendar.css'); ?>">
<script>
  $(document).ready(function() {
    $('[data-bs-toggle="modal"]').click(function() {
        var date = $(this).data('date');
        $('#appointmentsModal .modal-title').html('Appointments for ' + date);
        $.ajax({
        url: '<?php echo base_url('admin/view_calendar_by_date'); ?>/' + date,
        success: function(data) {
            $('#appointmentsModal .modal-body').html(data);
        }
        });
    });
    });
  </script>
<title> iSmile Dental Care </title>

</head>
<body>

<div class="container form-control main-content">
    <h1>Dashboard</h1>
    <br>
    <table class="tb-main text-center table-bordered table-responsive">
      <thead class="th-main">
        <tr>
          <th>Sunday</th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
          <th>Saturday</th>
        </tr>
      </thead>
      <tbody class="tbody-main">
      <?php
            date_default_timezone_set('Asia/Manila');
            $month = date('m');
            $year = date('Y');
            $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $current_date = date('Y-m-d');
            $date = strtotime(date('Y-m-01'));
            echo '<tr>';
            for ($i = 1; $i <= $num_days; $i++) {
            $cell_date = date('Y-m-d', $date);
            $cell_class = '';
            $appointments = $this->appointment_model->get_calendar_by_date($cell_date);
            $has_appointment = !empty($appointments);
            if ($cell_date >= $current_date) {
                if ($cell_date == date('Y-m-d')) {
                // highlight today's date
                $cell_class = 'today';
                }
                echo '<td class="' . $cell_class . '">';
                echo '<a href="#" style="text-decoration:none; color:black; font-size:30px" data-bs-toggle="modal" data-bs-target="#appointmentsModal" data-date="' . $cell_date . '">' . $i;
                if ($has_appointment) {
                echo " <i class='bx bx-check text-danger'></i>"; // add icon if there are appointments
                }
                echo '</a>';
                echo '</td>';
            } else {
                echo '<td>&nbsp;</td>';
            }
                if (date('w', $date) == 6) {
                    echo '</tr><tr>';
            }
                $date = strtotime('+1 day', $date);
            }
            echo '</tr>';
         
            ?>
      </tbody>
    </table>

    <!-- Appointments Modal -->
    <div class="modal fade" id="appointmentsModal" tabindex="-1" aria-labelledby="appointmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentsModalLabel"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>


  
</div>

  


