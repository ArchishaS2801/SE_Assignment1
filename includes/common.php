<?php
$con= mysqli_connect("localhost", "root", "", "SE_first");
if(!isset($_SESSION['email']))
{
session_start();
}

define ("KEY", "PasswordManager1234")
?>

