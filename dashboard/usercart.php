<?php include '../dashboard/user-dash.php'; ?>
<main class="main-container">
    <?php
    $c_fname = $_SESSION['c_fname'];
    $c_lname = $_SESSION['c_lname'];
    $query = "SELECT c.c_id, ct.cart_id, p.p_name, p.p_price, ct.quantity, ct.total_price , p.p_image 
              FROM customer AS c 
              JOIN cart AS ct ON c.c_id = ct.c_id 
              JOIN product AS p ON ct.p_id = p.p_id 
              WHERE c.c_fname = '$c_fname' AND c.c_lname = '$c_lname'";



    $result = $conn->query($query); // Execute the query and assign the result

    $rowCount = $result->num_rows;
    $_SESSION['rowCount'] = $rowCount;

    // if (isset($_POST['remove'])) {
    //     $customerId = intval($_POST['remove']);

    //     // Prepare and execute the delete query
    //     $removeQuery = "DELETE FROM cart WHERE cart_id = $customerId";
    //     if ($conn->query($removeQuery)) {
    //         header("Location: ./usercart.php");
    //         exit();
    //     } else {
    //         echo "Error deleting item from cart: " . $conn->error;
    //     }
    // }




    if (isset($_POST['remove'])) {
        $cartId = intval($_POST['remove']);

        // Delete related payment rows first
        $deletePaymentQuery = "DELETE FROM payment WHERE cart_id = $cartId";
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
                <th colspan="4" style="text-align: center;">Total</th>
                <td><?php echo $totalPrice;

                    $_SESSION['totalPrice'] =  $totalPrice; ?></td>
                <td> </td>
            </tr>
        </tbody>
    </table>
    <br> <br>

    <h3>Process to checkout</h3>
    <div class="image">
        <img src="../resources/image/qr-img.jpg" alt="" style="height: 150px;">
    </div>
    <h4>Scan me for payment <span style="color: red;">*<span style="font-size: 15px;">(remember the transaction ID to enter below )</span></span></h4>

    <br>

    <table class="table table-striped">
        <tr>
            <thead>

                <th>Product Name</th>
                <th>Product Price</th>
                <th>Total Price</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $result->data_seek(0); // Reset the result set pointer
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <th scope="row"><?php echo $row['p_name'] ?></th>
                    <td><?php echo $row['p_price'] ?></td>
                    <td><?php echo $row['total_price'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th colspan="2" style="text-align: center;">Total <br>
                    <form method="post" action="./checkout.php">
                        <input type="text" name="transaction_id" placeholder="Enter transaction ID of payment" style=" width:260px; " required>
                        <?php $_SESSION['c_fname'];
                        $_SESSION['c_lname']; ?>
                        <button type="submit" name="checkout" value="<?php ?>" class="btn btn-success" style="margin-left: 500px;">Checkout</button>

                    </form>

                </th>
                <td><?php echo $totalPrice;
                    $_SESSION['totalPrice'] = $totalPrice; ?><br>
                    <!-- <button type="submit" name="checkout" value="<?php ?>" class="btn btn-success">Checkout</button> -->


                </td>
            </tr>
        </tbody>

    </table>



</main>
</body>

</html>