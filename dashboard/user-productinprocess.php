<?php include '../dashboard/user-dash.php'; ?>
<main class="main-container">
    <table class="table table-striped">
        <thead>

            <?php

            $query = "SELECT * FROM `ordered`";
            $result = $conn->query($query);
            ?>

            <tr>
                <th scope="col">Product IDS</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Transaction ID</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['product_ids']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <form action="" method="post">
                        <td>
                            <input type="hidden" name="sales_amount" value="<?php echo $row['total_amount']; ?>">
                            <input type="hidden" name="transaction_id" value="<?php echo $row['transaction_id']; ?>">
                            <button type="submit" name="received" value="<?php echo $row['transaction_id']; ?>" class="btn btn-success">Received</button>
                        </td>
                    </form>
                </tr>
            <?php } ?>

            <?php
            if (isset($_POST['received'])) {
                $salesAmount = $_POST['sales_amount'];
                $transactionId = $_POST['transaction_id'];
                $date = date('Y-m-d H:i:s');

                // Insert the data into the 'sales' table
                $insertQuery = "INSERT INTO sales (transaction_id, sales_amount, date)
                                VALUES ('$transactionId', '$salesAmount', '$date')";

                if ($conn->query($insertQuery)) {
                    // Data inserted successfully
                    // Perform any additional actions or display a success message
                } else {
                    // Error inserting the data
                    echo "Error: Failed to insert the data into the sales table.";
                    die();
                }
            }
            ?>
        </tbody>
    </table>
</main>