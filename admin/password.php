<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>


        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            } 
        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <!-- <tr>
                    <td>Current password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Old Password">
                    </td>
                </tr> -->

                <tr>
                    <td>New password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Re-Type Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;  ?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">

                    </td>
                </tr>
             </table>
        </form>
                
    </div>
</div>


<?php
//check whether submit are not
if(isset($_POST['submit']))
{
   // echo "button clicked";

   //1.,Get the data from form
   $_POST['id'];
  // $current_password =md5($_POST['current_password']);
   $new_password  =md5($_POST['new_password']);
   $confirm_password =md5($_POST['confirm_password']);


   //2.,check whether the user with current id and password exists or not

  // $sql ="SELECT*FROM tbl_admin WHERE id=$id AND password='$current_password'";

   //execute the query
   //$res =mysqli_query($conn ,$sql);

   if($new_password==$confirm_password)
   {
        //update the password
        $_SESSION['pwd-match'] ="<div class='success'>password updated successfully</div>";
                    //redirect the message to manage-admin
                    header('location:'.SITEURL.'admin/manage_admin.php'); 
   }
   else
   {
        //redirected to admin page
        $_SESSION['pwd-not-match'] ="<div class='error'>password did not match</div>";
                    //redirect the message to manage-admin
                    header('location:'.SITEURL.'admin/manage_admin.php');
   }
   
//    if($res==true)
//    {
//        //check data is available
//        $count=mysqli_num_rows($res);

//        if($count==1)
//        {
//            //user executed and password can be changed
//            echo "user found";
//        }
//        else
//        {
//            //user does not exists and message are redirect
//            $_SESSION['user-not-found'] ="<div class='error'>user not found</div>";
//            //redirect the message to manage-admin
//            header('location:'.SITEURL.'admin/manage_admin.php');
//        }

//    }

   //3.,check whether the new password and conform password

   //4.,change passworg if all aboveis true
  
}
?>

<?php include('partials/footer.php');?>











