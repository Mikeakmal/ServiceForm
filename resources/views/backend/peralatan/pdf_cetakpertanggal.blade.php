<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Peralatan Rusak</title>

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
                <h4>Daftar Peralatan Rusak</h4>
            </div>
            <div style="float:right;margin-top:-10px;">
                <b>PT. SATRIA UTAMA GROUP</b>
            </div>
        </div>
        <table class="table table-responsive-sm" id="data-table-peralatan" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Merek</th>
                    <th>No. Inventaris Peralatan</th>
                    <th>Nama Karyawan</th>
                    <th>Alat Rusak</th>
                    <th>Tanggal Diperbaiki</th>
                    <th>Teknisi</th>
                    <th>Kondisi</th>
                    <th>Diperbarui </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tbl_peralatan as $j) 
                    <tr data-id="{{$j->id_peralatan}}" data-id_barang="{{$j->id_barang}}">
                        <td>{{ $loop->iteration }}</td>
                        <td >{{$j->merek}}</td>
                        <td >{{ $noinventaris[$j->id_barang] }}</td>
                        <td >{{$j->nama_karyawan}}</td>
                        <td >{{$j->alat_rusak}}</td>
                        <td >{{$j->tanggal_diperbaiki}}</td>
                        <td >{{$j->nama_teknisi}}</td>
                        <td >{{ $kondisi[$j->id_barang] }}</td>
                        <td >{{$j->updated_at}}</td>
                    </tr>
                @endforeach             
            </tbody>
        </table>
    </body>
</html>
