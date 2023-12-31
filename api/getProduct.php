<?php

    include "DBConfig.php";

    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

    $products = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product = array(
            "idProduct" => $row["idProduct"],
            "idCategory" => $row["idCategory"],
            "nameProduct" => $row["nameProduct"],
            "priceProduct" => number_format($row["priceProduct"]),
            "imageProduct_1" => $row["imageProduct_1"],
            "imageProduct_2" => $row["imageProduct_2"],
            "imageProduct_3" => $row["imageProduct_3"],
            "imageProduct_4" => $row["imageProduct_4"],
            "size37" => $row["size37"],
            "size38" => $row["size38"],
            "size39" => $row["size39"],
            "size40" => $row["size40"],
            "size41" => $row["size41"],
            "size42" => $row["size42"],
            "size43" => $row["size43"],
            "size44" => $row["size44"],
            "size45" => $row["size45"],
            "descriptionProduct" => $row["descriptionProduct"],
            "viewProduct" => $row["viewProduct"],
            );
            array_push($products, $product);
        }
    }

    echo json_encode($products);
    $conn->close();

?>