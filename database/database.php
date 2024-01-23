<?php

$hostname = "localhost";
$username = "id21061324_fishcounter";
$password = "Fish_Counter123";
$database = "id21061324_fish_counter";

$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_errno) {
    die("Connection Database Refused: $db->connect_errno");
}
function query($query): array
{
    global $db;

    $result = $db->query($query);

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}

function addTransaksi($data): array
{
    global $db;
    
    try{
        $id_bibit = (int)$data["id_bibit"];
        $data_bibit = query("SELECT nama, ukuran FROM bibit_ikan WHERE id_bibit = $id_bibit")[0];
        $nama_bibit = $data_bibit["nama"];
        $ukuran_bibit = $data_bibit["ukuran"];
        $id_petugas = (int)$data["id_petugas"];
        $nama_petugas = query("SELECT nama_petugas FROM petugas WHERE id_petugas = $id_petugas")[0]["nama_petugas"];
        $jumlah = (int)$data["jumlah"];
        $harga_per_ekor = (int)$data["harga_per_ekor"];
        $total_harga = $jumlah * $harga_per_ekor;
    }
    catch(Exception $e) {
        $status["message"] = $e->getMessage();
        return $status;
    }

    $query = "INSERT INTO `transaksi` (`id_transaksi`, `id_bibit`, `nama_bibit`, `ukuran_bibit`, `id_petugas`, `nama_petugas`, `tanggal_transaksi`, `jumlah`, `harga_per_ekor`, `total_harga`) VALUES (
        NULL, 
        $id_bibit, 
        '$nama_bibit',
        '$ukuran_bibit',
        $id_petugas,
        '$nama_petugas',
        CURRENT_TIMESTAMP, 
        $jumlah, 
        $harga_per_ekor,
        $total_harga)";

    $db->query($query);
    $db->affected_rows;
    
    if ($db->affected_rows < 0) {
        $status["message"] = "Gagal Menambahkan Transaksi";
        return $status;
    }
    $query = "UPDATE `status` SET hitung='true', jumlah=$jumlah, harga=$harga_per_ekor WHERE id = 0";
    $db->query($query);
    $db->affected_rows;
    if ($db->affected_rows < 0) {
        $status["message"] = "Gagal Menambahkan Data ke Status";
        return $status;
    }
    $status["message"] = "Berhasil Menambahkan Transaksi";
    return $status;
}
