<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    $idUser =(int) $data["idUser"]; 
    $fullname = $data["fullname"]; 
    $address = $data["address"]; 
    $phone = $data["phone"]; 
    $status = $data["status"]; 
    $payment = $data["payment"]; 
    $totalPrice = $data["totalPrice"];

    $sqlSelect = "SELECT * FROM cart WHERE idUser = '$idUser' AND idProduct = '$idProduct'";
    
    $sql = "INSERT INTO order (`idUser`, `fullname`, `address`, `phone`, `status`, `payment`, `totalPrice`) VALUES ($idUser, $idProduct, 1)";
    
    $result = $conn->query($sqlSelect);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quantityProductCart = $row['quantityProductCart'];
        }
        $sqlUpdate = "UPDATE cart SET quantityProductCart = '$quantityProductCart' + 1 WHERE idUser = '$idUser' AND idProduct = '$idProduct'";
        $conn->query($sqlUpdate);
    

    
    } else {
        $sql = "INSERT INTO cart (`idUser`, `idProduct`, `quantityProductCart`) VALUES ($idUser, $idProduct, 1)";
        $conn->query($sql);
        

    }

    

    $conn->close();
?>