<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Database error</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
  <?php
    echo "<h1>You're not connected to the database, let's try to fix that...</h1>";
    switch ($e->getCode()) {
        case 0:
            echo 'The value for <code>$type</code> must be <code>mysql</code>. It is the first value in the DSN.';
            break;
        case 2002:
            echo 'The value for <code>$server</code> is incorrect.<br>
                  If you are using MAMP or XAMPP try <code>localhost</code>.<br>
                  If you still see the same error try <code>127.0.0.1</code>. This IP address is reserved for your local machine.';
	    	break;
        case 1044:
            echo 'Your user account does not appear to have permission to work with this database. Check the permissions in phpMyAdmin.';
            break;
        case 1045:
            echo 'The username or password appear to be wrong. In phpMyAdmin check the user account was created. Then make sure you have the correct username and password in the $username and $password variables.';
            break;
        case 1049:
            echo 'The value for <code>$db</code> is incorrect. Check the database name in phpMyAdmin.';
            break;
        case 1042:
            echo 'Cannot get hostname for your database server';
            break;
        case 2002:
            echo 'Cannot connect to MySQL on ___';
            break;
        case 2003:
            echo '1. Check that MySQL is running.<br>If this does not work, check the port number in phpMyAdmin. See <a href="http://notes.re/mysql/check-ports">http://notes.re/mysql/check-ports</a>.';
            break;
        case 2005:
            echo 'The value for $server is incorrect.<br>
                  If you are using MAMP or XAMPP try <code>localhost</code>.<br>
                  If you still see the same error try <code>127.0.0.1</code>. This IP address is reserved for your local machine.';
            break;
        case 2019:
            echo 'The <code>charset</code> in the DSN is incorrect. Set it to <code>utf8</code>.';
            break;
        default:
            echo 'First, check that you have: 
                 <ul>
                     <li>Created the sample database in phpMyAdmin</li>
                     <li>Created a user account to access the database</li>
                 </ul>
                 Next, check the individual ';
            break;
    }
    echo '<p><b>SQLSTATE error code:</b> ';
    echo $e->getCode() . '</p>';
    echo '<p><b>Error message: </b>';
    echo $e->getMessage() . '</p>'
  ?>
  </body>
</html>