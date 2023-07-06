<?php include('partials/menu.php');?>
 <!-- content starts-->
 <div class="main-content">
                <div class="wrapper">
                    <h1> Manage Order </h1><br><br>


                    <?php  
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    
                    
                    ?>
                    <br>

                     <!-- button to add-->
                    <!-- <a href="<?php echo SITEURL;?>admin/update_order.php" class="btn-primary"> ADD order</a>
                     <a href="#" class="btn-primary"> ADD ORDERS</a><br><br>-->
                    <!---->

                    <table class="tbl-full">
                        <tr>
                            <th>S No</th>
                            <th>Food</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Customer Name</th>
                            <th> Contact</th>
                            <th>E-mail</th>
                            <th>Address</th>
                          <!--  <th>Action</th>-->
                        </tr>
                        <?php

                        //get all the order from database
                        $sql = "SELECT *FROM tbl_order ORDER BY id DESC";//DIPALY THE ORDER FIRST

                        //Execute the query
                        $res = mysqli_query($conn , $sql);
                        //count the ros
                        $count = mysqli_num_rows($res);


                        $sn = 1;  //create serial number

                        if($count>0)
                        {
                            //order availablr
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //get order detail
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                $total  = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                //$action = $row['action'];


                                ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td> <?php echo $price; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><a href="<?php  echo SITEURL;?>admin/update_order.php?id=<?php echo$id;?>" class="btn-secondary">update order</a>
                            
                           <!-- <td><a href="#" class="btn-secondary">update admin</a>-->
                            </td>
                        </tr>

                                <?php


                            }
                        }
                        else
                        {
                            //order notavailable
                            echo"<tr><td colspan='12'class='error'>Orders Not Available</td></tr>";
                        }

                        ?>




                        
                        
                    </table>

                    
                </div>
            </div>
            <!-- content ends-->





<?php include('partials/footer.php');?>

