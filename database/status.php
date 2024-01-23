<?php 
require_once("database.php");

function api()
{
    global $db;
    http_response_code(401);
    $method_allowed = ["GET", "POST"];
    $request_method = $_SERVER["REQUEST_METHOD"];

    // Check Request Method
    if (!in_array($request_method, $method_allowed)) {
        $status["message"] = "METHOD_NOT_ALLOWED";
        return $status;
    }
    if($request_method == "GET"){
        return query("SELECT * FROM `status` WHERE id = 0")[0];
    }
    if($request_method == "POST"){ 
        $query = "UPDATE `status` SET hitung='false', jumlah=0, harga=0 WHERE id = 0";
        $db->query($query);
        $db->affected_rows;
        if ($db->affected_rows < 0) {
            $status["message"] = "Gagal reset status";
            return $status;
        }
        return $status["message"] = "Berhasil reset status";
    }
}
print(json_encode(api()));
?>