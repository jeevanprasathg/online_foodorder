<?php include('partials/menu.php');?>

 <!-- content starts-->
 <div class="main-content">
                <div class="wrapper">
                    <h1> Manage Category </h1><br>

                    <?php  
        if(isset($_SESSION['add']))
        {
            echo $_SESSION ['add'];
            unset($_SESSION ['add']) ;
        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION ['remove'];
            unset($_SESSION ['remove']) ;

        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION ['delete'];
            unset($_SESSION ['delete']) ;

        }

        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION ['no-category-found'];
            unset($_SESSION ['no-category-found']) ;

        }


        if(isset($_SESSION['update']))
        {
            echo $_SESSION ['update'];
            unset($_SESSION ['update']) ;

        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION ['upload'];
            unset($_SESSION ['upload']) ;

        }






        
        ?>
        <br><br>

                     <!-- button to add-->
                     <a href="<?php echo SITEURL;?>admin/add_category.php" class="btn-primary"> ADD CATEGORY</a><br><br><br>
                    <!---->

                    <table class="tbl-full">
                        <tr>
                            <th>s.no</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Feature</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>

                        <?php 
                        //query yo get all category
                        $sql = "SELECT *FROM tbl_category";

                        //execute the query
                        $res = mysqli_query($conn ,$sql);

                        //count rows
                        $count = mysqli_num_rows($res);

                        //create serial number
                        $sn=1;

                        //check wheather the data is in database are not
                        if($count>0)
                        {
                            //have data in data dase
                            //get data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['feature'];
                                $active = $row['active'];
                                ?>
                                 <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>


                            <td>
                                <?php
                                //check image is available are not
                                if($image_name != "")
                                {
                                    //display the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php  echo $image_name;?>" width="100px">
                                    <?php
                                }
                                else
                                {
                                    //display the msg
                                    echo"<div class='error'>Image not Added.</div>";

                                }
                                ?>


                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td><a href="<?php  echo SITEURL;?>admin/update_category.php?id=<?php echo$id;?>" class="btn-secondary">update category</a>
                                <a href="<?php  echo SITEURL;?>admin/delete_category.php?id=<?php echo$id;?>&image_name=<?php  echo $image_name;?>" class="btn-end">delete category</a>
                            </td>
                        </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //do not have data
                            //display the data inside thr table
                            ?>
                            <tr>
                                <td colspan="6"><div class="error ">No Category Added</div></td>
                            </tr>
                            <?php
                        }
                        ?>
                       
                        
                    </table>

                    
                </div>
            </div>
            <!-- content ends-->





<?php include('partials/footer.php');?>