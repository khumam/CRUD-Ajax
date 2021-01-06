<?php

include 'db.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM user WHERE id = $id";

    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($query);

    echo json_encode($data);
} else {
    $sql = "SELECT * FROM user";

    $query = mysqli_query($db, $sql);
    $data = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    echo json_encode($data);
}
