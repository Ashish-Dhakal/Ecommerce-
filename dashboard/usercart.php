<?php include '../dashboard/user-dash.php'; ?>
<main class="main-container">
    <?php
    $c_fname = $_SESSION['c_fname'];
    $c_lname = $_SESSION['c_lname'];
    $query = "SELECT c.c_id, ct.cart_id, p.p_name, p.p_price, ct.quantity, ct.total_price , p.p_image ,p.p_id 
              FROM customer AS c 
              JOIN cart AS ct ON c.c_id = ct.c_id 
              JOIN product AS p ON ct.p_id = p.p_id 
              WHERE c.c_fname = '$c_fname' AND c.c_lname = '$c_lname'";

    $result = $conn->query($query); // Execute the query and assign the result
    
    //echo $cartId;
    // $rowCount = $result->num_rows;
    // $_SESSION['rowCount'] = $rowCount;
    // echo  $_SESSION['rowCount'];

    if (isset($_POST['remove'])) {
        $cartId = intval($_POST['remove']);
        //echo $cartId;

        // Delete related payment rows first
        $deletePaymentQuery = "DELETE FROM cart WHERE cart_id = $cartId";
        if ($conn->query($deletePaymentQuery)) {
            // Proceed with deleting the cart row
            $deleteCartQuery = "DELETE FROM cart WHERE cart_id = $cartId";
            if ($conn->query($deleteCartQuery)) {
                header("Location: ./usercart.php");
                exit();
            } else {
                echo "Error deleting item from cart: " . $conn->error;
            }
        } else {
            echo "Error deleting payment for cart item: " . $conn->error;
        }
    }

    // Calculate the total price
    $totalPrice = 0;
    while ($row = $result->fetch_assoc()) {
        $totalPrice += $row['total_price'];
    }
    ?>

    <?php


    $product_ids = array();

    $query4 = "SELECT c_id FROM customer WHERE c_fname = '$c_fname' ";
    $result4 = $conn->query($query4);
    $row4 = $result4->fetch_assoc();
    $customer_id = $row4['c_id'];

    $query5 = "SELECT p_id , quantity FROM cart WHERE c_id = '$customer_id'";
    $result5 = $conn->query($query5);

    if ($result5->num_rows > 0) {
        while ($row5 = $result5->fetch_assoc()) {
            $product_ids[] = $row5['p_id'];
        }
    }

    $product_ids_string = implode('-', $product_ids);
    $_SESSION['product_ids_string'] = $product_ids_string;
    // $invoice_no =md5($product_ids_string . date("-Y-m-d")."-".time(), 0, 8);

    $invoice_no = substr(md5($product_ids_string . date("Y-m-d")."-".date("h:i:sa")), 0, 10);
    ?>
    <!-- item display in cart -->
    <h3>Manage Cart Item</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Remove Item</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $result->data_seek(0); // Reset the result set pointer
            while ($row = $result->fetch_assoc()) {
                // $invoice_no = $row['p_id'];
                //   echo $invoice_no . date("-Y-m-d ");
                //echo $customer_id;


            ?>
                <tr>
                    <th scope="row"><?php echo $row['p_name'] ?></th>
                    <td><img src="../resources/image/uploads/<?php echo $row["p_image"] ?>" alt="" style="height: 45px;"></td>
                    <td><?php echo $row['p_price'] ?></td>
                    <td><?php echo $row['quantity'] ?></td>
                    <td><?php echo $row['total_price'] ?></td>
                    <td>

                        <form method="post" action="./usercart.php">
                            <button type="submit" name="remove" value="<?php echo $row['cart_id'] ?>" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <th colspan="2"></th>
                <th>Total</th>
                <td></td>
                <th><?php echo $totalPrice;
                    $_SESSION['totalPrice'] =  $totalPrice; ?></th>
                <?php

                ?>

                <th style="color: red;" >
                    <?php
                    $query6 = " SELECT COUNT(*) FROM cart WHERE c_id = $customer_id";
                    $result6 = $conn->query($query6);
                    // show($result6);
                    // show($query6);
                   if (mysqli_num_rows($result) >= 1) 
                   {   ?>
                        <form method="post" action="./user-update.php" method="post">
                            <input type="hidden" value="<?php echo $invoice_no; ?>" name="invoice_no">
                            <input type="hidden" value="<?php echo $product_ids_string; ?>" name="product_ids">
                            <input type="hidden" value="<?php echo $totalPrice; ?>" name="total">
                            
                            <button type="submit" name="place_order" value="" class="btn btn-success">Place Order</button>
                        </form>
                    <?php }
                    else{
                       echo '<a href="../index.php">add product item<br> to place order</a>';
                   }

                    ?>

                </th>
            </tr>
        </tbody>
    </table>


</main>
</body>

</html>