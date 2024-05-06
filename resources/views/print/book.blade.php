<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print data Buku</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

    <style>
        @font-face {
            font-family: Lato-Regular;
            src: url(../fonts/Lato/Lato-Regular.ttf)
        }

        @font-face {
            font-family: Lato-Bold;
            src: url(../fonts/Lato/Lato-Bold.ttf)
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body,
        html {
            height: 100%;
            font-family: sans-serif
        }

        a {
            margin: 0;
            transition: all .4s;
            -webkit-transition: all .4s;
            -o-transition: all .4s;
            -moz-transition: all .4s
        }

        a:focus {
            outline: none!important
        }

        a:hover {
            text-decoration: none
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0
        }

        p {
            margin: 0
        }

        table{
            border-collapse: collapse;
            margin: auto
        }

        .container-table100 {
            width: 100%;
            min-height: 100vh;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            padding: 10px
        }

        .table100 {
            background-color: #fff
        }

        th,
        td {
            font-weight: unset;
        }

        .table100-head th {
            padding-top: 8px;
            padding-bottom: 8px
        }

        .table100-body td {
            padding-top: 6px;
            padding-bottom: 6px
        }

        .table100.ver1 th {
            font-family: Lato-Bold;
            font-size: 18px;
            color: #fff;
            line-height: 1.4;
            background-color: #6c7ae0
        }

        .table100.ver1 td {
            font-family: Lato-Regular;
            font-size: 15px;
            color: gray;
            line-height: 1.4
        }

        .text-center{
            text-align: center
        }
        .longText{
            max-width: 50%;
        }

        tr th{
            padding: 0 50px
        }
        tr th:first-child{
            border-top-left-radius: 5px
        }
        tr th:last-child{
            border-top-right-radius: 5px
        }
        .cell100{
            padding: 8px 3px !important
        }
        tr:nth-child(even){
            background-color: #dddddd;
        }
    </style>
    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Kategori Buku</th>
                                <th>Penerbit Buku</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr class="row100 body">
                                    <td class="cell100 column1 longText">{{ $item->title }}</td>
                                    <td class="cell100 column2 text-center">{{ $item->category }}</td>
                                    <td class="cell100 column3">{{ $item->publisher }}</td>
                                    <td class="cell100 column4 text-center">{{ $item->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr class="row100 body">
                                    <td rowspan="4" class="cell100 column1 text-center">Belum ada buku...</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
