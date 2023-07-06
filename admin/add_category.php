<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD CATEGORY</h1>
        <br>
        <?php  
        if(isset($_SESSION['add']))
        {
            echo $_SESSION ['add'];
            unset($_SESSION ['add']) ;
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION ['upload'];
            unset($_SESSION ['upload']) ;
        }
        
        ?>

        <!--add category starts-->
            <form action="" method="POST"enctype="multipart/form-data">
                <table class="tbl-30" >
                    <tr>
                        <td> Title:</td>
                        <td>
                             <input type="text" name="title" placeholder="category Title"  class="box">
                        </td>
                    </tr>

                    <tr>
                        <td>select Image:</td>
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
                        <input type="submit" name="submit" value="Add category" class="btn-secondary" style="text-align:center">

                        </td>
                    </tr>
 
                </table>
            </forms>
        <!--add category ends-->

        <?php  
        //check wheather the submit is clicked or not
         if (isset ($_POST['submit']))
         {
           //  echo"clicked";
           // 1.,get the value from category form
           $title=$_POST['title'];

           //for radio input we need to check whether the button is selected or not
           if(isset($_POST['feature']))
           {
               //get the value from form
               $feature=$_POST['feature'];

           }
           else
           {
               //set the default value
               $feature ="No";
           }


           if(isset($_POST['active']))
           {
               $active=$_POST['active'];
           }
           else
           {
            $active ="No";
           }

           //check whether the image is selected or not and set the value for the image name accoridinly
           //print_r($_FILES['image']);

          // die();//break the code here

          if(isset($_FILES['image'] ['name']));
          {
          //upload the image 
          //to upload the image we need the image name,source path and destination path

          $image_name =$_FILES['image']['name'];

          //upload the image oly image is selected
          if($image_name!="")
          {

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
             header("location:".SITEURL.'admin/add_category.php');

             //stop the process
             die();
            }
            }


          }
        //   else{
        
        //     //dont upload the image  set image name as blank
        //     $image_name ="";
        //    }



           
           // 2., create SQL query to insert category into database
           $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
               feature='$feature',
               active='$active'
           ";

           // 3.,execute the query in save database
           $res =mysqli_query($conn,$sql);

           //4.,check wheater the query execute are not
           if($res==true)
           {
               //query executed and category added
               $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
               //redirect tomanage ctegory page
               header("location:".SITEURL.'admin/manage_category.php');
             
            }
            else
            {
                $_SESSION['add'] = "<div class='sucess'>Failed to Add Category .</div>";
                //redirect tomanage ctegory page
                header("location:".SITEURL.'admin/add_category.php');
            }
         }
        ?>


    </div>
</div>




<?php include('partials/footer.php')?>
