<?php
$start = new DateTime();
$start->setDate(2021, 12, 01);
$start->setTime(17, 30);
$end = clone $start;
$end->modify('+2 hours 15 min');
?>
<?php include 'includes/header.php'; ?> 

<p><b>Event starts:</b>
  <?= $start->format('g:i a - D, M j Y') ?></p>

<p><b>Event ends:</b>
  <?= $end->format('g:i a - D, M j Y') ?></p>

<?php include 'includes/footer.php'; ?> 