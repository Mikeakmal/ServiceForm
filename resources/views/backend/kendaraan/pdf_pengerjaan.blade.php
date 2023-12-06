<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Pengerjaan</title>

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
                background:  #e2b34c;
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
                color: black; /* Warna teks hitam */
            }
        </style>

    </head>

    <body>

        <div style="width: 95%; margin: 0 auto;">
            <div style="float: left; margin-left:-17px;">
                <h4>Daftar Pengerjaan</h4>
            </div>
            <div style="float:right;margin-top:-10px;">
                <b>PT. SATRIA UTAMA GROUP </b>
            </div>
        </div>

        <table class="table table-responsive-sm" id="data-table-Pengerjaan" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Polisi</th>
                    <th>Nama Mekanik</th>
                    <th>Tanggal Dikerjakan</th>
                    <th>Sparepart</th>
                    <th>Keterangan Pengerjaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tbl_pengerjaan as $j)
                    <tr data-id="{{$j->id_pengerjaan}}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $nopolis[$j->id_kendaraan] }}</td>
                        <td>{{$j->nama_mekanik}}</td>
                        <td>{{$j->tanggal_dikerjakan}}</td>
                        <td>{{$j->sparepart}}</td>
                        <td>{{$j->keterangan_pengerjaan}}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </body>
</html>
