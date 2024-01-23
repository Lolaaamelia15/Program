<?php

require_once("database.php");

function api()
{
    global $db;
    $status = ["login" => false];
    http_response_code(401);
    $method_allowed = ["POST"];
    $request_method = $_SERVER["REQUEST_METHOD"];

    // Check Request Method
    if (!in_array($request_method, $method_allowed)) {
        $status["message"] = "METHOD_NOT_ALLOWED";
        return $status;
    }

    // Check blank input
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $status["message"] = "Username/Password kosong";
        return $status;
    }

    // get username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // check username in database
    $result = $db->query("SELECT * FROM petugas WHERE username = '$username'");
    if ($result->num_rows !== 1) {
        $status["message"] = "Username Salah";
        return $status;
    }

    // check password
    $data = $result->fetch_assoc();
    if ($data["password"] !== $password) {
        $status["message"] = "Password salah";
        return $status;
    }

    // login successfull
    http_response_code(200);
    $status["login"] = true;
    $status["id_petugas"] = $data["id_petugas"];
    $status["message"] = "Login berhasil";
    return $status;
}

print(json_encode(api()));
