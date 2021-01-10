<?php

include 'db.php';

if (isset($_POST['key'])) {
    if ($_POST['key'] == null) {

        if ($_POST['page'] == 0) {
            $sql = "SELECT * FROM user WHERE deleted=0 LIMIT 10";
        } else {
            $start_from = $_POST['page'] * 10;
            $sql = "SELECT * FROM user WHERE deleted=0 LIMIT $start_from, 10";
        }

        $sql_halaman = "SELECT count(*) as total FROM user WHERE deleted = 0";
        $query_halaman = mysqli_query($db, $sql_halaman);
        $total_halaman = mysqli_fetch_assoc($query_halaman);

        $query = mysqli_query($db, $sql);

        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        $result = [
            'data' => $data,
            'total' => $total_halaman['total']
        ];

        echo json_encode($result);
    } else {

        $key = $_POST['key'];

        if ($_POST['page'] == 0) {
            $sql = "SELECT * FROM user WHERE (nama LIKE '%$key%' OR alamat LIKE '%$key%') AND deleted=0 LIMIT 10";
        } else {
            $start_from = $_POST['page'] * 10;
            $sql = "SELECT * FROM user WHERE (nama LIKE '%$key%' OR alamat LIKE '%$key%') AND deleted=0 LIMIT $start_from, 10";
        }


        $sql_halaman = "SELECT count(*) as total FROM user WHERE (nama LIKE '%$key%' OR alamat LIKE '%$key%') AND deleted=0";
        $query_halaman = mysqli_query($db, $sql_halaman);
        $total_halaman = mysqli_fetch_assoc($query_halaman);

        $query = mysqli_query($db, $sql);

        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        $result = [
            'data' => $data,
            'total' => $total_halaman['total']
        ];

        echo json_encode($result);
    }
} else {
    if (isset($_POST['tipe'])) {
        if ($_POST['tipe'] == 'alamat') {
            // $sql = "SELECT id, alamat FROM user"; // Untuk beda table
            $sql = "SELECT distinct(alamat) FROM user WHERE deleted=0";

            $query = mysqli_query($db, $sql);

            $data = [];

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }

            echo json_encode($data);
        } else if ($_POST['tipe'] == 'getnama') {
            $query = $_POST['value'];
            $sql = "SELECT * FROM user WHERE id = $query AND deleted=0";

            $query = mysqli_query($db, $sql);

            $row = mysqli_fetch_assoc($query);

            echo json_encode($row);
        } else {
            $query = $_POST['value'];

            // $sql = "SELECT id, nama FROM user WHERE id = $query"; // Untuk dua table
            $sql = "SELECT id, nama FROM user WHERE alamat = '$query' AND deleted=0";

            $query = mysqli_query($db, $sql);

            $data = [];

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
    }
}
