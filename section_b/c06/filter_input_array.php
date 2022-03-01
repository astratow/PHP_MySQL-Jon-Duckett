<?php $form = filter_input_array(INPUT_POST); ?>
<?php include 'includes/header.php'; ?>

<form action="filter_input_array.php" method="POST">
  Email: <input type="text" name="email" value=""><br>
  I agree to terms and conditions:
  <input type="checkbox" name="terms" value="true"><br>
  <input type="submit" value="Save">
</form>
<pre><?php var_dump($form); ?></pre>

<?php include 'includes/footer.php'; ?>