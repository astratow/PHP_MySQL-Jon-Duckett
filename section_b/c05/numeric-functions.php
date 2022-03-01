<?php include 'includes/header.php'; ?> 
<p>
  <b>Round:</b>                     <?= round(9876.54321) ?><br>
  <b>Round to 2 decimal places:</b> <?= round(9876.54321, 2) ?><br>
  <b>Round half up:</b>             <?= round(1.5, 0, PHP_ROUND_HALF_UP) ?><br>
  <b>Round half down:</b>           <?= round(1.5, 0, PHP_ROUND_HALF_DOWN) ?><br>
  <b>Round up:</b>                  <?= ceil(1.23) ?><br>
  <b>Round down:</b>                <?= floor(1.23) ?><br>
  <b>Random number:</b>             <?= mt_rand(0, 10) ?><br>
  <b>Exponential:</b>               <?= pow(4, 5) ?><br>
  <b>Square root:</b>               <?= sqrt(16) ?><br>
  <b>Is a number:</b>               <?= is_numeric(123) ?><br>
  <b>Format number:</b>             <?= number_format(12345.6789, 2, ',', ' ') ?><br>
</p>
<?php include 'includes/footer.php'; ?>