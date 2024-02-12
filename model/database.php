<?php

// variables with database information
$dsn = 'mysql:host=localhost;dbname=final';
$username = 'staff';
$password = 'password';

// creating PDO object for connecting to database
try {
    $db = new PDO($dsn, $username, $password);
} // endtry
catch (PDOexception $e) {
    $errorMsg = $e->getMessage();
    include('views/error.php');
    exit();
} // endcatch

?>