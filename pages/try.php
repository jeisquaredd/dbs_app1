<?php

if(isset($_POST['adduser'])) {

echo 'button has been clicked';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

echo 'Hello '. $firstname .' '. $lastname .'';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>User Input</h2>
    <form action="" method="post">
    <input type="text" name="firstname" placeholder="First name">
    <br>

    <input type="text" name="lastname" placeholder="Last name">

    <br>
    <button name="adduser" type="submit">Create Account</button>
    
</form>
</body>
</html>