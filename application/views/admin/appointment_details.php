<ul>
    <?php if (!empty($dates)): ?>
        <?php foreach ($dates as $row): ?>
            <li>
                <center>
                    <h4><strong><?= $row->start_time ?> - <?=  $row->end_time ?></strong></h4>
                </center>
            
            </li>
            <li>
                <center>
                    <h4>Patient: <?= $row->patient ?></h4>
                </center>
            </li>
            <li>
                <center>
                    <h4>Service: <?= $row->service_name ?></h4>
                </center>
            </li>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <center>
            <p>No appointments available for this date.</p>
        </center>
    <?php endif; ?>
</ul>