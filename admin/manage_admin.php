<?php include('partials/menu.php');?>

            <!-- content starts-->
            <div class="main-content">
                <div class="wrapper">
                    <h1> Manage Admin</h1><br><br>
                    <!------------------------->
                    <?php  
                        if(isset($_SESSION['add'])){
                            echo $_SESSION['add'];//displaying session
                            unset($_SESSION['add']);//removing sesion after reloaded
                        }
                        if(isset($_SESSION['delete']))
                        {
                            echo$_SESSION['delete'];
                            unset($_SESSION['delete']);
                            
                        }

                        if(isset($_SESSION['user-not-found']))
                        {
                            echo$_SESSION['user-not-found'];
                            unset($_SESSION['user-not-found']);
                            
                        }
                        if(isset($_SESSION['pwd-not-match']))
                        {
                            echo$_SESSION['pwd-not-match'];
                            unset($_SESSION['pwd-not-match']);
                        }
                        if(isset($_SESSION['pwd-match']))
                        {
                            echo$_SESSION['pwd-match'];
                            unset($_SESSION['pwd-match']);
                        }

                       
                    ?>
                   <!----------------------------->
                    <br><br><br>

                    <!-- button to add-->
                    <a href="add_admin.php" class="btn-primary"> ADD ADMIN</a><br><br><br>
                    <!---->

                    <table class="tbl-full">
                        <tr>
                            <th>id</th>
                            <th>full_name</th>
                            <th>Actions</th>
                        </tr>
                            <?php
                            //qwery to get all admins
                            $sql ="SELECT * FROM tbl_admin";
                            //execute the qwery
                            $res = mysqli_query($conn, $sql);

                            //create whether we have data in database are not
                            if($res==TRUE)
                            {
                                //COUNT ROWS data to database are not
                                $count= mysqli_num_rows($res);

                                $sn=1;//

                                //check the num rows
                                if($count>0)
                                {
                                    //data in database
                                    while($rows=mysqli_fetch_assoc($res))
                                    {
                                        $id=$rows['id'];
                                        $full_name=$rows['full_name'];


                                        //display the value inour table
                                        ?>
                                        <tr>
                                            <td><?php  echo $sn++; ?></td>
                                            <td><?php  echo $full_name; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/password.php?id=<?php echo $id;  ?>" class="btn-secondary">Change Password</a>
                                                <!-- <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id;  ?>" class="btn-secondary">update admin</a> -->
                                                <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id;  ?>" class="btn-end">delete admin</a>
                                            </td> 
                                    </tr>   

                                        <?php
                                    }
                                }

                                else
                                {

                                }
                            }

                            ?>



                        
                    </table>

                    
                </div>
            </div>
            <!-- content ends-->

          <?php include('partials/footer.php');?>

         