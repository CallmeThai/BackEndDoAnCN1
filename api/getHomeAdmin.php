<?php

    include "DBConfig.php";

    $countProducts;
    $countOrders;
    $countUsers;

    $sqlSelectProducts = "SELECT COUNT(*) AS countProducts  FROM product";
    $resultSelectProducts = $conn->query($sqlSelectProducts);
    while ($row = $resultSelectProducts->fetch_assoc()) {
        $countProducts = $row['countProducts'];
    }

    $sqlSelectUsers = "SELECT COUNT(*) AS countUsers  FROM user";
    $resultSelectUsers = $conn->query($sqlSelectUsers);
    while ($row = $resultSelectUsers->fetch_assoc()) {
        $countUsers = $row['countUsers'];
    }

    $sqlSelectOrder = "SELECT COUNT(*) AS countOrders  FROM `order`";
    $resultSelectOrder = $conn->query($sqlSelectOrder);
    while ($row = $resultSelectOrder->fetch_assoc()) {
        $countOrders = $row['countOrders'];
    }

    echo json_encode(array(
        "countProducts" => $countProducts,
        "countUsers" => $countUsers,
        "countOrders" => $countOrders,
    ));
    
    
    $conn->close();
?>