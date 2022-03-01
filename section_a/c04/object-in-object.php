<?php
declare(strict_types = 1);

class Account {
    public    AccountNumber $number;
    public    string        $type;
    protected float         $balance;

    public function __construct(AccountNumber $number, string $type, float $balance = 0.00)
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

class AccountNumber
{
    public int $accountNumber;
    public int $routingNumber;

    public function __construct(int $accountNumber,
                                int $routingNumber)
    {
        $this->accountNumber = $accountNumber;
        $this->routingNumber = $routingNumber;
    }
}

// Create an object to store in the property
$numbers = new AccountNumber(12345678, 987654321);
// Create instance of Account class + set properties
$account = new Account($numbers, 'Savings', 10.00);
?>
<?php include 'includes/header.php'; ?>
<h2><?= $account->type ?> Account</h2>
Account <?= $account->number->accountNumber ?><br>
Routing <?= $account->number->routingNumber ?><br>
<?php include 'includes/footer.php'; ?>