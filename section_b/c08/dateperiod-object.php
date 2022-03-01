<?php
$start    = new DateTime('2025-1-1');
$end      = new DateTime('2026-1-1');
$interval = new DateInterval('P1M');
$period   = new DatePeriod($start, $interval, $end);
?>
<?php include 'includes/header.php'; ?> 
  <p>
    <?php foreach ($period as $event) { ?>
      <b><?= $event->format('l') ?></b>, <?= $event->format('M j Y') ?></b><br>
    <?php } ?>
  </p>
<?php include 'includes/footer.php'; ?>