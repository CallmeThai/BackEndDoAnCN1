<?php

    include "DBConfig.php";
    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data["nameProduct"]) || $data["idCate"] || $data["priceProduct"]){
        $nameProduct = $data["nameProduct"]; 
        $idCate = (int)$data["idCate"]; 
        $priceProduct = (int)$data["priceProduct"]; 
        $descriptionProduct = $data["descriptionProduct"]; 
        $viewProduct = (int)$data["viewProduct"]; 
        $size37 = (int)$data["size37"]; 
        $size38 = (int)$data["size38"]; 
        $size39 = (int)$data["size39"]; 
        $size40 = (int)$data["size40"]; 
        $size41 = (int)$data["size41"]; 
        $size42 = (int)$data["size42"]; 
        $size43 = (int)$data["size43"]; 
        $size44 = (int)$data["size44"]; 
        $size45 = (int)$data["size45"]; 
    
        $imageProduct_1 = $data["imageProduct_1"]; 
        $imageProduct_2 = $data["imageProduct_2"]; 
        $imageProduct_3 = $data["imageProduct_3"]; 
        $imageProduct_4 = $data["imageProduct_4"]; 
    
        $sqlInsertProduct = "INSERT INTO product (nameProduct, idCategory, imageProduct_1, imageProduct_2, imageProduct_3, imageProduct_4, size37, size38, size39, size40, size41, size42, size43, size44, size45, priceProduct, descriptionProduct, viewProduct) VALUES ('$nameProduct', $idCate , '$imageProduct_1', '$imageProduct_2', '$imageProduct_3', '$imageProduct_4', $size37, $size38, $size39, $size40, $size41, $size42, $size43, $size44, $size45, $priceProduct, '$descriptionProduct', $viewProduct)";
        $resultInsertProduct = $conn->query($sqlInsertProduct);

        if ($resultInsertProduct) {
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