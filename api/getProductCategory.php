<?php

    include 'DBConfig.php';

    if(isset($_GET["idcategory"])) {
        $idcategory = $_GET["idcategory"];

        if ($idcategory !== "allProduct") {
            $sql = "SELECT * FROM product WHERE idCategory = $idcategory";
            $result = $conn->query($sql);

            $products = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product = array(
                    "idProduct" => $row["idProduct"],
                    "idCategory" => $row["idCategory"],
                    "nameProduct" => $row["nameProduct"],
                    "priceProduct" => number_format($row["priceProduct"]),
                    "quantityProduct" => $row["quantityProduct"],
                    "descriptionProduct" => $row["descriptionProduct"],
                    "imageProduct_1" => $row["imageProduct_1"],
                    "imageProduct_2" => $row["imageProduct_2"],
                    "imageProduct_3" => $row["imageProduct_3"],
                    "imageProduct_4" => $row["imageProduct_1"],
                    );
                    array_push($products, $product);
                    }
                }
            echo json_encode($products);
            } else {
                $sql = "SELECT * FROM product ";
            $result = $conn->query($sql);

            $products = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product = array(
                    "idProduct" => $row["idProduct"],
                    "idCategory" => $row["idCategory"],
                    "nameProduct" => $row["nameProduct"],
                    "priceProduct" => number_format($row["priceProduct"]),
                    "quantityProduct" => $row["quantityProduct"],
                    "descriptionProduct" => $row["descriptionProduct"],
                    "imageProduct_1" => $row["imageProduct_1"],
                    "imageProduct_2" => $row["imageProduct_2"],
                    "imageProduct_3" => $row["imageProduct_3"],
                    "imageProduct_4" => $row["imageProduct_1"],
                    );
                    array_push($products, $product);
                    }
                }
            echo json_encode($products);
        } 
    }
    $conn->close();
    
?>