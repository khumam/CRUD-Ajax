<?php

include 'db.php';

if (isset($_POST['namaupdate']) && isset($_POST['alamatupdate'])) {
    $nama = $_POST['namaupdate'];
    $alamat = $_POST['alamatupdate'];
    $aktif = $_POST['aktifupdate'];
    $id = $_POST['id'];

    $sql = "UPDATE user SET nama = '$nama', alamat='$alamat', aktif=$aktif WHERE id = $id";

    $query = mysqli_query($db, $sql);

    if ($query) {
        $result = [
            'msg' => 'Sukses update data',
            'status' => true
        ];
    } else {
        $result = [
            'msg' => 'Gagal update data',
            'status' => false,
            'cek' => [$nama, $alamat]
        ];
    }

    echo json_encode($result);
} else {
    $result = [
        'msg' => 'Gagal update data. Nama dan alamat kosong',
        'status' => false
    ];

    echo json_encode($result);
}
