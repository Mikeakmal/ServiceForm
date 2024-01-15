<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Kendaraan</title>

        <style>
            table {
                width: 95%;
                border-collapse: collapse;
                margin: 50px auto;
            }

            /* Zebra striping */
            tr:nth-of-type(odd) {
                background: #ffffff;
            }

            th {
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

            th, td {
                color: black; 
            }

            .on-progress-text {
                color: red; 
            }
            
            .finish-text {
                color: #008000; 
            }

            body {
                font-family: 'Open Sans', sans-serif;
            }
        </style>

    </head>

    <body>

        <div style="width: 95%; margin: 0 auto;">
            <div style="float: left; margin-left:-17px;">
                <h4>Daftar Kendaraan</h4>
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tbl_kendaraan as $j)
                    <tr data-id="{{$j->id_kendaraan}}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$j->no_polisi}}</td>
                        <td>{{$j->tanggal_masuk_bengkel}}</td>
                        <td>{{$j->tanggal_selesai}}</td>
                        <td class="status-selected @if ($j->tanggal_selesai === null) on-progress-text @else finish-text @endif">
                            {{ $j->tanggal_selesai === null ? 'ON PROGRESS' : 'FINISH' }}
                        </td> 
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </body>
</html>
