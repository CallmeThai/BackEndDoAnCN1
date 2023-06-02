<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data["username"]; 
    $password = $data["password"]; 
    $sql = "SELECT * FROM user  WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user = array(
                "idUser" => $row["idUser"],
                "username" => $row["username"],
                "phone" => $row["phone"],
                "email" => $row["email"],
                );
            $data = array(
                "message" => "Đăng nhập đúng rùi",
                "user" => $user,
            );
        }
        setcookie("login", 1, time()+36000, '/');
        echo json_encode($data);

    }else {
        echo json_encode(array(
            "message" => "Lỗi rùi",
            "user" => null,
            
        ));

    }


    // echo json_encode($products);
    $conn->close();

?>