<?php 
    //include constants file
    include('../admin/config/constants.php');

   // echo"delete page";
   //check whether the id nd image_nameis set are not
   if(isset($_GET['id'])AND isset($_GET['image_name']))
   {
       //get the value and delete
      // echo "get value and delete";
      $id = $_GET['id'];
      $image_name = $_GET['image_name'];

      //remove the physical image file is available
      if($image_name !="")
      {
          //image is available so remove it
          $path = "../images/category/".$image_name;
          //remove image
          $remove = unlink($path);

         // if($remove==true)
          //{
              //set the session msg 
          //    $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
              //to reditect to category page
            //  header('location:'.SITEURL.'admin/manage_category.php');
              //stop the process
              //die();

          //}
      }

      //delete data from database
      //sql to delete data fro database
      $sql = "DELETE FROM tbl_category WHERE id=$id";

      //execute  the query
      $res = mysqli_query($conn, $sql);

      //check whether the data is delete from database
      if($res==true)
      {
          //set sucess message
          $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
          //redirect to manage category
          header('location:'.SITEURL.'admin/manage_category.php');
          
      }
      else{
            //set failed message
          $_SESSION['delete'] = "<div class='error'>failed to Delete Category.</div>";
          //redirect to manage category
          header('location:'.SITEURL.'admin/manage_category.php');
      }
   }
   else
   {
        //redirect to mange admin category
        header('location:'.SITEURL.'admin/manage_category.php');
   }
?>