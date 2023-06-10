<?php

    include 'DBConfig.php';

    if(isset($_GET["idorder"])) {
        $idorder = $_GET["idorder"];
        $sql = "SELECT * FROM detailOrder WHERE idOrder = $idorder";
        $result = $conn->query($sql);

        $detailOrders = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $detailOrder = array(
                "idProduct" => $row["idProduct"],
                "size" => $row["size"],
                "quantityProduct" => $row["quantityProduct"],
                );
                array_push($detailOrders, $detailOrder);
            }
        }

        $idPro = $detailOrders[0]["idProduct"];
        $size = $detailOrders[0]["size"];
        $quantityProduct = $detailOrders[0]["quantityProduct"];
        
        $sqlSelectProductOrder = "SELECT * FROM product WHERE idProduct = $idPro";
        $resultSelectProductOrder = $conn->query($sqlSelectProductOrder);

        $productDetailOrders = array();
        if ($resultSelectProductOrder->num_rows > 0) {
            while ($row = $resultSelectProductOrder->fetch_assoc()) {
                $productDetailOrder = array(
                // "idProduct" => $row["idProduct"],
                "nameProduct" => $row["nameProduct"],
                "priceProduct" => $row["priceProduct"],
                "imageProduct_1" => $row["imageProduct_1"],
                );
                array_push($productDetailOrders, $productDetailOrder);
            }
        }
        $responseData = array_merge($productDetailOrders, $detailOrders);
        echo json_encode($responseData);
    } else {
        echo json_encode([]);
    }
    $conn->close();
    
?>