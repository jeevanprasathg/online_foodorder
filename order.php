<?php include('partials_front/menu.php'); ?>

<?php  
 //check food id is available are not
 if(isset($_GET['food_id']))
 {
     //get food id details of the selected food
     $food_id = $_GET['food_id'];

     //get details of selectes food
     $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

     //execute the query
     $res = mysqli_query($conn , $sql);
     //count the rows
     $count = mysqli_num_rows($res);

     //check the data is availablr are not
     if($count==1)
     {
         //get data from database
         $row = mysqli_fetch_assoc($res);

         $title = $row['title'];
         $price = $row['price'];
         $image_name = $row['image_name'];

     }
     else{
         //fooog not available 
         //redirect to header
         header('location:'.SITEURL);
     }
 }
 else
 {
     //redirect to homepage
     header('location:'.SITEURL);
 }


?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        //check the images is available are not
                        if($image_name=="")
                        {
                            //image is availablr
                            echo"<div class='error'>Image Not Available.</div>";
                        }
                        else
                        {
                            //imagr available
                            ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php  echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                            <?php
                        }
                        
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php  echo $title;?>">
                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php  echo $price;?>">


                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your full-name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter your Phone-number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter E-mail Id" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter Live address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php  

            //check submit button is clicked are not
            if(isset($_POST['submit']))
            {
                $food = $_POST['food'];
                $price = $_POST['price'];

                $quantity = $_POST['quantity'];
                $total = $price * $quantity;  //totall = price * qty

                $order_date = date("y-m-d h:i:sa"); //date

                $status = "ordered";

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];


                //save the order in database

                //create query
                $sql2 = "INSERT INTO tbl_order SET
                food = '$food',
                price = $price,
                quantity = $quantity,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'                
                ";
               // echo $sql2; die();

                //execute te query

                $res2 = mysqli_query($conn ,$sql2);
                //to check query executed

                if($res2==true)
                {
                    //query executed and order saved
                    $_SESSION['order'] = "<div class = 'success'>Food Order Successfully.</div>";
                    header('location:'.SITEURL);
                }
                else
                {
                    //failed
                    $_SESSION['order'] = "<div class = 'error'> Failed To Order Food.</div>";
                    header('location:'.SITEURL);
                }




            }

            
            
            
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    

    <?php include('partials_front/footer.php'); ?>