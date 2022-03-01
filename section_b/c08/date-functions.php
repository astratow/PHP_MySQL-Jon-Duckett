<?php
$start      = strtotime('January 1 2021');
$end        = mktime(0, 0, 0, 2, 1, 2021);
$start_date = date('l, d M Y', $start);
$end_date   = date('l, d M Y', $end);
?>
<?php include 'includes/header.php'; ?>

  <p><b>Sale starts:</b> <?= $start_date ?></p>
  <p><b>Sale ends:</b> <?= $end_date ?></p>

<?php include 'includes/footer.php'; ?>