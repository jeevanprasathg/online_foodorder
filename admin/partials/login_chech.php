<?php
//Authorization -Accss control

//ceck whether the user is logged in or not
if(!isset($_SESSION['user']))
{
    //user is not logned in 

    //redirect to login page
    $_SESSION['no-login-message']="<div class='error text-center'>please login to access Admin panel.</div>";

    header('location:'.SITEURL.'admin/login.php');
}

?>