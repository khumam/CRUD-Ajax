<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <title>Hello, world!</title>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center">Search</h1>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <form id='searchform'>
                            <div class="form-group">
                                <input type="text" name="search" id="search" class="form-control" onkeyup='searching()'>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-block" type="button" id="btn-search" onclick="searchBtn()">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 mt-3">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Aktif</th>
                                <th style="width: 100px;">Aksi</th>
                            </thead>
                            <tbody id="databody">
                            </tbody>
                        </table>
                        <!-- <div class="row" id="databody">
                </div> -->
                    </div>
                </div>
            </div>
            <!-- <div class="col-6">
                <form id='selectsearch'>
                    <div class="form-group">
                        <select name="query" id="query" class="custom-select" placeholder='Alamat' onchange="changeNama()">
                            <option value="">-- PILIH ALAMAT --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="resultquery" id="resultquery" class="custom-select" placeholder='Nama' onchange="getUser()">
                            <option value="">-- PILIH NAMA --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <p id="detailnama"></p>
                        <p id="detailalamat"></p>
                    </div>
                </form>
            </div> -->
        </div>

    </div>
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodalLabel">Edit data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editform">
                        <input type="hidden" id="data_id" name="id" value="">
                        <div class="form-group">
                            <label for="data_nama">Nama</label>
                            <input type="text" name="nama" id="data_nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="data_alamat">Alamat</label>
                            <input type="text" name="alamat" id="data_alamat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="data_aktif">Aktif</label>
                            <select name="aktif" id="data_aktif" class="custom-select">
                                <option value="0">Tidak aktif</option>
                                <option value="1">Aktif</option>
                            </select>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateData()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <script>
        function search(key = null) {
            $.ajax({
                url: 'fnsearch.php',
                method: 'post',
                data: {
                    key: key
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    var data = '';
                    $('#databody').empty();

                    $.each(res, function(index, val) {
                        data += '<tr><td>' + (index + 1) + '</td><td>' + val.nama + '</td><td>' + val.alamat + '</td><td>' + val.aktif + '</td><td><div class="btn-group">' +
                            '<button class="btn btn-success editbtn" data-id="' + val.id + '" data-nama="' + val.nama + '" data-alamat="' + val.alamat + '" data-aktif="' + val.aktif + '">Edit</button>' +
                            '<button class="btn btn-danger deletebtn" data-id="' + val.id + '">Delete</button></div></td></tr>';

                        // data += '<div class="col-3"><div class="card"><div class="card-body">' + val.nama + '</div></div></div>';
                    });

                    $('#databody').append(data);
                }
            })
        }

        function searchBtn() {
            var key = $('#search').val();
            search(key);
        }

        function searching() {
            var key = $('#search').val();
            search(key);
        }

        function getAlamat() {
            $.ajax({
                url: 'fnsearch.php',
                method: 'post',
                data: {
                    tipe: 'alamat'
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    var data = '';


                    $.each(res, function(index, val) {
                        data += '<option value="' + val.alamat + '">' + val.alamat + '</option>'
                    });

                    $('#query').append(data);
                }
            })
        }

        function changeNama() {
            // console.log(this.value);
            $.ajax({
                url: 'fnsearch.php',
                method: 'post',
                data: {
                    tipe: 'nama',
                    value: $('#query').val()
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    var data = '';

                    $('#resultquery').empty();

                    $.each(res, function(index, val) {
                        data += '<option value="' + val.id + '">' + val.nama + '</option>'
                    });

                    $('#resultquery').append(data);
                }
            })
        }

        function getUser() {
            $.ajax({
                url: 'fnsearch.php',
                method: 'post',
                data: {
                    tipe: 'getnama',
                    value: $('#resultquery').val()
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    console.log(res);
                    $('#detailnama').html('');
                    $('#detailalamat').html('');
                    $('#detailnama').html('Nama = ' + res.nama);
                    $('#detailalamat').html('Alamat = ' + res.alamat);
                }
            })
        }


        $(document).ready(function() {
            search();
            getAlamat();
            // $('#myTable').DataTable();
        });

        $(document).on('click', '.editbtn', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var alamat = $(this).data('alamat');
            var aktif = $(this).data('aktif');

            $('#data_id').val(id);
            $('#data_nama').val(nama);
            $('#data_alamat').val(alamat);
            $('#data_aktif').val(aktif);

            $('#editmodal').modal('show');

        });

        $(document).on('click', '.deletebtn', function() {
            console.log($(this).data('id'));

            if (confirm('Apakah anda ingin menghapus data ini?')) {
                $.ajax({
                    url: 'delete.php',
                    method: 'post',
                    data: {
                        id: $(this).data('id')
                    },
                    success: function(response) {
                        console.log(response);
                        search();
                        // window.location.reload();
                    }
                })
            }

        });

        function updateData() {
            var data = $('#editform').serialize();
            $.ajax({
                url: 'update.php',
                method: 'post',
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#editmodal').modal('hide');
                    search();
                    // window.location.reload();
                }
            })
        }
    </script>
</body>

</html>