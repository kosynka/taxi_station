<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>admin panel</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="manifest" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/safari-pinned-tab.svg"
        color="#712cf9">
    <link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> 

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>

<body>
    @include('app.header')

    <div class="container-fluid">
        <div class="row">
            @include('app.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @if(session()->has('success'))
                    <div class="mt-1 alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @foreach($errors->all() as $error)
                    <div class="mt-1 alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ошибка</strong> {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
        crossorigin="anonymous"></script>

    <script>
        function clicked(e) {
            if (!confirm('Вы уверены?')) {
                e.preventDefault();
            }
        }

        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    var text = $(this).text().toLowerCase();
                    var index = text.indexOf(value);
                    $(this).toggle(index > -1);
                });
            });

            $("#penalty-search-input").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#penalty-search-table tr").filter(function () {
                    var text = $(this).text().toLowerCase();
                    var index = text.indexOf(value);
                    $(this).toggle(index > -1);
                });
            });

            $("#rent-search-input").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#rent-search-table tr").filter(function () {
                    var text = $(this).text().toLowerCase();
                    var index = text.indexOf(value);
                    $(this).toggle(index > -1);
                });
            });

            $("#oilchange-search-input").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#oilchange-search-table tr").filter(function () {
                    var text = $(this).text().toLowerCase();
                    var index = text.indexOf(value);
                    $(this).toggle(index > -1);
                });
            });

            $("#history-search-input").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#history-search-table tr").filter(function () {
                    var text = $(this).text().toLowerCase();
                    var index = text.indexOf(value);
                    $(this).toggle(index > -1);
                });
            });
        });

        @if(auth()->user()->role === 'admin')
            function download_table_as_excel(table_id, separator = ',', file_name = 'export') {
                $('#' + table_id).table2excel({
                    exclude: ".no-export",
                    filename: "download.xls",
                    fileext: ".xls",
                    exclude_links: true,
                    exclude_inputs: true
                });
            }

            function download_table_as_csv(table_id, separator = ',', file_name = 'export') {
                var rows = document.querySelectorAll('table#' + table_id + ' tr');
                var csv = [];

                for (var i = 0; i < rows.length; i++) {
                    var row = [], cols = rows[i].querySelectorAll('td, th');
                    for (var j = 0; j < cols.length; j++) {
                        var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
                        data = data.replace(/"/g, '""');
                        row.push('"' + data + '"');
                    }
                    csv.push(row.join(separator));
                }

                var csv_string = csv.join('\n');

                var filename = file_name + ' ' + new Date().toLocaleDateString() + '.csv';
                var link = document.createElement('a');
                link.style.display = 'none';
                link.setAttribute('target', '_blank');
                link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
                link.setAttribute('download', filename);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        @endif
    </script>
</body>

</html>
