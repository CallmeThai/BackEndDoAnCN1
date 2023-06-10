<?php

    include 'DBConfig.php';

    if(isset($_GET["idcategory"])) {
        $idCategory = $_GET["idcategory"];
        $sql = "SELECT * FROM category WHERE idCategory = $idCategory";
        $result = $conn->query($sql);

        $categoris = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category = array(
                "nameCategory" => $row["nameCategory"],
                );
                array_push($categoris, $category);
            }
        }
        echo json_encode($categoris);
    } else {
        echo json_encode([]);
    }
    $conn->close();
    
?>