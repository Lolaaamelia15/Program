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

    if ($request_method === "GET") {
        http_response_code(200);
        
        $query = "SELECT * FROM transaksi";

        // if (isset($_GET["start-date"])) {
        //     $tanggal = $_GET["start-date"];
        //     $query .= "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$tanggal%'";
        // }

        // if (isset($_GET["jenis_bibit"])) {
        //     $jenis = (int)$_GET["jenis_bibit"];
        //     $query = "SELECT * FROM `transaksi` WHERE `id_bibit` = $jenis";
        // }

        // if (isset($_GET["tanggal_transaksi"]) && isset($_GET["jenis_bibit"])) {
        //     $query = "SELECT * FROM `transaksi` WHERE `id_bibit` = $jenis AND tanggal_transaksi LIKE '$tanggal%'";
        // }
        if(isset($_GET["start-date"]) && isset($_GET["end-date"]) && isset($_GET["jenis"])){
            if($_GET["start-date"] != ""){
                $start = $_GET["start-date"];
                $query = "SELECT * FROM `transaksi` WHERE tanggal_transaksi >= CAST('$start' AS DATETIME)";
            }
            if($_GET["end-date"] != ""){
                $end = $_GET["end-date"];
                $query = "SELECT * FROM `transaksi` WHERE tanggal_transaksi <= CAST('$end' AS DATETIME)";
            }
            if($_GET["jenis"] != ""){
                $jenis = $_GET["jenis"];
                $query = "SELECT * FROM `transaksi` WHERE nama_bibit = '$jenis'";
            }
            if($_GET["start-date"] != "" && $_GET["end-date"] != ""){
                $start = $_GET["start-date"];
                $end = $_GET["end-date"];
                $query = "SELECT * FROM `transaksi` WHERE tanggal_transaksi BETWEEN CAST('$start' AS DATETIME) AND CAST('$end' AS DATETIME)";
            }
            if($_GET["start-date"] != "" && $_GET["end-date"] != "" && $_GET["jenis"] != ""){
                $start = $_GET["start-date"];
                $end = $_GET["end-date"];
                $jenis = $_GET["jenis"];
                $query = "SELECT * FROM `transaksi` WHERE tanggal_transaksi BETWEEN CAST('$start' AS DATETIME) AND CAST('$end' AS DATETIME) AND nama_bibit = '$jenis'";
            }
        }
        $data = query($query);
        return $data;
    }

    if ($request_method === "POST") {

        $status = addTransaksi($_POST);
        if ($status <= 0) {
            $status["message"] = "Gagal Menambahkan Transaksi";
            return $status;
        }

        $status["message"] = "Berhasil Menambahkan Transaksi";
        return $status;
        return $status;
    }
}
print(json_encode(api()));
