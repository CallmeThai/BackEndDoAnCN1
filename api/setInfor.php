<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    $idUser = $data["idUser"]; 
    $fullname = $data["fullname"]; 
    $email = $data["email"]; 
    $phone = $data["phone"]; 
    $address = $data["address"]; 

    $sql = "UPDATE `user` SET `fullname`='$fullname',`phone`='$phone',`email`='$email',`address`='$address' WHERE idUser = '$idUser'";
    echo $sql;
    $result = $conn->query($sql);

    if($result) {
        echo json_encode(array(
            "message" => "Thành công!",
        ));
    } else {
        echo json_encode(array(
            "message" => "Thất bại!",
        ));
    }

    $conn->close();
?>