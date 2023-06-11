<?php

    include "DBConfig.php";
    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data["idOrder"])){
        $idOrder = $data["idOrder"]; 
        $nameStatus = $data["nameStatus"]; 

        $sqlEditStatus = "UPDATE `order` SET `status`='$nameStatus' WHERE `idOrder` = '$idOrder'";
        $resultEditStatus = $conn->query($sqlEditStatus);

        if ($resultEditStatus) {
            echo json_encode(array(
                "status" => "success",
            ));
        } else {
            echo json_encode(array(
                "status" => "fail",
            ));
        }

    } else {
        echo json_encode(array(
            "status" => "error",
        ));
    }


    $conn->close();
?>