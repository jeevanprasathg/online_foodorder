<?php include('partials/menu.php');?>


<?php
if(isset($_GET['id']))
{
    //get all detaills
    $id = $_GET['id'];

    $sql2 = "SELECT*FROM tbl_food WHERE id=$id";

    //execute the query
    $res2 = mysqli_query($conn,$sql2);

    //get the value
    $row2 = mysqli_fetch_assoc($res2);

    //get individual valueof selected food

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $feature = $row2['feature'];
    $active = $row2['active'];
}
else{
    header('location:'.SITEURL.'admin/manage_food.php');
}
?>


<div class="main-content">
        <div class="wrapper">
             <h1>Update Food </h1><br>
             <br> <br> 

             <?php
             if(isset($_SESSION['upload']))
             {
                 echo $_SESSION ['upload'];
                 unset($_SESSION ['upload']) ;
             }
             ?>

             <form action ="" method="POST" enctype="multipart/form-data">
                 <table class="tbl-30">
                     <tr>
                         <td>Title:</td>
                         <td>
                             <input type="text" name="title" value="<?php echo $title; ?>">
                         </td>
                     </tr>

                     <tr>
                         <td>Description</td>
                         <td><textarea name="description"  cols="30" rows="10" ><?php  echo $description;?></textarea></td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value ="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>current Image:</td>
                        <td>
                            <?php 
                            if($current_image == "")
                            {
                               // image not available
                               echo "<div class='error'>Image not Available.</div>";

                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px" alt="">
                                <?php

                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image:</td>
                        <td>
                            <input type="file"  name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" >

                            <?php  
                                //create php codeto display categories from Database

                                //1., create sql to get all active categories from database

                                $sql ="SELECT* FROM tbl_category WHERE active='Yes'";
                                //Executing the query
                                $res =mysqli_query($conn,$sql);

                                //count rows to check we have categories or not
                                $count = mysqli_num_rows($res);

                                //If count is greater than 0, categories elase we not have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of category
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        // echo"<option value='$category_id;'>$category_title</option>";
                                        ?>

                                        <option <?php if($current_category==$category_id){echo "selected";} ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                      <?php 
                                     if($current_category==$category_id)
                                     {
                                         echo"selected";
                                         }?>value="<?php  echo $category_id; ?>"><?php echo $category_title;?></option>";
                                        <?php

                                    }
                                }
                                else
                                {
                                    //we do not have category
                                    
                                    echo"<option value='0'>No Category Found</option>";
                                    
                                }

                                //2., Display the Dropdown
                            ?>
                              
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Feature:</td>
                        <td>
                            <input type="radio"  name="feature"value="yes">yes
                            <input type="radio"   name="feature" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio"  name="active" value="yes">yes
                            <input type="radio"   name="active" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value ="<?php echo$id; ?>">
                            <input type="hidden" name="current_image" value ="<?php echo$current_image; ?>">


                        <input type="submit" name="submit" value="update food" class="btn-secondary" style="text-align:center">

                        </td>
                    </tr>

                 </table>

            </form>

            <?php
            
            if(isset($_POST['submit']))
            {
               // echo "button clicked";

               //1., get the detailsnfrom form

               $id = $_POST['id'];
               $title = $_POST['title'];
               $description = $_POST['description'];
               $price = $_POST['price'];
               $current_image = $_POST['current_image'];
               $category = $_POST['category'];
               $feature = $_POST['feature'];
               $active = $_POST['active'];

               //2.,upload the image if selected

               //check ypload button is clicked are not
               if(isset($_FILES['image']['name']))
               {
                   //uplload button clicked
                   //check the file is available
                   if($image_name!="")
                   {
                       //image available
                       $ext = end(explode('.',$image_name));

                       $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;

                       //get source &destination
                       $src_path = $_FILES['image']['tmp_name'];
                       $dest_path = "../images/food/".$image_name;


                       //upload the image

                       $upload = move_uploaded_file($src_path,$dest_path);


                       //check image is upload are not
                       if($upload==false)
                       {
                           //failed to upload
                           $_SESSION['upload'] = "<div class = 'error'>Failed To Upload New Image.</div>";
                           ///redirect to manage food
                           header('location:'.SITEURL.'admin/manage_food.php');

                           //stop the process

                           die();
                       }

                       //B.,
                       if($current_image!="")
                       {
                           //current image is available
                           //remove the image
                           $remove_path = "../images/food/".$current_image;

                           $remove = unlink($remove_path);

                           //checkn image is removed are not
                           if($remove ==false)
                           {
                               //failed to remove c image
                               $_SESSION['remove-failed'] = "<div class='error'>Failed To Remove Current Image.</div>";

                               //redirect to manage food
                               header('location:'.SITEURL.'admin/manage_food.php');

                               //stop the process
                               die();
                           }
                       }
                   }
                   else{
                       $image_name = $current_image;
                   }
               }
               else
               {
                   $image_name = $current_image;
               }


               //3.,remove the image if new image is upload $current image exists

               //4.,update the food in database

               $sql3 = "UPDATE tbl_food SET 
               title = '$title',
               description = '$description',
               price = $price,
               category_id = '$category',
               feature = '$feature',
               active = '$active'
               WHERE id=$id
               
               
               ";

               //execute the query
               $res3 = mysqli_query($conn , $sql3);

               //check the query is executed are not 

               if($res3==true)
               {
                   //food updated
                   $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                 //  header('location:'.SITEURL.'admin/manage_food.php');
               }
               else
               {
                   //faied yo update food

                   $_SESSION['update'] = "<div class='error'>Failed To Food Updated .</div>";
                  // header('location:'.SITEURL.'admin/manage_food.php');
               }

               //redirect to managa food in session msg
            }

            ?>




                            <!------------------------>

                         




            

         </div>
     </div>

 <?php include('partials/footer.php');?>

