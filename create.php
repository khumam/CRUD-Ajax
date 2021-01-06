<?php

include 'db.php';

if (isset($_POST['nama']) && isset($_POST['alamat'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $aktif = $_POST['aktif'];

    $sql = "INSERT INTO user (nama, alamat, aktif) VALUES ('$nama', '$alamat', $aktif)";

    $query = mysqli_query($db, $sql);

    if ($query) {
        $result = [
            'msg' => 'Sukses input data',
            'status' => true
        ];
    } else {
        $result = [
            'msg' => 'Gagal input data',
            'status' => false,
            'cek' => [$nama, $alamat, $aktif]
        ];
    }

    echo json_encode($result);
} else {
    $result = [
        'msg' => 'Gagal input data. Nama dan alamat kosong',
        'status' => false
    ];

    echo json_encode($result);
}
