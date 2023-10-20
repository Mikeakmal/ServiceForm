<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Kendaraan</title>

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
                <h4>Data Kendaraan</h4>
            </div>
            <div style="float:right;margin-top:-10px;">
                <b>PT. SATRIA UTAMA GROUP </b>
            </div>
        </div>

        <table class="table table-responsive-sm" id="data-table-Pengerjaan" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Polisi</th>
                    <th>Tanggal Masuk Bengkel</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tbl_kendaraan as $j)
                    <tr data-id="{{$j->id_kendaraan}}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$j->no_polisi}}</td>
                        <td>{{$j->tanggal_masuk_bengkel}}</td>
                        <td>{{$j->tanggal_selesai}}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </body>
</html>
