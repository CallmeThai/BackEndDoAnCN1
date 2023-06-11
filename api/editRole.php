<?php

    include "DBConfig.php";
    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data["idUser"])){
        $idUser = $data["idUser"]; 
        $role = $data["role"]; 
        
            
        $sqlEditRole = "UPDATE `user` SET `role`='$role' WHERE `idUser` = '$idUser'";
        $resultEditRole = $conn->query($sqlEditRole);

        if ($resultEditRole) {
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