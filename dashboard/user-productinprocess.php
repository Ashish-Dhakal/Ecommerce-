<?php include '../dashboard/user-dash.php'; ?>
<main class="main-container">
    <table class="table table-striped">
        <thead>

            <?php

            $query = "SELECT * FROM `ordered`";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();

            ?>
            <tr>
                <th scope="col">Product IDS</th>
                <th scope="col"> Total_amount</th>
                <th scope="col">Transaction ID</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['product_ids']; ?></td>
                <td><?php echo $row['total_amount']; ?></td>
                <td><?php echo $row['transaction_id']; ?></td>
                <form action="" method="post">
                    <td>
                        <button type="submit" name="rceived" value="<?php // echo $row['']; ?>" class="btn btn-success">Received</button>
                    </td>
                </form>
            </tr>




        </tbody>
    </table>
</main>