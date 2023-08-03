<?php include '../dashboard/user-dash.php'; ?>
<main class="main-container">
    <?php

    $c_id = $_SESSION['c_id'];
    // echo $c_id;
    ?>
    <h3>Purchased Item</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Invoice</th>

            </tr>
        </thead>
        <tbody>

            <?php

            $sql = "SELECT invoice_no FROM payment WHERE c_id = $c_id";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $invoice_no = $row["invoice_no"];


                    $sql2 = "SELECT product_ids , invoice_no FROM orders WHERE invoice_no = '$invoice_no'";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $product_ids_array = $row2["product_ids"];


                            $invoice_no = $row2['invoice_no'];

                            $product_ids_str = $row2['product_ids'];
                            $product_ids_array = array_map('intval', explode('-', $product_ids_str));


                            foreach ($product_ids_array as $productId) {
                                // Prepare the SQL query to retrieve the product name based on the product ID
                                $sql3 = "SELECT p_name,p_price,p_image FROM product WHERE p_id = $productId";

                                // Execute the query
                                $result3 = $conn->query($sql3);

                                //sql4 = "select"

                                if ($result3 && $result3->num_rows > 0) {
                                    // Fetch the product name from the result
                                    $row3 = $result3->fetch_assoc();
                                    $productName = $row3["p_name"];
                                    $price = $row3["p_price"];
                                    $p_image = $row3["p_image"];




                                    // Output the product name
                                    //         echo "Product ID: $productId, <br> Product Name: $productName <br> price : $price 
                                    // <br>
                                    // Invoice no :  $invoice_no <br>----------<br>
                                    // ";
            ?>


                                    <tr>
                                        <td> <?= $productName ?></td>
                                        <td><img src="../resources/image/uploads/<?php echo $row3["p_image"] ?>" alt="" style="height: 45px;"></td>
                                        <td> <?= $price ?></td>
                                        <td> <?= $invoice_no ?></td>




                                    </tr>









            <?php



                                } else {
                                    echo "Product ID: $productId, Product Name: Not found <br>";
                                }
                            }
                        }
                    }
                }
            } else {
                echo "No invoices found for the given c_id.";
            }






            ?>
        </tbody>
    </table>
</main>
</body>

</html>