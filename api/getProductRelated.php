<?php
    include "DBConfig.php";    

    if(isset($_GET["idproduct"])) {
        $idproduct = $_GET["idproduct"];
        $sql = "SELECT * FROM product WHERE idProduct = $idproduct";
        // echo $sql;
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

        $idcategory = $products[0]["idCategory"];
        $sqlProductRelated = "SELECT * FROM product WHERE idCategory = $idcategory LIMIT 4";
        $resultSqlProductRelated = $conn->query($sqlProductRelated);
        
        $productsRelated = array();
        if ($resultSqlProductRelated->num_rows > 0) {
            while ($row = $resultSqlProductRelated->fetch_assoc()) {
                $productRelated = array(
                "idProduct" => $row["idProduct"],
                "idCategory" => $row["idCategory"],
                "nameProduct" => $row["nameProduct"],
                "priceProduct" => number_format($row["priceProduct"]),
                "imageProduct_1" => $row["imageProduct_1"],
                );
                array_push($productsRelated, $productRelated);
            }
        }
        echo json_encode($productsRelated);
    } else {
        echo json_encode([]);
    }

    $conn->close();
?>