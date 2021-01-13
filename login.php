<?php

session_start();


function login()
{
    include 'db.php';
    $sql = "SELECT * FROM user WHERE id = 11";
    $data = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($data);

    // var_dump($result);

    if ($result == null) {
        die('Tidak memiliki akses');
    }

    $_SESSION['id'] = $result['id'];
    $_SESSION['nama'] = $result['nama'];
    $_SESSION['alamat'] = $result['alamat'];
    $_SESSION['role'] = $result['role'];

    // $_SESSION = [
    //     'id' => $result['id'],
    // ];

    return true;
}

function get()
{
    var_dump($_GET);
}

function post()
{
    var_dump($_POST);
}

login();

// get();

// $_GET;
// $_POST;
// $_SESSION;
