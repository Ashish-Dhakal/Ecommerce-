<?php include '../dashboard/admin-dash.php'; ?>

<?php
if (isset($_POST['process'])) {
    $transactionId = $_POST['process'];

    // Retrieve the relevant information based on the selected transaction ID
    $query = "SELECT
                c.c_fname,
                c.c_lname,
                GROUP_CONCAT(DISTINCT p.p_id ORDER BY p.p_id) AS product_ids,
                py.p_amount AS total_amount,
                py.transaction_id
            FROM
                customer c
                LEFT JOIN payment py ON c.c_id = py.c_id
                LEFT JOIN cart ca ON c.c_id = ca.c_id
                LEFT JOIN product p ON ca.p_id = p.p_id
            WHERE
                py.transaction_id = '$transactionId'";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    // Store the retrieved information in the ordered table or perform any other actions as required

    // Example: Storing the information in the ordered table
    $fname = $row['c_fname'];
    $lname = $row['c_lname'];
    $productIds = $row['product_ids'];
    $totalAmount = $row['total_amount'];
    $transactionId = $row['transaction_id'];

    // Perform the necessary database insert operation to store the information in the ordered table
    $insertQuery = "INSERT INTO ordered (product_ids, total_amount, transaction_id)
                    VALUES ('$productIds', '$totalAmount', '$transactionId')";
                  
    if ($conn->query($insertQuery)) {
        // Information stored successfully
        // Perform any additional actions or display a success message
    } else {
        // Error storing the information
        echo "Error: Failed to store the information in the ordered table.";
        die();
    }
}

if (isset($_POST['delete'])) {
    $transactionId = $_POST['delete'];

    // Perform the necessary database delete operation to remove the information from the payment table
    $deleteQuery = "DELETE FROM payment WHERE transaction_id = '$transactionId'";

    if ($conn->query($deleteQuery)) {
        // Information deleted successfully
        // Perform any additional actions or display a success message
    } else {
        // Error deleting the information
        echo "Error: Failed to delete the information from the payment table.";
        die();
    }
}

// Retrieve the updated list of transactions for display
$query = "SELECT
            c.c_fname,
            c.c_lname,
            GROUP_CONCAT(DISTINCT p.p_id ORDER BY p.p_id) AS product_ids,
            py.p_amount AS total_amount,
            py.transaction_id
        FROM
            customer c
            LEFT JOIN payment py ON c.c_id = py.c_id
            LEFT JOIN cart ca ON c.c_id = ca.c_id
            LEFT JOIN product p ON ca.p_id = p.p_id
        WHERE
            py.transaction_id IS NOT NULL
        GROUP BY
            c.c_id, py.transaction_id";

$result = $conn->query($query);
?>

<main class="main-container">
    <table class="table table-striped" style="text-align: center;">
        <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Product IDs</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Transaction ID</th>
                <th scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['c_fname']; ?></td>
                    <td><?php echo $row['c_lname']; ?></td>
                    <td><?php echo $row['product_ids']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <form action="" method="post">
                        <td>
                            <button type="submit" name="process" value="<?php echo $row['transaction_id']; ?>" class="btn btn-success">Process</button>
                        </td>
                        <td>
                            <button type="submit" name="delete" value="<?php echo $row['transaction_id']; ?>" class="btn btn-danger">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>