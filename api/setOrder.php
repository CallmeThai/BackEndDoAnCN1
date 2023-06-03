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
    
                $sql = "INSERT INTO detailOrder (`idOrder`, `idProduct`, `quantityProduct`) VALUES ($idOrder, '$idProduct', '$quantityProduct')";
                $result = $conn->query($sql);
    
                if($result) {
                    $sqlDeleteCart = "DELETE FROM cart WHERE idUser = $idUser";
                    $resultDeleteCart = $conn->query($sqlDeleteCart); 
                    if($resultDeleteCart) {
                        echo json_encode(array(
                            "message" => "Đặt hàng thành công, chuyển hướng sau 3 giây",
                            "status" => "success",
                        ));
                    }                
                } else {
                    echo json_encode(array(
                        "message" => "Đặt hàng thất bại",
                        "status" => "fail",
                    ));
                }
            }
        }
    }

    
    $conn->close();
?>