<?php
    header('Content-Type: application/json');
    require '../../condb/database.php';

   
    $ord_totalPerMonth = mysqli_query($conn, "SELECT * FROM order_main WHERE ord_orderDate ");
    
    $data = array();
    foreach($ord_totalPerMonth as $row1){
        $data[] = $row1;
    }
    mysqli_close($conn);
    echo json_encode($data);

   



?>
