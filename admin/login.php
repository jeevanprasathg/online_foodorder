<?php include('../admin/config/constants.php'); ?>


<html>
    <head>
        <title>login-system</title>
        <link rel="stylesheet" href="admin.css.css">

    </head>
    <body>
        <div class="login">
            <h2  class="text-center"> Admin panel</h2><br> 
            <h3 class="text-center"> LOGIN  </h3>

            <?php
            if(isset($_SESSION['login']))
            {
                echo($_SESSION['login']);
                unset($_SESSION['login']);//unset used to hide after reload the page
            }
            
            if(isset($_SESSION['no-login-message']))
            {
                echo($_SESSION['no-login-message']);
                unset($_SESSION['no-login-message']);//unset used to hide after reload the page
            }

            ?>
            <br> <br>


            <!-- login form starts-->
            <form action ="" method="POST" class="text-center">
                username:<br>
                <input type ="text" name="full_name" placeholder="user name" > <br> <br>


               password:<br>
                <input type ="password" name="password" placeholder="password"> <br> <br>

                <input type="submit" name ="submit" value="login" class="btn-primary"><br> <br>




              <!-- login form ends-->
               
           
        </div>

    </body>
</html>


<?php
//submit button click or not
if(isset($_POST['submit']))
{
    //1., get data from login form
    $full_name= mysqli_real_escape_string($conn , $_POST['full_name']);

    $raw_password = md5($_POST['password']);
    $password= mysqli_real_escape_string($conn ,$raw_password );


    //2.,sql query to check the username and password or not
    $sql ="SELECT*FROM tbl_admin WHERE full_name='$full_name' AND password='$password'";

    //3.,execute the query
    $res=mysqli_query($conn,$sql);

    //4., count ros to check the user exists are not

    $count =mysqli_num_rows($res);

    if($count==0)
    {
        //user available
        $_SESSION['login'] ="<div class='success'> Login Successfull</div>";
        $_SESSION['user']= $full_name;//check whether the user is loggeg in or out

        //redirect to home page
        header('location:'.SITEURL.'admin/');
    }
    else{
        //user not available
        $_SESSION['login'] ="<div class='error text-center'> Login failed</div>";
        //redirect to home page
        header('location:'.SITEURL.'admin/login.php');
    }


}




?>