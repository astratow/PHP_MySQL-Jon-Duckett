<?php
$text = 'Using PHP\'s regular expression functions';
$path = 'code/section_b/c05/';

$match = preg_match('/PHP/', $text);
$path  = preg_split('/\//', $path);
$text  = preg_replace('/PHP/', '<em>PHP</em>', $text);
?>
<?php include 'includes/header.php'; ?>
<p>
  <b>Was a match found?</b><br>
  <?= ($match === 1) ? 'Yes' : 'No' ?><br><br>

  <b>Parts of a path:</b><br>
  <?php foreach($path as $part) { ?>
    <?= $part ?><br>
  <?php } ?>

  <b>Updated text:</b><br>
  <?= $text ?>
</p>
<?php include 'includes/footer.php'; ?>