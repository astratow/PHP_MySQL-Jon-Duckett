<?php
declare(strict_types = 1);

class Account {
    public    array  $number;
    public    string $type;
    protected float  $balance;

    public function __construct(array $number, string $type, float $balance = 0.00)
    {
        $this->number  = $number;
        $this->type    = $type;
        $this->balance = $balance;
    }

    public function deposit(float $amount): float
    {
        $this->balance += $amount;
        return $this->balance;
    }

    public function withdraw(float $amount): float
    {
        $this->balance -= $amount;
        return $this->balance;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}

//Create an array to store in the property
$numbers = ['account_number' => 12345678,
            'routing_number' => 987654321,];

//Create an instance of the class and set properties
$account = new Account($numbers, 'Savings', 10.00);
?>
<?php include 'includes/header.php'; ?>
<h2><?= $account->type ?> account</h2>
Account <?= $account->number['account_number'] ?><br>
Routing <?= $account->number['routing_number'] ?>
<?php include 'includes/footer.php'; ?>