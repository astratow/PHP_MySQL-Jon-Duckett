<?php
$text = 'Home sweet home';
?>
<?php include 'includes/header.php'; ?>

<p>
  <b>Lowercase:</b>
  <?= strtolower($text) ?><br>
  <b>Uppercase:</b>
  <?= strtoupper($text) ?><br>
  <b>Uppercase first letter</b>
  <?= ucwords($text) ?><br>
  <b>Character count:</b>
  <?= strlen($text) ?><br>
  <b>Word count:</b>
  <?= str_word_count($text) ?>
</p>

<?php include 'includes/footer.php'; ?>