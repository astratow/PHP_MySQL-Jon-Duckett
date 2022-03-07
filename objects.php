<?php
class Customer
{
  public string $forename;
  public string $username;
  public string $email;
  public string $password;
}

class Account
{
  public int      $number;
  public string   $type;
  public float    $balance; 
}

$customer = new Customer();
$account  = new Account();
$customer->forename = 'Janek';
$customer->email = 'ivy@reg.link';
$account->balance = 1000.00;
?>
<?php include 'includes/header.php'; ?>
  <p>Forename: <?= $customer->forename ?>
  </p><p>Email: <?= $customer->email ?>
  </p><p>Balance: <?= $account->balance ?></p>
<?php include 'includes/footer.php'; ?>

