<?php  include('partials/menu.php') ?>

<div class="main-content">
    <div class ="wrapper">
        <h1>UPDATE ORDER</h1>
        <BR><BR>

        <?php   //check the id is set or not
        
        if(isset($_GET['id']))
        {
            //get the order details
            $id = $_GET['id'];

            //sql query to get order
            $sql = "SELECT* FROM tbl_order WHERE id = $id";

            //execute the query
            $res = mysqli_query($conn , $sql);
            //count rows

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //details available
                $row= mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                $status  = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];




            }
            else
            {
                //detil not available
                //redirect to the page
                header('location:'.SITEURL.'admin/manage_order.php');


            }

        }
        else{
            //redirecy to manage order page
            header('location:'.SITEURL.'admin/manage_order.php');
        }
        
        ?>





        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><?php echo $food;?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td> <input type="number" name="quantity" value="<?php echo "$price"; ?>"></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo "$quantity"; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option value="ordered">ordered</option>
                            <option value="on Delivery">on Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancel">Cancel</option>



                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type = "hidden" name="id" value ="<?php echo "$id"; ?>">
                        <input type = "hidden" name="price" value ="<?php echo "$price"; ?>">

                        <input type="submit" name="submit "value="update order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php  
        
        //check the button is clicked
        if(isset($_POST['submit']))
        {
            //echo "clicked";
            //get all values from form

            $id = $_POST['id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $total = $price * $quantity;

            $status = $_POST['status'];




            //update the values 
            $sql2 = "UPDATE tbl_order SET
            quantity = $quantity,
            total = $total,
            status = '$status'
            WHERE id =$id
            
            
            ";

            //execute the query
            $res2 = mysqli_query($conn , $sql2);


            //redirect to manage order 

            if($res2==true)
            {
                $_SESSION['update'] = "<div class='success'> Order Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-order');
            }
            else
            {
                $_SESSION['update'] = "<div class='error'> Order Updated Failed.</div>";
                header('location:'.SITEURL.'admin/manage-order');
            }
        }
        
        
        ?>
    </div>
</div>







<?php include('partials/footer.php') ?>