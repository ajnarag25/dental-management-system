<!DOCTYPE html>
<html>
<head>
	<title>Calendar</title>
</head>
<body>
	<h1>Calendar</h1>
	<p>Select a date to view appointments:</p>
	<?php
	$today = date('Y-m-d');
	$days_in_month = date('t');
	for ($day = 1; $day <= $days_in_month; $day++) {
		$date = date('Y-m-d', strtotime("$day-$today"));
		echo "<a href='".base_url()."view_appointments/$date'>$day</a> ";
	}
	?>
    <a href="<?php echo base_url('Appointment/newpage'); ?>">Go to New Page</a>

</body>
</html>