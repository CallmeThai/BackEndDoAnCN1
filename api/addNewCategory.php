<?php

    include "DBConfig.php";
    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data["nameCategory"])){
        $nameCategory = $data["nameCategory"]; 
    
        $sqlInsertCategory = "INSERT INTO category (nameCategory) VALUES ('$nameCategory')";
        $resultInsertCategory = $conn->query($sqlInsertCategory);

        if ($resultInsertCategory) {
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
            "status" => "fail",
        ));
    }


    $conn->close();
?>