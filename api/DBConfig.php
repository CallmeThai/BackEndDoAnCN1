<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dacn1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>

<?php

    /** Thực thi câu lệnh SQL  */
    function execute($sql){
        $conn = connection();
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    /**
     * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
     * Lấy toàn bộ dữ liệu
     */
    function selectAll($sql){
        $conn = connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    function selectRow($sql){
        $conn = connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchColumn();
        return $data;
    }

    // Lấy Top Sản Phẩm

    function loadTopProduct() {
        $sql = "SELECT * FROM product WHERE 1 ORDER BY view DESC LIMIT 0,5";
        $conn = connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    /**
     * Thực thi câu lệnh sql truy vấn một bản ghi
     */
    function selectOne($sql){
        $conn = connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }


    /**
     * Thực thi câu lệnh sql truy vấn một giá trị
     */
    function query_value($sql){
        $conn = connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row[0];
    }


    function limitInfo($str,$limit=100){
        if(strlen($str)<=$limit) return $str;
        return mb_substr($str,0,$limit-0,'UTF-8').'...';
    }

    // Lấy đơn hàng
    function selectCart($sql){
        $conn = connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

?>