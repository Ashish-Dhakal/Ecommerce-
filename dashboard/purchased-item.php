<?php include '../dashboard/user-dash.php'; ?>
<main class="main-container">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        // Start the session if it's not already active
       // session_start();
    }

    if (
        isset($_SESSION['refId']) && $_SESSION['refId'] !== null &&
        isset($_SESSION['invoice_no']) && $_SESSION['invoice_no'] !== null &&
        isset($_SESSION['amt']) && $_SESSION['amt'] !== null
    ) {
        echo $_SESSION['refId'] . '<br>';
        echo  $_SESSION['invoice_no'] . '<br>';
        echo $_SESSION['amt'] . '<br>';
        $invoice_no =  $_SESSION['invoice_no'];
        $refId = $_SESSION['refId'];
        $amt = $_SESSION['amt'];
    } else {
        echo 'akjsdhnkjsh';
    }

    ?>

    <?php 
    echo $invoice_no;
    ?>
</main>