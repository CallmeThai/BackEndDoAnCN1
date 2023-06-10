<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data["idUser"]) && $data["idProduct"]  && $data["size"]){
        $idUser =(int) $data["idUser"]; 
        $idProduct = (int) $data["idProduct"];
        $size = (int) $data["size"];
    
        $sqlSelect = "SELECT * FROM cart WHERE idUser = '$idUser' AND idProduct = '$idProduct' AND size = '$size'";
        $result = $conn->query($sqlSelect);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quantityProductCart = $row['quantityProductCart'];
            }
            $sqlUpdate = "UPDATE cart SET quantityProductCart = '$quantityProductCart' + 1 WHERE idUser = '$idUser' AND idProduct = '$idProduct' AND size = '$size'";
            $conn->query($sqlUpdate);
            echo "update thanh cong";  

            // $sqlSelectQuantitySize = "SELECT * FROM product WHERE idProduct = '$idProduct'";
            // $resultSelectQuantitySize = $conn->query($sqlSelectQuantitySize);
            // if ($resultSelectQuantitySize->num_rows > 0) {
            //     while ($row = $resultSelectQuantitySize->fetch_assoc()) {
                    
            //     }
            // }
            // echo $sqlSelectQuantitySize;
            // $sqlUpdateQuantitySize = "UPDATE product SET `size$size` = `size$size` - 1 WHERE idProduct = '$idProduct' AND size = '$size'";
            // echo $sqlUpdateQuantitySize;
        } 
        else {
            $sql = "INSERT INTO cart (`idUser`, `idProduct`, `size` , `quantityProductCart`) VALUES ($idUser, $idProduct, $size , 1)";
            $conn->query($sql);
            echo "them thanh cong";  
        }
    }

    $conn->close();
?>