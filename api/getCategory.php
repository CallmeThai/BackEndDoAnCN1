<?php
    include "DBConfig.php";

    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);

    $categoris = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $category = array(
            "idCategory" => $row["idCategory"],
            "nameCategory" => $row["nameCategory"],
            );
            array_push($categoris, $category);
        }
    }

    echo json_encode($categoris);

    $conn->close();

?>