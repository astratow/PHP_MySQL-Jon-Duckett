<?php
$today     = new DateTime();
$event     = new DateTime('2025-12-31 20:30');
$countdown = $today->diff($event);

$earlybird = new DateTime();
$interval  = new DateInterval('P1M');
$earlybird->add($interval);
?>
<?php include 'includes/header.php'; ?>

<p><b>Countdown to event:</b><br>
<?= $countdown->format('%y years %m months %d days') ?>
</p>
<p><b>50% off tickets bought by:</b><br>
<?= $earlybird->format('D d M Y, g:i a') ?>
</p>

<?php include 'includes/footer.php'; ?>