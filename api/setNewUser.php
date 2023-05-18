<?php

    include "DBConfig.php";

    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data["username"]; 
    $password = $data["password"]; 

    $sqlCheckUser = "SELECT * FROM user  WHERE username = '$username'";
    // echo  $sqlCheckUser;
    // echo "----------------------------------------------------------------";
    $checkUser = $conn->query($sqlCheckUser);

    if($checkUser->num_rows > 0) {
        echo json_encode(array(
            "message" => "Tài khoản bạn đăng ký đã tồn tại trong hệ thống! Vui lòng thử tài khoản khác",
        ));
    } else {
        $sqlInsertUser = "INSERT INTO user (username, password, role, avatar) VALUES ('$username', '$password', '0', 'https://static.vecteezy.com/system/resources/previews/013/042/571/original/default-avatar-profile-icon-social-media-user-photo-in-flat-style-vector.jpg')";
        $result = $conn->query($sqlInsertUser);
        if ($result) {
            echo json_encode(array(
                "message" => "success",
            ));
        } else {
            echo json_encode(array(
                "message" => "fail",
            ));
        }
    }

    
    $conn->close();

?>