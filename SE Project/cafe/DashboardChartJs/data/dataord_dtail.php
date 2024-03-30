<?php
    header('Content-Type: application/json');
    require '../../condb/database.php';

    $amountOfCus = mysqli_query($conn, "SELECT * FROM ordetail ");
    $cusdata = array();
    foreach($amountOfCus as $row2){
        $cusdata[] = $row2;
    }
    mysqli_close($conn);
    echo json_encode($cusdata);



?>