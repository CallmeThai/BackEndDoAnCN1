<?php

    include 'DBConfig.php';

    if(isset($_GET["idorder"])) {
        $idorder = $_GET["idorder"];
        $sql = "SELECT * FROM `order` WHERE idOrder = $idorder";

        $result = $conn->query($sql);

        $orders = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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
    } else {
        echo json_encode([]);
    }
    $conn->close();
    
?>