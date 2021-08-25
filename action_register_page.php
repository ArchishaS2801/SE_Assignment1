<?php

require 'includes/common.php';

$passwd=mysqli_real_escape_string($con,$_POST['psw']);

$password= password_hash($passwd, PASSWORD_DEFAULT);

$email=mysqli_real_escape_string($con,$_POST['email']);

$cont=mysqli_real_escape_string($con,$_POST['number']);

$add=mysqli_real_escape_string($con,$_POST['add']);

$nme=mysqli_real_escape_string($con,$_POST['name']);
$name=str_replace(' ', '', $nme);
$address=str_replace(' ', '', $add);
$contact=str_replace(' ', '', $cont);


$search_query="SELECT password,id FROM users WHERE email='$email'";
$search_result= mysqli_query($con, $search_query);
$rows= mysqli_num_rows($search_result);
$roww= mysqli_fetch_array($search_result);

if($rows>0)
{
        header('location: Page2.html?e_error=this email is already registered');
    
}
 else 
 {
     if(!ctype_alnum($name))
     {
         header('location: Page2.html?n_error=incorrect format');
     }
     else if (!ctype_alnum($address)) 
     {
         header('location: Page2.html?a_error=incorrect format');
     }
     else if(!is_numeric($contact))
     {
         header('location: Page2.html?c_error=incorrect format');
     }
     else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
    header('location: Page2.html?email_error=enter a valid email'); 
    }
     
     else
     {
     $user_reg_query="INSERT INTO users(name,email,password,contact,address)values('$name','$email','$password','$contact','$address')";  
      $user_reg_submit= mysqli_query($con, $user_reg_query) or die(mysqli_error($con));
      
      $fetch_id="SELECT id FROM users WHERE email='$email'";
      $result= mysqli_query($con, $fetch_id);
      $val= mysqli_fetch_array($result);
      
     $_SESSION['email']=$email;
     
     $_SESSION['register']='success';
     
     header('location: dashboard.html');       
     }    
 }
    
 ?>



