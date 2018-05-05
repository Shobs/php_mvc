<?php
require_once("../config.php");
require_once("../connection.php");

/**
 * Open a connection via PDO to create a
 * new database and table with structure.
 * Since I wasn't able to parse commands
 * from file into msqli.  Other application
 * db connections are with msqli though.
 */

// $DB = $configs['DB'];
// $conn = new mysqli($DB['host'], $DB['username'] , $DB['password']);

// $sql = file_get_contents("init.sql");

// echo $sql;

// if ($conn->query($sql) === TRUE) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: " . $conn->error;
// }



$host       = $configs['DB']['host'];
$username   = $configs['DB']['username'];
$password   = $configs['DB']['password'];
$dbname     = $configs['DB']['DBName']; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
);

try
{
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    // sql script to generate dummy database and data
    $sql = file_get_contents("init.sql");
    // $connection->exec($sql);

    if ($connection->exec($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: ";
        var_dump($connection->errorInfo());
    }

}
catch(PDOException $error)
{
    echo $sql . "<br>" . $error->getMessage();
}

// try
// {

//     // sql script to generate dummy database and data
//     $sql = file_get_contents("init.sql");
//     $conn->query($sql);

//     if ($conn->connect_error) die($conn->connect_error);

//     echo "Database and table users created successfully.";
// }
// catch(Exception $error)
// {
//     echo $sql . "<br>" . $error->getMessage();
// }