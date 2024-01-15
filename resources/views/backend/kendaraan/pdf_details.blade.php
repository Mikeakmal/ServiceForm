<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Pengerjaan Kendaraan</title>

        <style>
            /* General Table Styles */
            table.pengerjaan {
                width: 95%;
                border-collapse: collapse;
                margin: 10px auto;
            }
        
            table.kendaraan {
                width: 40%; 
            }
        
            table.kendaraan td, table.kendaraan th {
                padding: 3px; 
                font-size: 12px; 
            }
            
           
            table.pengerjaan {
                border: 1px solid #ccc; 
                background-color: white; 
                width: 100%;
            }
        
            table.pengerjaan th {
                color: white;
                font-weight: bold;
            }
        
            table.pengerjaan td, table.pengerjaan th {
                padding: 5px;
                border: 1px solid #ccc;
                font-size: 12px;
                color: black;
            }

            body {
                font-family: 'Open Sans', sans-serif;
            }
        </style>        
        
    </head>

    <body>
        <div style="width: 95%; margin: 0 auto;">
            <div style="float:right;margin-top:-10px;">
                <b>PT. SATRIA UTAMA GROUP </b>
            </div>
        </div>
        <div>
            <h4>Daftar Pengerjaan Kendaraan</h4>
        </div>
        <table class="table kendaraan">
            <tr>
                <td>Nomor Polisi</td>
                <td>: {{ $kendaraan->no_polisi }}</td>
            </tr>
            <tr>
                <td>Tanggal Masuk Bengkel</td>
                <td>: {{ $kendaraan->tanggal_masuk_bengkel }}</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>: {{ $kendaraan->tanggal_selesai }}</td>
            </tr>
        </table>

        <!-- Table Pengerjaan -->
        <table class="table table-responsive-sm pengerjaan" id="data-table-Pengerjaan">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Mekanik</th>
                    <th>Tanggal Dikerjakan</th>
                    <th>Sparepart</th>
                    <th>Keterangan Pengerjaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengerjaan as $j)
                    <tr data-id="{{$j->id_pengerjaan}}">
                        <td>{{ $loop->iteration }}</td>
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
