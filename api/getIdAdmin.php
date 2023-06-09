<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data["username"]; 
    $password = $data["password"]; 
    $sql = "SELECT * FROM user  WHERE username = '$username' AND password = '$password' AND role = '1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $idAdmin = array(
                "idUser" => $row["idUser"],
                "username" => $row["username"],
                "phone" => $row["phone"],
                "email" => $row["email"],
                );
            $data = array(
                "message" => "Đăng nhập đúng rùi",
                "idAdmin" => $idAdmin,
            );
        }
        setcookie("login", 1, time()+36000, '/');
        echo json_encode($data);

    }else {
        echo json_encode(array(
            "message" => "Lỗi rùi",
            "idAdmin" => null,
        ));

    }


    $conn->close();

?>