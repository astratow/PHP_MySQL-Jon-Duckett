<?php
$text = '/images/uploads/';
?>
<?php include 'includes/header.php'; ?>
<p>
  <b>Remove '/' from both ends:</b><br>
  <?= trim($text, '/') ?><br>
  <b>Remove '/' from the left of the string:</b><br>
  <?= ltrim($text, '/') ?><br>
  <b>Remove 's/' from the right of the string:</b><br>
  <?= rtrim($text, 's/') ?><br>
  <b>Replace 'images' with 'img':</b><br>
  <?= str_replace('images', 'img', $text) ?><br>
  <b>As above but case-insensitive:</b><br>
  <?= str_ireplace('IMAGES', 'img', $text) ?><br>
  <b>Repeat the string:</b><br>
  <?= str_repeat($text, 2) ?></p>
</p>
<?php include 'includes/footer.php'; ?>