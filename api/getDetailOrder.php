<?php

    include 'DBConfig.php';

    if(isset($_GET["idorder"])) {
        $idorder = $_GET["idorder"];
        $sql = "SELECT * FROM detailOrder WHERE idOrder = $idorder";
        $result = $conn->query($sql);

        $detailOrders = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idProduct = $row["idProduct"];
                $sqlSelectProductOrder = "SELECT * FROM product WHERE idProduct = $idProduct";
                $resultSelectProductOrder = $conn->query($sqlSelectProductOrder);

                // $sqlSelectStatus = "SELECT * FROM order WHERE idOrder = $idorder";
                // $resultSelectStatus = $conn->query($sqlSelectProductOrder);
                
                if ($resultSelectProductOrder->num_rows > 0) {
                    while ($rowProduct = $resultSelectProductOrder->fetch_assoc()) {
                        $productDetailOrder = array(
                        "idProduct" => $row["idProduct"],
                        "size" => $row["size"],
                        "quantityProduct" => $row["quantityProduct"],  "idProduct" => $row["idProduct"],
                        "size" => $row["size"],
                        "quantityProduct" => $row["quantityProduct"],
                        "nameProduct" => $rowProduct["nameProduct"],
                        "priceProduct" => $rowProduct["priceProduct"],
                        "imageProduct_1" => $rowProduct["imageProduct_1"],
                        );
                        array_push($detailOrders, $productDetailOrder);
                    }
                }
            }
        }

       
        echo json_encode($detailOrders);
    } else {
        echo json_encode([]);
    }
    $conn->close();
    
?>