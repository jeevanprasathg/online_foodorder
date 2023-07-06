<?php

        //including constants.php file
    include('../admin/config/constants.php');
   
    
    //1.,get the admin ID admin to delete
    $id=$_GET['id'];


    //2.,create sql qwery to dlete admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";


    //execute the qwery
    $res=mysqli_query($conn,$sql);

    //check the qwery executed 
    if($res==true)
    {
       // echo "admin deleted";

       //create a SESSION variable to display message
       $_SESSION['delete']="<div class='success'>Admin Deleted Succcessfully</div>";

       //Redirect to the manage-admin page
       header("location:".SITEURL.'admin/manage_admin.php');
    }
    else{
        //echo "admin not deleted";

        $_SESSION['delete']="<div class='error'>Failed to Delete Admin</div>";
         //Redirect to the manage-admin page
       header("location:".SITEURL.'admin/manage_admin.php');
    }

    //3., redirect to manage admin with msg
?>