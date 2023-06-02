<?php

    include "DBConfig.php";
    $data = json_decode(file_get_contents('php://input'), true);

    $currentPass = $data["currentPass"]; 
    $newPass = $data["newPass"];
    $reNewPass = $data["reNewPass"]; 

    if (isset($_GET['idUser'])) {
        $idUser = $_GET['idUser'];

        $sqlCheckUser = "SELECT * FROM user  WHERE idUser = '$idUser'";
        $checkUser = $conn->query($sqlCheckUser);

        if ($checkUser->num_rows > 0) {
            while ($row = $checkUser->fetch_assoc()) {
                $user = array(
                    "password" => $row["password"],
                    );
                $passNow = $user['password'];
                
                if ($passNow == $currentPass) {
                    $sql = "UPDATE user SET password ='$newPass' WHERE idUser = '$idUser'";
                    $result = $conn->query($sql);
                    if ($result) {
                        echo json_encode(array(
                            "message" => "Cập nhật thành công",
                            "status" => "success",
                        ));
                    } else {
                        echo json_encode(array(
                            "message" => "Cập nhật thất bại",
                            "status" => "fail",
                        ));
                    }
                } else {
                    echo json_encode(array(
                        "message" => "Mật khẩu hiện tại không đúng",
                        "status" => "fail",

                    ));
                }
            }
        }else {
            echo json_encode(array(
                "message" => "Fail",
            ));
    
        }

        // if($checkUser) {
        //     $pass_old = $checkUser['password'];
        //     echo "check" + $pass_old;
            
        //     if($pass_old == $newPass) {
        //         $sql = "UPDATE user SET password ='$newPass' WHERE user = '$idUser'";
        //         $result = $conn->query($sql);
        //         if ($result) {
        //             echo json_encode(array(
        //                 "message" => "success",
        //             ));
        //         } else {
        //             echo json_encode(array(
        //                 "message" => "fail",
        //             ));
        //         }
        //     }
        //     echo json_encode(array(
        //         "message" => "ok",
        //     ));
        // } else {
        //     echo json_encode(array(
        //         "message" => "fail",
        //     ));
        }
    // }

    $conn->close();

?>