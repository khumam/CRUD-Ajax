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
    <div class="container my-5">
        <h1 class="text-center">Search</h1>
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
                <!-- <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Aktif</th>
                    </thead>
                    <tbody id="databody"></tbody>
                </table> -->
                <div class="row" id="databody">
                </div>
            </div>
        </div>
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
                        // data += '<tr><td>' + (index + 1) + '</td><td>' + val.nama + '</td><td>' + val.alamat + '</td><td>' + val.aktif + '</td></tr>';

                        data += '<div class="col-3"><div class="card"><div class="card-body">' + val.nama + '</div></div></div>';
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


        $(document).ready(function() {
            search();
        });
    </script>
</body>

</html>