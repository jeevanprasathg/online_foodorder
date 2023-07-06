<?php

//include constant page
include('../admin/config/constants.php');

//echo"delete food page";
if(isset($_GET['id']) && isset($_GET['image_name']))//use && or AND
{
    //process to delete
    //echo"process to delete";

    //1.,$get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //2., remove the image if available
    if($image_name !="")
    {
        //get the image path
        $path = "../images/food/".$image_name;

        //remove image file from folder

        $remove  = unlink($path);

        //check the image is removed are not

        if($remove==false)
        {
            //failed to removr image
            $_SESSION['upload'] = "<div class='error'>failed to remove image file.</div>";

            //redirect to manage food
            header('location:'.SITEURL.'admin/manage_food.php');
            //stop the process

            die();
        }
    }
    //3.,delete data from database
      //sql to delete data fro database
      $sql = "DELETE FROM tbl_food WHERE id=$id";

      //execute  the query
      $res = mysqli_query($conn, $sql);

      //check whether the data is delete from database
      if($res==true)
      {
          //set sucess deleted message
          $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
          //redirect to manage category
          header('location:'.SITEURL.'admin/manage_food.php');
          
      }
      else{
            //set failed message
          $_SESSION['delete'] = "<div class='error'>failed to Delete Category.</div>";
          //redirect to manage category
          header('location:'.SITEURL.'admin/manage_food.php');
      }
   }
else
{
    //redirect to mange admin category
    $_SESSION['delete'] = "<div class='error'>Unauthorized Food</div>";
    header('location:'.SITEURL.'admin/manage_food.php');
}


?>