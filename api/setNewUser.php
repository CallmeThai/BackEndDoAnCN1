<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data["username"]; 
    $password = $data["password"]; 
    $repassword = $data["repassword"]; 
    if ($password == $re_password && strlen($password) > 6 && strlen($re_password) > 6) {
        $sql = "SELECT * FROM user  WHERE username = '$username' AND password = '$password'";
        $sqlInsert = "INSERT INTO user (username, password, role, avatar) VALUES ('$username', '$password', '0', 'https://static.vecteezy.com/system/resources/previews/013/042/571/original/default-avatar-profile-icon-social-media-user-photo-in-flat-style-vector.jpg')";
        $result = $conn->query($sql);
        if (result) {
            $data = array(
                "message" => "Đăng ký đúng rùi",
            );
        } else {
            echo json_encode(array(
                "fail" => "Lỗi rùi",
            ));
        }
    } elseif (strlen($password) <= 6 || strlen($re_password) <= 6) {
        $data = array(
            "message" => "độ dài > 6",
        );
    } elseif ($password != $re_password || strlen($password) > 6) {
        echo json_encode(array(
            "fail" => "pass không trùng rùi",
        ));
    }

    // echo json_encode($products);
    $conn->close();

?>