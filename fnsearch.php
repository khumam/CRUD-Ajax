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
}
