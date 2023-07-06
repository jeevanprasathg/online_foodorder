<?php include('partials/menu.php');?>
<div class="main-content">
        <div class="wrapper">
             <h1>Add Food </h1><br>
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
                             <input type="text" name="title" placeholder="Food Title">
                         </td>
                     </tr>

                     <tr>
                         <td>Description</td>
                         <td><textarea name="description" id="" cols="30" rows="10" placeholder="descripted food"></textarea></td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
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
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                         <option value="1"><?php  echo $id; ?><?php echo $title;?></option>
                                        <?php

                                    }
                                }
                                else
                                {
                                    //we do not have category
                                    ?>
                                     <option value="0">No Category Found</option>
                                    <?php
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
                        <input type="submit" name="submit" value="Add food" class="btn-secondary" style="text-align:center">

                        </td>
                    </tr>

                 </table>

            </form>

            <?php  
                //check wheater the btn is clicked are not
                if(isset($_POST['submit']))
                {
                    //add data in database
                   // echo "submitted";

                   //1., get the data form form
                   $title = $_POST['title'];
                   $description = $_POST['description'];
                   $price = $_POST['price'];
                   $category = $_POST['category'];

                   // check radio button for featured and active are not
                   if(isset($_POST['feature']))
                   {
                    $feature = $_POST['feature'];
                   }
                   else
                   {
                    $feature ="No";
                   }

                     // check radio button for active and active are not
                     if(isset($_POST['active']))
                     {
                      $active = $_POST['active'];
                     }
                     else
                     {
                      $active ="No";
                     }

                   //2.,upload the image if selected

                   //check whether the selected image are not and upload the image 

                   if(isset($_FILES['image'] ['name']))
                   {
                       //get the details of selected image
                       $image_name = $_FILES['image'] ['name'];

                       //check wheater the image is selected

                       if($image_name!="")
                       {
                           //image selected
                           //A., rename the image
                           // image format eg., jeevan.jpg
                          $ext = end(explode('.',$image_name));
                           //create new name for image
                          $image_name ="Food_Name".rand(000,999).".".$ext;

                           //B., upload the image
                           //get the source path

                           //source path is the current location
                           $source_path = $_FILES['image'] ['tmp_name'];

                           //destination path
                           $destination_path  = "../images/food/".$image_name;

                           //finally uploaded
                           $upload = move_uploaded_file($source_path, $destination_path);

                           //check wheater the image is uploaded r not
                           if($upload==false)
                           {
                               //failes to upload the image
                               //redirect to add food page with error msg
                               $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";

                               header('location:'.SITEURL.'admin/add_food.php');
                               //stop the process

                               die();
                           }
                       }

                   }
                   else
                   {
                       $image_name = "";//dfault value

                   }

                   //3., Insert into database

                   //create sq query
                   //for numerical value we do not pass the single quotes
                   $sql2="INSERT  INTO tbl_food SET
                   title ='$title',
                   description ='$description',
                   price =$price,
                   
                   category_id =$category,
                   feature ='$feature',
                   active = '$active'
                   ";

                   //execute the query
                   $res2 = mysqli_query($conn,$sql2);
                   if($res2==true)
                   {
                    //data inserted successfully
                    $_SESSION['add'] ="<div class='success'>Food Added Successfully</div>";

                   header('location:'.SITEURL.'admin/manage_food.php');

                   }
                   else
                   {
                    //failed to insert data

                    $_SESSION['add'] ="<div class='error'>Failed To Add Food </div>";

                    header('location:'.SITEURL.'admin/manage_food.php');

                   }

                }
            ?>
         </div>
</div>








<?php include('partials/footer.php');?>

