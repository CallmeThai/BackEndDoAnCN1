<?php

    include "DBConfig.php";
    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data["idCategory"])){
        $idCategory = $data["idCategory"]; 
        $nameCategory = $data["nameCategory"]; 
        
            
        $sqlEditCategory = "UPDATE `category` SET `nameCategory`='$nameCategory' WHERE `idCategory` = '$idCategory'";
        $resultEditCategory = $conn->query($sqlEditCategory);

        if ($resultEditCategory) {
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