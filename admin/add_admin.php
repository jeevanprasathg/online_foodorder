<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD ADMIN</h1><br>


        <?php
        
        if(isset($_SESSION['add']))
        {
            echo($_SESSION['add']);
            unset($_SESSION['add']);//unset used to hide after reload the page
        }
            ?>

        <form action="" method="POST">
            <table class="tbl">
                <tr>
                    <td>full-name</td>
                    <td><input type="text" name="full-name" placeholder="Enter your Name" class="box"></td>
                </tr>
                <tr>
                    <td>password</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                     <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary" style="text-align:center">
                    </td> 
                   <!-- <td>
                        <button type="button" name="submit" class="btn-secondary "> Add </button>
                    </td>-->
                </tr>
            </table>


        </form>
    </div>
</div>




<?php include('partials/footer.php')?>

                      <!---------------php basic coding------------------------>

<!--<?php
    if(isset($_POST['submit']))
    {
        echo "button clicked";
    }                                 //this code is commented
    else
    {
        echo "button not clicked";
    }

?>-->
                    <!--------------------- basic coding ends--------------------------->

                    <!------------------ php coding starts--------------------->

<?php
    if(isset($_POST['submit']))

    {
        //1.,get the data from form
       $full_name=$_POST['full-name'];
       $password=md5($_POST['password']);//md5 is used to encrypte password
    
       /*2.,SQL query to save  into database*/
       $sql="INSERT INTO tbl_admin SET

            full_name='$full_name',
            password='$password'


       ";
      // echo $sql;
        //
      $res=mysqli_query($conn, $sql) or die(mysqli_error());
      if($res==TRUE)
      {
         // echo"Data inserted";
         //create the session variable


         $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
         //want to redirect page to manage-admin
         header("location:".SITEURL.'admin/manage_admin.php');
      }
      else
      {
         // echo "falsssse";
          //create the session variable


         $_SESSION['add'] = "failed to  added admin";
         //want to redirect page to add-admin
         header("location:".SITEURL.'admin/add_admin.php');
      }
}

    
?> 
