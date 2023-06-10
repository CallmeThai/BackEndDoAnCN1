<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    $idUser =(int) $data["idUser"]; 
    $products = $data["products"]; 
    $fullname = $data["fullname"]; 
    $address = $data["address"]; 
    $phone = $data["phone"]; 
    $email = $data["email"]; 
    $status = $data["status"]; 
    $payment = $data["payment"]; 
    $totalPrice = $data["totalPrice"];

    if(isset($data["idUser"])) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateOrder = (date("Y-m-d H:i:s"));
        $sql = "INSERT INTO `order`(`idUser`, `dateOrder`, `fullname`, `address`, `phone`,  `email`, `status`, `payment`, `totalPrice`) VALUES ($idUser ,'$dateOrder' , '$fullname' , '$address' , '$phone', '$email', 'Chờ vận chuyển', 'COD', '$totalPrice')";
        $result = $conn->query($sql);
    
        if($result) {
            $sql = "SELECT * FROM `order` WHERE idUser = '$idUser' AND dateOrder = '$dateOrder'";
            $resultSelectOne = $conn->query($sql);
    
            while ($row = $resultSelectOne->fetch_assoc()) {
                $idOrder = $row['idOrder'];
            }
    
            foreach ($products as  $value) {
                $idProduct = $value['idProduct'] ;
                $quantityProduct = $value['quantityProductCart'];
                $size = $value['size'];
    
                $sql = "INSERT INTO detailOrder (`idOrder`, `idProduct`, `size` ,`quantityProduct`) VALUES ($idOrder, '$idProduct', '$size' ,'$quantityProduct')";
                $result = $conn->query($sql);
    
                if($result) {
                    $sqlDeleteCart = "DELETE FROM cart WHERE idUser = $idUser";
                    $resultDeleteCart = $conn->query($sqlDeleteCart); 
                    if($resultDeleteCart) {
                        // Select Quantity Size
                        $sizeFull = 'size'.$size;
                        $sqlSelectQuantitySize = "SELECT * FROM product WHERE idProduct = '$idProduct' AND $sizeFull";
                        $resultSelectQuantitySize = $conn->query($sqlSelectQuantitySize);
                        while ($row = $resultSelectQuantitySize->fetch_assoc()) {
                            $quantitySize = $row[$sizeFull];
                        }

                        //Update Quantity Size
                        $value =  $quantitySize - $quantityProduct;
                        $sqlUpdateQuantitySize = "UPDATE product SET $sizeFull = '$value' WHERE idProduct = '$idProduct'";
                        $resultUpdateQuantitySize = $conn->query($sqlUpdateQuantitySize);

                        echo json_encode(array(
                            "status" => "success",
                        ));
                    }                
                } else {
                    echo json_encode(array(
                        "status" => "fail",
                    ));
                }
                
                
            }
        }
    }

    
    $conn->close();
?>