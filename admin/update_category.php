<?php include('partials/menu.php');?>
<div class=" main-content">
<h1> Update Category </h1>
<br>
<?php
//check whether the id is set are not
if(isset($_GET['id']))
{
    //get  the id and all other details
   // echo"getting data";
   $id = $_GET['id'];
   //create sql query to get all detail
   $sql = "SELECT *FROM tbl_category WHERE id=$id ";

   //execute the query
   $res = mysqli_query($conn , $sql);

   //count the rows to check is valid are not
   $count= mysqli_num_rows($res);

   if($count==1)
   {
       //get alll data
       $row = mysqli_fetch_assoc($res);
       $title = $row['title'];
       $current_image = $row['image_name'];
       $feature= $row['feature'];                  //////////////
       $active = $row['active'];
   }
   else{
       //redirect t manage category to msg
       $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
       header('location:'.SITEURL.'admin/manage_category.php');
   }
}
else
{
     //redirect to manage category
     header('location:'.SITEURL.'admin/manage_category.php');
}

?>





<form action=""  method="POST"enctype="multipart/form-data">
    <table class="tbl-30">
         <tr>
             <td>Title :</td>
             <td>
              <input type="text" name="title" placeholder="category Title"  class="box" value="<?php echo$title; ?>">
             </td>
         </tr>
         <tr>
             <td>Current Image:</td>
             <td>
             <?php
                                //check image is available are not
                                if($current_image!="")
                                {
                                    //display the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php  echo $current_image;?>" width="100px">
                                    <?php
                                }
                                else
                                {
                                    //display the msg
                                    echo"<div class='error'>Image not Added.</div>";

                                }
                                ?>
             </td>
         </tr>
          <tr>
            <td>New Image:</td>
             <td><input type="file" name="image"></td>
         </tr>

        <tr>
            <td>Featured:</td>
            <td> 
                  <input type="radio" name="feature" value="yes">Yes
                  <input type="radio" name="feature" value="no">no
            </td>


        </tr>

       <tr>
            <td>Active:</td>
             <td>
                 <input type="radio" name="active" value="yes">Yes
                 <input type="radio" name="active" value="no">no
            </td>


        </tr>

        <tr>
                        <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo$current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo$id; ?>">

                        <input type="submit" name="submit" value="update category" class="btn-secondary" style="text-align:center">

                        </td>
                    </tr>

</table>
</form>


<?php  
        //check wheather the submit is clicked or not
         if (isset ($_POST['submit']))
         {
           //  echo"clicked";
           // 1.,get the value from category form
           $id=$_POST['id'];
           $title=$_POST['title'];
           $current_image=$_POST['current_image']; 
           $feature=$_POST['feature'];
           $active=$_POST['active'];

           //2/.updating new image

           //A check the image is selected are not

           if(isset($_FILES['image']['name']))
           {
             $image_name = $_FILES['image']['name'];

             //check the image is available are not
             if($image_name!="")
             {
                //image available
                //upload a new image

                 //auto rename our image
          $ext = end(explode('.',$image_name));
          //rename the image
          $image_name = "Food_category".rand(000,999).'.'.$ext;


          $source_path=$_FILES['image']['tmp_name'];

          $destination_path ="../images/category/".$image_name;

          //finally upload the image
          $upload = move_uploaded_file($source_path ,$destination_path);

          ////check wheater the image is upload are not
          //if the image is not uploaded then we will stop and redirect with error msg
            if($upload==false)
            {
              //SET image
          
             $_SESSION['upload'] = "<div class='error'>Failed to upload image .</div>";
             //redirect to add ctegory page
             header("location:".SITEURL.'admin/manage_category.php');

             //stop the process
             die();
            }
                //B remove the current image
                if($current_image!="")
                {
                    $remove_path = "../images/category/".$current_image;

                    $remove = unlink($remove_path);
    
                    //check the image is removed are not
    
                    if($remove==false)
                    {
                        $_SESSION['failed'] = "<div class='error'>Failed to remove current image .</div>";
                        //redirect to add ctegory page
                        header("location:".SITEURL.'admin/manage_category.php');
                        die();
                    }
                }
               
             }
             else
             {
                $image_name = $current_image;
             }
           }
           else
           {
               $image_name = $current_image;
           }


           //3.,update the database

           $sql2= "UPDATE tbl_category SET
           title ='$title',
           image_name = '$image_name',
           feature = '$feature',
           active = '$active'
           WHERE id=$id
           
           ";

           //executed the query
           $res2 = mysqli_query($conn ,$sql2);

           //4, redirect to manage category with msg

           //checkwheater the executed or not
           if($res2==true)
           {
               //category updated
               $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
               //redirect tomanage ctegory page
               header('location:'.SITEURL.'admin/manage_category.php');
           }
           else
           {
               ///failed to updated category
               $_SESSION['update'] = "<div class='error'> Failed to Update Category .</div>";
               //redirect tomanage ctegory page
               header('location:'.SITEURL.'admin/manage_category.php');
           }
         }
        ?>









</div>

</div>





<?php include('partials/footer.php');?>
