<?php

    include "DBConfig.php";

    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);

    $users = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user = array(
            "idUser" => $row["idUser"],
            "username" => $row["username"],
            "fullname" => $row["fullname"],
            "phone" => $row["phone"],
            "email" => $row["email"],
            "role" => $row["role"],
            "address" => $row["address"],
            );
            array_push($users, $user);
        }
    }
    echo json_encode($users);
    $conn->close();

?>