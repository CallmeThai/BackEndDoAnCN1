<?php
    include "DBConfig.php";    

    if(isset($_GET["idorder"])) {
        $idorder = $_GET["idorder"];
        $sql = "SELECT * FROM `order` WHERE idOrder = $idorder";
        $result = $conn->query($sql);

        $products = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = array(
                "status" => $row["status"],
                );
                array_push($products, $product);
            }
        }
        echo json_encode($products);
    } else {
        echo json_encode([]);
    }

    $conn->close();
?>