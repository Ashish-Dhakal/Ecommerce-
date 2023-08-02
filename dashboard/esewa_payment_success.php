<?php  include '../dashboard/user-dash.php'; ?>

<?php
if((isset($_GET['oid'])) && (isset($_GET['amt']))&& (isset($_GET['refId']))   ){
    $invoice_no =  $_GET['oid'];
    $refId = $_GET['refId'];
    $amt = $_GET['amt'];
    

    $query = "SELECT orders_id,product_ids,total,invoice_no, status FROM orders   WHERE invoice_no = '$invoice_no' ";
    // show($query);
    // show($query);
    //show($refId);
    $result = $conn->query($query);
    
    
    if (mysqli_num_rows($result) == 1 ) {
        show("aayuo");
        $query1 = "UPDATE orders SET status=1 WHERE invoice_no = '$invoice_no' ";
        $result1 = $conn->query($query1);


        if($result1){
            $_SESSION['refId'] = $refId;
            $_SESSION['amt'] = $amt;
            $_SESSION['invoice_no'] = $invoice_no;
            header('Location:./purchased-item.php');
            die();
        }
        else{
                echo 'faiul';
        }
        
    }
}

// if ((isset($_REQUEST['oid'])) && (isset($_REQUEST['amt']))  && (isset($_REQUEST['refId']))) {

//      $query = "SELECT * FROM orders where invoice_no = '" . $_REQUEST['oid'] . "' ";
//      $result = mysqli_query($conn, $query);
//     if ($result) {
       
//          if (mysqli_num_rows($result) == 1) {
            
//             $order = mysqli_fetch_assoc($result);
//             $url = "https://uat.esewa.com.np/epay/transrec";

//             $data = [
//                 'amt' => $orders['total'],
//                 'rid' => $_REQUEST['refId'],
//                 'pid' => $orders['invoice_no'],
//                 'scd' => 'EPAYTEST',
//             ];
//             $curl = curl_init($url);
//             curl_setopt($curl, CURLOPT_POST, true);
//             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//             curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//             $response = curl_exec($curl);
//             $response_code = get_xml_node_value('response_code', $response);
//             if( trim($response_code) =='Sucecess'){
//                 $query1="UPDATE orders SET status=1 WHERE id='" .$order['id']. "' ";
//                 mysqli_query($conn, $query1);
//                header('Location:./usercart.php');
                
//             }
//         }
//      }
//  }

// function get_xml_node_value($node , $xml)
// {
//     if($xml == false){
//         return false;
//     }

//     $found = preg_match ( '#<' .$node. '?:\s+[^>]+)?.>(.*?)'.
//                 '</' .$node. '>#s' , $xml ,$matches);
//         if($found != false){
//         return $matches[1];
//     }
//     return false;
// }
?>


 <!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form action="https://uat.esewa.com.np/epay/transrec" method="GET">
    <input value="100" name="amt" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input value="ee2c3ca1-696b-4cc5-a6be-2c40d929d453" name="pid" type="hidden">
    <input value="000AE01" name="rid" type="hidden">
    <input value="Submit" type="submit">
    </form> 
</body>
</html>  -->