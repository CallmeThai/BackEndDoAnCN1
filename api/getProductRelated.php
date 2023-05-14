<?php
    include "DBConfig.php";    

    if(isset($_GET["idcategory"])) {
        $idcategory = $_GET["idcategory"];
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
                "imageProduct_1" => $row["imageProduct_1"],
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