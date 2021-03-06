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

    $count = $connection->exec($sql) or die(print_r($db->errorInfo(), true));

    echo "Database created successfully, $count tables affected;";
}
catch(PDOException $error)
{
    echo $sql . "<br>" . $error->getMessage();
}
