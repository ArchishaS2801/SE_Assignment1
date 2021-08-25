<?php

//require 'includes/common.php';
$email= mysqli_real_escape_string($con,$_POST['email']);
$pass=mysqli_real_escape_string($con,$_POST['password']);


$sq="SELECT id,password,email,name FROM users WHERE email='$email'";
$sq_result=mysqli_query($con,$sq) or die(mysqli_error($con));
$rows= mysqli_num_rows($sq_result);
$values= mysqli_fetch_array($sq_result);



if($rows==0)
{
    header('location: login.php?error=invalid credentials');
}
 else
{
    $row= mysqli_fetch_array($sq_result);
    if(($email != $row['email']) && (password_verify($pass,$row['password'])))
    {
        header('location: login.php?email_error=incorrect email');
    }
    else if(($email == $row['email']) && !(password_verify($pass,$row['password'])))
    {
        header('location: login.php?perror=incorrect password');
    }
    else
    {
    //$_SESSION['email']=$email;
    //$_SESSION['u']=$values['name'].$values['id'];
    
    
    header('location: dashboard.php');
    }
}
?>






