<?php

    include "DBConfig.php";

    if(isset($_GET["idUser"])) {
        $idUser = $_GET["idUser"]; 
        
        $sql = "SELECT * FROM user  WHERE idUser = '$idUser'";
        $result = $conn->query($sql);

        $info = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $inforUser = array(
                    "idUser" => $row["idUser"],
                    "username" => $row["username"],
                    "fullname" => $row["fullname"],
                    "phone" => $row["phone"],
                    "email" => $row["email"],
                    "gender" => $row["gender"],
                    "address" => $row["address"],
                    "avatar" => $row["avatar"],
                    );
                    
                    // $data = array(
                    //     "inforUser" => $inforUser,
                    // );
                    array_push($info, $inforUser);
            }
            echo json_encode($info);
        } else {
            echo json_encode(array(
                "message" => "fail",
            ));
        }
    } else {
        echo json_encode(array(
            "message" => "fail",
        ));
    }


    $conn->close();

?>