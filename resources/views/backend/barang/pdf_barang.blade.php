<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Barang</title>

        <style>
            table {
                width: 95%;
                border-collapse: collapse;
                margin: 50px auto;
            }

            /* Zebra striping */
            tr:nth-of-type(odd) {
                background: #eee;
            }

            th {
                background: #055fb4;
                color: white;
                font-weight: bold;
            }

            td,
            th {
                padding: 5px;
                border: 1px solid #ccc;
                text-align: left;
                font-size: 12px;
            }
        </style>

    </head>

    <body>

        <div style="width: 95%; margin: 0 auto;">
            <div style="float: left; margin-left:-17px;">
                <h4>Data Barang</h4>
            </div>
            <div style="float:right;margin-top:-10px;">
                <b>PT. SATRIA UTAMA GROUP</b>
            </div>
        </div>

        <table class="table table-responsive-sm" id="data-table-Pengerjaan" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Barang</th>
                    <th>No. Inventaris Peralatan</th>
                    <th>Lokasi Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tbl_barang as $j)
                    <tr data-id="{{$j->id_barang}}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$j->nama_barang}}</td>
                        <td>{{$j->No_inventaris_peralatan}}</td>
                        <td>{{$j->lokasi_barang}}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </body>
</html>
