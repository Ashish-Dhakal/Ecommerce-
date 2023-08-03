<?php include '../dashboard/admin-dash.php'; ?>

<main class="main-container">
    <h3>Ordered Item</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Invoice No</th>
                <th>Product_ids</th>
                <th>Total</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM orders"; 

                // Execute the query
                $result = $conn->query($query);

                // Check if there are any results
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        
            ?>
                <tr>
                    <td><?php echo $row['invoice_no'];?></td>
                    <td><?php echo $row['product_ids'];?></td>
                    <td><?php echo $row['total'];?></td>
                    <td><?php echo $row['status'];?></td>
                </tr>
            <?php
            }}
            ?>

        </tbody>
</main>