<?php

include 'db.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM user WHERE id = $id";

    $query = mysqli_query($db, $sql);

    if ($query) {
        $result = [
            'msg' => 'Sukses hapus data',
            'status' => true
        ];
    } else {
        $result = [
            'msg' => 'Gagal hapus data',
            'status' => false,
        ];
    }

    echo json_encode($result);
} else {
    $result = [
        'msg' => 'Tidak mempunyai akses hapus',
        'status' => false,
    ];

    echo json_encode($result);
}
