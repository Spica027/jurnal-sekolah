<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            text-align: center;
        }

        th {
            padding: 1rem;
            background-color: teal;
            text-align: center;
        }
    </style>
</head>

<body>
    <table border="1" style="border-collapse:collapse">
        <thead>
            <tr>
                <th scope="col" style="width:10px">No</th>
                <th scope="col" style="width:10px">Kelas</th>
                <th scope="col" style="width:10px">Tanggal</th>
                <th scope="col" style="padding:5px;width:20px;font-size:10pt">Jam Pelajaran</th>
                <th scope="col" style="width:100px">Mapel</th>
                <th scope="col" style="width:100px">Guru</th>
                <th scope="col" style="width:100px">Materi</th>
                <th scope="col" style="width:100px">Keterangan</th>
                <th scope="col" style="width:100px">Absensi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i =1;
            @endphp
            @forelse ($jurnal as $jurnals) <tr>
                <td scope="row" style="font-weight:bold">{{$i}}</td>
                <td style="font-size:10pt;">{{$jurnals->kelas->kelas}}</td>
                <td style="font-size:10pt;">{{$jurnals->tanggal}}</td>
                <td style="font-size:10pt;">{{$jurnals->jam}}</td>
                <td style="font-size:10pt;">{{$jurnals->mapel->mapel}}</td>
                <td style="font-size:10pt;">{{$jurnals->guru->nama}}</td>
                <td style="font-size:10pt;text-align:left; padding:10px">{{$jurnals->materi}}</td>
                <td style="font-size:10pt;text-align:left; padding:10px">{{$jurnals->keterangan}}</td>
                <td style="font-size:10pt">
                    <table frame="void"
                        style="border:1px solid black; border-collapse:collapse;margin-left: -40px;margin: 3px;text-align: center;padding: 2px;">
                        @foreach ($jurnals->siswa as $jurnalx)
                        <tr>
                            <td
                                style="font-size:7pt;text-align:left;width:70px;border-bottom:1px solid black;padding:4px;">
                                <ul style="margin:0 0 0 10px;padding:0;vertical-align: middle;">
                                    <li>
                                        {{$jurnalx->nama}}
                                    </li>
                                </ul>
                            </td>
                            <td
                                style="font-size:8pt;width:10px;border-bottom:1px solid black;text-align:center;font-weight:bold">
                                {{substr($jurnalx->pivot->keterangan,0,1)}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @php
            $i++
            @endphp
            @empty
            <tr>
                <th scope="row" colspan="9" style="text-align:center">Jurnal Bulan
                    {{$month . " " . $year}} Kosong
                </th>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
