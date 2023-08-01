 <?php include '../dashboard/user-dash.php'; ?>
 <main class="main-container">

     <h3>Process to checkout</h3>

     <table class="table table-striped  ">
         <tr>
             <thead>

                 <th>Product Name</th>
                 <th>Product Price</th>
                 <th>Total Price</th>
         </tr>
         </thead>
         <tbody>
             <?php
                $invoice_no =  $_GET['invoice_no'];
               
                $query = "SELECT orders_id,product_ids,total,invoice_no, status FROM orders   WHERE invoice_no = '$invoice_no' ";
                // show($query);
                $result = $conn->query($query);
                // show($result);
                
                
                
                // $row = $result->fetch_assoc();
                // $total = $row['total'];
                // while (mysqli_num_rows($row) == 1) {
                //     show($row);


                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the first row as an associative array
                        $row = mysqli_fetch_assoc($result);
                        $total = $row['total'];
                ?>
                 <tr>

                     <th><?php echo $row['orders_id'] ?></th>
                     <td><?php echo $row['product_ids'] ?></td>
                     <td><?php echo $row['total'] ?></td>
                 </tr>
             <?php } ?>
             <tr>
                 <td></td>
                 <th>Total <br>
                 </th>
                 <td><?php // echo $row['total'];
                        // $_SESSION['totalPrice'] = $totalPrice; ?><br>
                     <!-- <button type="submit" name="checkout" value="<?php ?>" class="btn btn-success">Checkout</button> -->
                 </td>
             </tr>
             <tr>
                 <td></td>
                 <th>Pay vai </th>
                 <th>

                     <?php
                        if (mysqli_num_rows($result) >= 1) {
                        ?>
                         <!-- <form method="post" action="./user-checkout.php"> -->
                         <input type="hidden" name="c_fname" value=" <?php $_SESSION['c_fname']; ?>" placeholder="Enter transaction ID of payment">




                         <!-- esewa ko form -->
                         <form action="https://uat.esewa.com.np/epay/main" method="POST">
                             <input value="<?php echo $total; ?>" name="tAmt" type="hidden">
                             <input value="<?php echo $total; ?>" name="amt" type="hidden">
                             <input value="0" name="txAmt" type="hidden">
                             <input value="0" name="psc" type="hidden">
                             <input value="0" name="pdc" type="hidden">
                             <input value="EPAYTEST" name="scd" type="hidden">
                             <input value="<?= $invoice_no ?>" name="pid" type="hidden">
                             <input value="http://localhost/ecommerc/dashboard/esewa_payment_success.php?q=su" type="hidden" name="su">
                             <input value="http://localhost/ecommerc/dashboard/esewa_payment_failed.php?q=fu" type="hidden" name="fu">
                             <input class="checkout-button" type="image" src="../resources/image/esewa-logo.png" style=" height: 30px;">
                         </form>
                         <!-- esewa ko form close -->


                         <!-- </form> -->
                     <?php } else {
                            echo "Add product to cart to purchase the product";
                        }
                        ?>
                 </th>
             </tr>
         </tbody>

     </table>

 </main>
 </body>

 </html>