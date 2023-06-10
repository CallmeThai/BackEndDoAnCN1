<?php
    include "DBConfig.php";

    $sqlSelectOrders = "SELECT * FROM `order`";
    $resultSelectOrders = $conn->query($sqlSelectOrders);

    $orders = array();

    if ($resultSelectOrders->num_rows > 0) {
        while ($row = $resultSelectOrders->fetch_assoc()) {
            $order = array(
            "idOrder" => $row["idOrder"],
            "idUser" => $row["idUser"],
            "dateOrder" => $row["dateOrder"],
            "fullname" => $row["fullname"],
            "address" => $row["address"],
            "phone" => $row["phone"],
            "email" => $row["email"],
            "payment" => $row["payment"],
            "status" => $row["status"],
            "totalPrice" => $row["totalPrice"],
            );
            array_push($orders, $order);
        }
    }

    echo json_encode($orders);

    $conn->close();

?>