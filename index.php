<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <h1 class="mt-5 text-center">AJAX</h1>

    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'petugas')) { ?>
        <div class="container mt-5">
            <h1>Insert</h1>
            <form id='data'>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama">
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat">
                <select name="aktif" id="aktif" class="custom-select">
                    <option value="0">Tidak aktif</option>
                    <option value="1">Aktif</option>
                </select>
                <button type="button" id="btn-submit" class="btn btn-success btn-submit" onclick="sendData()">Kirim data</button>
            </form>
        </div>
    <?php } ?>

    <div class="container mt-5">
        <h1>Update</h1>
        <form id='dataupdate'>
            <select name="id" id="listUser" class="custom-select"></select>

            <input type="text" class="form-control" name="namaupdate" id="namaupdate" placeholder="nama">
            <input type="text" class="form-control" name="alamatupdate" id="alamatupdate" placeholder="alamat">
            <select name="aktifupdate" id="aktifupdate" class="custom-select">
                <option value="0">Tidak aktif</option>
                <option value="1">Aktif</option>
            </select>
            <button type="button" id="btn-update" onclick="updateData()" class="btn btn-warning btn-submit">Update data</button>
        </form>
    </div>

    <div class="container my-5">
        <h1>Delete</h1>
        <form id='datadelete'>
            <select name="id" id="listUserDelete" class="custom-select"></select>
            <button type="button" id="btn-update" onclick="deleteData()" class="btn btn-danger btn-submit">Hapus data</button>
        </form>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <script>
        function sendData() {
            var dataForm = $('#data').serialize();
            $.ajax({
                url: 'create.php',
                data: dataForm,
                method: 'POST',
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }

            });
        }

        function getData() {
            $.ajax({
                url: 'read.php',
                success: function(response) {
                    console.log(response);
                    res = JSON.parse(response);
                    var list = '';
                    var selectList = '<option>-- PILIH USER --</option>';
                    $.each(res, function(index, value) {
                        list += '<li class="list-group-item">' + value.nama + ' di ' + value.alamat + '</li>';
                        selectList += '<option value="' + value.id + '">' + value.nama + '</option>';
                    });

                    $('#list').append(list);
                    $('#listUser').append(selectList);
                    $('#listUserDelete').append(selectList);
                    $('#text').html(list);
                    $('#valtext').val(list);
                },
                error: function(response) {
                    console.log(response);
                }

            });
        }

        $('#listUser').on('change', function() {
            $.ajax({
                url: 'read.php',
                data: {
                    id: this.value,
                },
                method: 'POST',
                success: function(response) {
                    console.log(response);
                    res = JSON.parse(response);
                    $('#namaupdate').val(res.nama);
                    $('#alamatupdate').val(res.alamat);
                    $('#aktifupdate').val(res.aktif);
                },
                error: function(response) {
                    console.log(response);
                }

            });
        });

        $(document).ready(function() {
            getData();
        });

        function updateData() {
            var dataForm = $('#dataupdate').serialize();
            $.ajax({
                url: 'update.php',
                data: dataForm,
                method: 'POST',
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(response) {
                    console.log(response);
                }

            });
        }

        function deleteData() {
            var dataForm = $('#datadelete').serialize();
            $.ajax({
                url: 'delete.php',
                data: dataForm,
                method: 'POST',
                success: function(response) {
                    console.log(response);
                    res = JSON.parse(response);
                    // window.location.reload();
                    alert(res.msg);
                },
                error: function(response) {
                    console.log(response);
                }

            });
        }
    </script>
</body>

</html>