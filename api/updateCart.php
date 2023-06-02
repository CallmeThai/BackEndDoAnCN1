<?php

    include "DBConfig.php";
    $data = json_decode(file_get_contents('php://input'), true);

    $idCart = $data["idCart"]; 
    $quantityProductCart = $data["quantityProductCart"];

    $sql = "UPDATE cart SET quantityProductCart ='$quantityProductCart' WHERE idCart = '$idCart'";
    $result = $conn->query($sql); 

    if ($result) {
        echo json_encode(array(
            "message" => "Cập nhật thành công",
            "status" => "success",
        ));
    } else {
        echo json_encode(array(
            "message" => "Cập nhật thất bại",
            "status" => "fail",
        ));
    }

    $conn->close();

?>