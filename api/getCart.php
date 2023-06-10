<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data["idUser"])) {
        $idUser =(int) $data["idUser"]; 

        $sql = "SELECT * FROM cart WHERE idUser  = $idUser";
        $result = $conn->query($sql);

        $itemCart = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idProduct = $row["idProduct"];

                $sqlSelectItemCart = "SELECT * FROM product WHERE idProduct =  $idProduct";
                $querySelectItemCart = $conn->query($sqlSelectItemCart);

                while ($rowSelectItemCart = $querySelectItemCart->fetch_assoc()) {
                    $product = array(
                        "idCart" => $row["idCart"],
                        "idProduct" => $rowSelectItemCart["idProduct"],
                        "nameProduct" => $rowSelectItemCart["nameProduct"],
                        "priceProduct" => (int)($rowSelectItemCart["priceProduct"]),
                        "price" => (int)($rowSelectItemCart["priceProduct"]) * (int)$row["quantityProductCart"],
                        "imageProduct_1" => $rowSelectItemCart["imageProduct_1"],
                        "size" => (int)$row["size"],
                        "quantityProductCart" => (int)$row["quantityProductCart"],
                        );
                        array_push($itemCart, $product);
                }
            }
        }
        echo json_encode($itemCart);
    } else {
        echo "Khong";
    }

    
    $conn->close();

?>