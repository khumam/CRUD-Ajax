<?php

include 'db.php';

if (isset($_POST['key'])) {
    if ($_POST['key'] == null) {

        $sql = "SELECT * FROM user";

        $query = mysqli_query($db, $sql);

        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        $key = $_POST['key'];

        $sql = "SELECT * FROM user WHERE nama LIKE '%$key%' OR alamat LIKE '%$key%' ";

        // JOSEPH
        // = JOSEPH
        // %OS .......OS
        // OS% OS.......
        // %OS%  .......OS.......

        $query = mysqli_query($db, $sql);

        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        echo json_encode($data);
    }
} else {
    if (isset($_POST['tipe'])) {
        if ($_POST['tipe'] == 'alamat') {
            // $sql = "SELECT id, alamat FROM user"; // Untuk beda table
            $sql = "SELECT distinct(alamat) FROM user";

            $query = mysqli_query($db, $sql);

            $data = [];

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }

            echo json_encode($data);
        } else if ($_POST['tipe'] == 'getnama') {
            $query = $_POST['value'];
            $sql = "SELECT * FROM user WHERE id = $query";

            $query = mysqli_query($db, $sql);

            $row = mysqli_fetch_assoc($query);

            echo json_encode($row);
        } else {
            $query = $_POST['value'];

            // $sql = "SELECT id, nama FROM user WHERE id = $query"; // Untuk dua table
            $sql = "SELECT id, nama FROM user WHERE alamat = '$query'";

            $query = mysqli_query($db, $sql);

            $data = [];

            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
    }
}
