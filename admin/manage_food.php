<?php include('partials/menu.php');?>

 <!-- content starts-->
 <div class="main-content">
                <div class="wrapper">
                    <h1> Manage Food </h1><br><br>

                    <?php
                     if(isset($_SESSION['add']))
                     {
                         echo $_SESSION ['add'];
                         unset($_SESSION ['add']) ;
                     }
                     
                     if(isset($_SESSION['delete']))
                     {
                         echo $_SESSION ['delete'];
                         unset($_SESSION ['delete']) ;
                     }

                     if(isset($_SESSION['upload']))
                     {
                         echo $_SESSION ['upload'];
                         unset($_SESSION ['upload']) ;
                     }

                     if(isset($_SESSION['unauthorize']))
                     {
                         echo $_SESSION ['unauthorize'];
                         unset($_SESSION ['unauthorize']) ;
                     }


                     if(isset($_SESSION['update']))
                     {
                         echo $_SESSION ['update'];
                         unset($_SESSION ['update']) ;
                     }

                     
                     
                     
                    ?>

                    <br><br>

                     <!-- button to add-->
                     <a href="<?php echo SITEURL; ?>admin/add_food.php" class="btn-primary"> ADD FOOD</a><br><br><br>
                    <!---->


                    <table class="tbl-full">
                        <tr>
                            <th>s.no</th>
                            <th>Title</th>
                            <th>price</th>
                            <th>image</th>
                            <th>Feature</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        <?php  
                            //query yo get all category
                             $sql = "SELECT *FROM tbl_food";

                             //execute the query
                             $res = mysqli_query($conn , $sql);

                            //count rows
                            $count = mysqli_num_rows($res);

                            ///serial number
                            $sn=1;

                            if($count>0)
                            {
                                ///WE have food in database
                                //get the foods from database
                                while($row=mysqli_fetch_assoc($res))
                                {
                                //get values from individual columns
                                $id = $row['id'];
                                $title =$row['title'];
                                $price =$row['price'];
                                $image_name = $row['image_name'];
                                $feature =$row ['feature'];
                                $active = $row['active'];
                                ?>
                                <tr>
                            <td><?php echo$sn++;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $price;?></td>
                            

                            <td>
                                <?php
                                //check image is available are not
                                if($image_name != "")
                                {
                                    //display the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php  echo $image_name;?>" width="100px">
                                    <?php
                                }
                                else
                                {
                                    //display the msg
                                    echo"<div class='error'>Image not Added.</div>";

                                }
                                ?>

                               
                        
                            <td><?php  echo $feature;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                            <a href="<?php  echo SITEURL;?>admin/update_food.php?id=<?php echo$id;?>" class="btn-secondary">update Food</a>
                                <a href="<?php  echo SITEURL;?>admin/delete_food.php?id=<?php echo$id;?>&image_name=<?php  echo $image_name;?>" class="btn-end">delete Food</a>
                            

                            </td>
                        </tr>





                                <?php
                            }
                        }
                            else
                            {
                                echo"<tr><tdcolspan='7' class='error'>Food not Added Yet.</td></tr>";

                            }

                        ?>
                                               
                        
                    </table>                
                    
                </div>
            </div>
            <!-- content ends-->




<?php include('partials/footer.php');?>