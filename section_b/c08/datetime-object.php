<?php
$start = new DateTime('2021-01-01 00:00');
$end   = date_create_from_format('Y-m-d H:i', 
    '2021-02-01 00:00');
?>
<?php include 'includes/header.php'; ?> 

<p><b>Sale starts:</b>
<?= $start->format('l, jS M Y H:i') ?></p>
<p><b>Sale ends:</b>
<?= $end->format('l, jS M Y') ?> <b>at</b>
<?= $end->format('H:i') ?></p>

<?php include 'includes/footer.php'; ?>