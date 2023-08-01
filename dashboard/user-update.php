 <?php include '../dashboard/user-dash.php'; ?>


 <?php

    if (isset($_POST['place_order'])) {
        $invoice_no = mysqli_real_escape_string($conn, $_POST['invoice_no']);
        $product_ids = mysqli_real_escape_string($conn, $_POST['product_ids']);
        $total = mysqli_real_escape_string($conn, $_POST['total']);
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO orders ( invoice_no , product_ids,total , status ,created_at ) 
                  VALUES ('$invoice_no', '$product_ids' ,'$total', 0 , '$created_at' )";

        if (mysqli_query($conn, $query)) {
            header("Location:./checkout.php?invoice_no=$invoice_no");
        } else {
            $em = "error on placeing order";
            header("Location:./usercart.php?error=$em");
        }
    }


    ?>