<?php
    include "DBConfig.php";

    $sqlSelectOrders = "SELECT * FROM `order`";
    $resultSelectOrders = $conn->query($sqlSelectOrders);

    $orders = array();

    if ($resultSelectOrders->num_rows > 0) {
        while ($row = $resultSelectOrders->fetch_assoc()) {
            $order = array(
            "idOrder" => $row["idOrder"],
            "fullname" => $row["fullname"],
            "dateOrder" => $row["dateOrder"],
            "status" => $row["status"],
            );
            array_push($orders, $order);
        }
    }

    echo json_encode($orders);

    $conn->close();

?>