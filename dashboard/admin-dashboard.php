<?php include '../dashboard/admin-dash.php'; ?>
<!-----------------start of main section------------------>
<main class="main-container">
    <div class="main-title">
        Dashboard
    </div>
    <div class="main-cards">


        <div class="card">
            <div class="card-inner">
                <div class="card-heading">
                    Total Product
                </div>

                <i class="fa-solid fa-warehouse" style="color: #ffffff;"></i>
            </div>
            <?php
            $query = 'SELECT COUNT(*) AS total_products FROM product';
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalProducts = $row['total_products'];
            } else {
                $totalProducts = "No products found.";
            }
            ?>
            <div class="card-number">


                <?php echo $totalProducts; ?></div>

        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-heading">
                    Total User
                </div>
                <i class="fa-regular fa-user"></i>
            </div>
            <?php
            $query1 = 'SELECT COUNT(*) AS total_user FROM customer';
            $result = $conn->query($query1);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalUser = $row['total_user'];
            } else {
                $totalUser = "No products found.";
            }
            ?>
            <div class="card-number">
                <?php echo $totalUser; ?>
            </div>

        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-heading">
                    Ordered Product
                </div>
                <i class="fa-thin fa-bags-shopping"></i>
            </div>
            <?php
            $query2 = 'SELECT COUNT(*) AS totalOrdered FROM payment';
            $result2 = $conn->query($query2);

            if ($result2 && $result2->num_rows > 0) {
                $row2 = $result2->fetch_assoc();
                $totalOrdered = $row2['totalOrdered'];
            } else {
                $totalOrdered = "No products found.";
            }
            ?>
            <div class="card-number">
                <?php echo $totalOrdered; ?>
            </div>

        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-heading">
                    Checkout Item
                </div>
                <i class="fa-sharp fa-solid fa-arrow-progress"></i>
            </div>
            <?php
            $query3 = 'SELECT COUNT(DISTINCT transaction_id) AS total_transactions FROM payment';
            $result3 = $conn->query($query3);

            if ($result3 && $result3->num_rows > 0) {
                $row3 = $result3->fetch_assoc();
                $totalTransactions = $row3['total_transactions'];
            } else {
                $totalTransactions = 0;
            }
            ?>
            <div class="card-number">
                <?php echo $totalTransactions; ?>
            </div>
        </div>


        <div class="card">
            <div class="card-inner">
                <div class="card-heading">
                    Total sales
                </div>
                <i class="fa-sharp fa-solid fa-dollar-sign"></i>
            </div>
            <div class="card-number">22</div>

        </div>


    </div>
</main>
<!--------- end of main section------- -->

</div>

</body>

</html>