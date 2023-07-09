<?php

    include "DBConfig.php";
  
     $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data["idUser"]) && isset($data["idProduct"])  && isset($data["sizeProduct"])){

        $idUser =(int) $data["idUser"]; 
        $idProduct = (int) $data["idProduct"];
        $sizeProduct = (int) $data["sizeProduct"];
    
        $sqlSelect = "SELECT * FROM cart WHERE idUser = '$idUser' AND idProduct = '$idProduct' AND sizeProduct = '$sizeProduct'";
        $result = $conn->query($sqlSelect);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quantityProductCart = $row['quantityProductCart'];
            }
            $sqlUpdate = "UPDATE cart SET quantityProductCart = '$quantityProductCart' + 1 WHERE idUser = '$idUser' AND idProduct = '$idProduct' AND sizeProduct = '$sizeProduct'";
            $conn->query($sqlUpdate);
            echo json_encode("update thanh cong");  

            // $sqlSelectQuantitysizeProduct = "SELECT * FROM product WHERE idProduct = '$idProduct'";
            // $resultSelectQuantitysizeProduct = $conn->query($sqlSelectQuantitysizeProduct);
            // if ($resultSelectQuantitysizeProduct->num_rows > 0) {
            //     while ($row = $resultSelectQuantitysizeProduct->fetch_assoc()) {
                    
            //     }
            // }
            // echo $sqlSelectQuantitysizeProduct;
            // $sqlUpdateQuantitysizeProduct = "UPDATE product SET `sizeProduct$sizeProduct` = `sizeProduct$sizeProduct` - 1 WHERE idProduct = '$idProduct' AND sizeProduct = '$sizeProduct'";
            // echo $sqlUpdateQuantitysizeProduct;
        } 
        else {
            $sql = "INSERT INTO cart (`idUser`, `idProduct`, `sizeProduct`  ) VALUES ($idUser, $idProduct, $sizeProduct )";
            $conn->query($sql);
            echo json_encode("them thanh cong");  
        }
    }else{
      echo json_encode("thieu du lieu");
    }

    $conn->close();
?>