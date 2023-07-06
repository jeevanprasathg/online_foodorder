<!-----------------------database connection------------------------------------->



<!--  this page is connected in menu(header page)in partials folder-->

<?php
//start session
session_start();



    //create constants to store repeating value
    define('SITEURL','http://localhost/orders/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','orders');



//3.,execute the qwery & save database
$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD)or die(mysqli_error());//data base connection
$db_select=mysqli_select_db($conn,DB_NAME)or die(mysqli_error());
?>