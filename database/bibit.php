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

    http_response_code(200);
    $data = query("SELECT * FROM bibit_ikan");
    return $result = [ "data" => $data];
}
print(json_encode(api()));
