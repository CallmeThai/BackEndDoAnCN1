<?php

    include 'DBConfig.php';

    if(isset($_GET["idproduct"])) {
        $idproduct = $_GET["idproduct"];
        $sql = "UPDATE product SET viewProduct = viewProduct+1 WHERE idProduct = '$idproduct'";
        $result = $conn->query($sql);   
    }
    $conn->close();
    
?>