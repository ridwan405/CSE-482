<?php

$dbHostName= "localhost";
$dbUserName= "root";
$dbPass= "";
$dbDataBase= "food_db"; /*"food project"?*/


$con= mysqli_connect($dbHostName, $dbUserName, $dbPass, $dbDataBase);

if(!$con){
    die("db con failed");
}


?>



