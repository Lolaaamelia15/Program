<?php

require_once("database.php");

function api()
{
    global $db;
    http_response_code(401);
    $method_allowed = ["GET"];
    $request_method = $_SERVER["REQUEST_METHOD"];

    // Check Request Method
    if (!in_array($request_method, $method_allowed)) {
        $status["message"] = "METHOD_NOT_ALLOWED";
        return $status;
    }

    if ($request_method === "GET") {
        http_response_code(200);
        $query = "SELECT id_petugas, nama_petugas FROM petugas";

        $data = query($query);
        return $data;
    }
}
print(json_encode(api()));
