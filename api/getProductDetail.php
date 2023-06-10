<?php

    include 'DBConfig.php';

    if(isset($_GET["idproduct"])) {
        $idproduct = $_GET["idproduct"];
        $sql = "SELECT * FROM product WHERE idProduct = $idproduct";
        $result = $conn->query($sql);

        $products = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = array(
                "idProduct" => $row["idProduct"],
                "idCategory" => $row["idCategory"],
                "nameProduct" => $row["nameProduct"],
                "priceProduct" => $row["priceProduct"],
                "quantityProduct" => $row["quantityProduct"],
                "size37" => (int)$row["size37"],
                "size38" => (int)$row["size38"],
                "size39" => (int)$row["size39"],
                "size40" => (int)$row["size40"],
                "size41" => (int)$row["size41"],
                "size42" => (int)$row["size42"],
                "size43" => (int)$row["size43"],
                "size44" => (int)$row["size44"],
                "size45" => (int)$row["size45"],
                "descriptionProduct" => $row["descriptionProduct"],
                "imageProduct_1" => $row["imageProduct_1"],
                "imageProduct_2" => $row["imageProduct_2"],
                "imageProduct_3" => $row["imageProduct_3"],
                "imageProduct_4" => $row["imageProduct_1"],
                "viewProduct" => $row["viewProduct"],
                );
                array_push($products, $product);
            }
        }
        echo json_encode($products);
    } else {
        echo json_encode([]);
    }
    $conn->close();
    
?>