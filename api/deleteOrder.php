<?php

    include "DBConfig.php";
    $data = json_decode(file_get_contents('php://input'), true);

    $idOrder = (int)$data["idOrder"]; 

    $sql = "DELETE FROM `order` WHERE idOrder = $idOrder";
    $result = $conn->query($sql); 

    if ($result) {
        echo json_encode(array(
            "message" => "Xoá thành công",
            "status" => "success",
        ));
    } else {
        echo json_encode(array(
            "message" => "Xoá thất bại",
            "status" => "fail",
        ));
    }

    $conn->close();

?>