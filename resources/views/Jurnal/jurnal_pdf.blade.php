<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        table tr th {
            font-size: 12pt;
            background: #00B9DA;
            color: #fff;
        }

        table tr td {
            font-size: 10pt;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgba(0, 0, 0, 0.075);
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }

        .kosong {
            font-weight: 600;
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body>
    @if ($kelas == "All")
    @foreach ($jurnal as $kelas => $jurnales)
    @php
    $hehe = $cls->where('id','=',$kelas)
    @endphp
    @foreach ($hehe as $hehes)
    <h3>
        {{$hehes->kelas}}
    </h3>
    @endforeach
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col" width="2%">No.</th>
                <th scope="col" width="8%">Kelas</th>
                <th scope="col" width="10%">Tanggal</th>
                <th scope="col" width="5%">Jam</th>
                <th scope="col" width="15%">Mapel</th>
                <th scope="col" width="15%">Guru</th>
                <th scope="col" width="10%">Materi</th>
                <th scope="col" width="10%">Keterangan</th>
                <th scope="col" width="25%">Absensi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp

            @forelse($jurnales as $jurnals)
            <tr>
                <td class="text-center">{{ $i }}</td>
                <td class="text-center">{{ $jurnals->kelas->kelas }}</td>
                <td class="text-center">{{ $jurnals->tanggal }}</td>
                <td class="text-center">{{ $jurnals->jam }}</td>
                <td class="text-left">{{ $jurnals->mapel->mapel }}</td>
                <td class="text-left">{{ $jurnals->guru->nama }}</td>
                <td class="text-left">{{ $jurnals->materi }}</td>
                <td class="text-left">
                    @empty($jurnals->keterangan)
                    <div class="text-center"> - </div>
                    @endempty
                    {{ $jurnals->keterangan }}
                </td>
                <td>
                    <table class="table" style="margin-bottom: 0; font-family: 'Open Sans', sans-serif;">
                        @forelse($jurnals->siswa as $jurnalx)
                        <tr>
                            <td class="text-left" style="font-size: 8pt">{{ $jurnalx->nama }}</td>
                            @if($jurnalx->pivot->keterangan == 'Sakit')
                            <td class="text-center" style="background: #f5c6cb; color: #dc3545; font-weight: 600">
                                {{ substr($jurnalx->pivot->keterangan, 0, 1) }}
                            </td>
                            @elseif($jurnalx->pivot->keterangan == 'Ijin')
                            <td class="text-center" style="background: #ffeeba; color: #ffc107; font-weight: 600">
                                {{ substr($jurnalx->pivot->keterangan, 0, 1) }}
                            </td>
                            @elseif($jurnalx->pivot->keterangan == 'Alpha')
                            <td class="text-center" style="background: #b8daff; color: #007bff; font-weight: 600">
                                {{ substr($jurnalx->pivot->keterangan, 0, 1) }}
                            </td>
                            @endif
                        </tr>
                        @empty
                        <div class="text-center" style="display: table-cell; vertical-align: middle;"> - </div>
                        @endforelse
                    </table>
                </td>
            </tr>
            @php
            $i++
            @endphp
            @empty
            <tr>
                <td scope="row" class="kosong text-center" colspan="9">
                    Jurnal Bulan {{ $month." ".$year }} Kosong
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if (!($loop->last))
    <div style="page-break-after: always;"></div>
    @endif

    @endforeach

    @else
    <h3>
        {{$kelas}}
    </h3>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col" width="2%">No.</th>
                <th scope="col" width="8%">Kelas</th>
                <th scope="col" width="10%">Tanggal</th>
                <th scope="col" width="5%">Jam</th>
                <th scope="col" width="15%">Mapel</th>
                <th scope="col" width="15%">Guru</th>
                <th scope="col" width="10%">Materi</th>
                <th scope="col" width="10%">Keterangan</th>
                <th scope="col" width="25%">Absensi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp

            @forelse($jurnal as $jurnals)
            <tr>
                <td class="text-center">{{ $i }}</td>
                <td class="text-center">{{ $jurnals->kelas->kelas }}</td>
                <td class="text-center">{{ $jurnals->tanggal }}</td>
                <td class="text-center">{{ $jurnals->jam }}</td>
                <td class="text-left">{{ $jurnals->mapel->mapel }}</td>
                <td class="text-left">{{ $jurnals->guru->nama }}</td>
                <td class="text-left">{{ $jurnals->materi }}</td>
                <td class="text-left">
                    @empty($jurnals->keterangan)
                    <div class="text-center"> - </div>
                    @endempty
                    {{ $jurnals->keterangan }}
                </td>
                <td>
                    <table class="table" style="margin-bottom: 0; font-family: 'Open Sans', sans-serif;">
                        @forelse($jurnals->siswa as $jurnalx)
                        <tr>
                            <td class="text-left" style="font-size: 8pt">{{ $jurnalx->nama }}</td>
                            @if($jurnalx->pivot->keterangan == 'Sakit')
                            <td class="text-center" style="background: #f5c6cb; color: #dc3545; font-weight: 600">
                                {{ substr($jurnalx->pivot->keterangan, 0, 1) }}
                            </td>
                            @elseif($jurnalx->pivot->keterangan == 'Ijin')
                            <td class="text-center" style="background: #ffeeba; color: #ffc107; font-weight: 600">
                                {{ substr($jurnalx->pivot->keterangan, 0, 1) }}
                            </td>
                            @elseif($jurnalx->pivot->keterangan == 'Alpha')
                            <td class="text-center" style="background: #b8daff; color: #007bff; font-weight: 600">
                                {{ substr($jurnalx->pivot->keterangan, 0, 1) }}
                            </td>
                            @endif
                        </tr>
                        @empty
                        <div class="text-center" style="display: table-cell; vertical-align: middle;"> - </div>
                        @endforelse
                    </table>
                </td>
            </tr>
            @php
            $i++
            @endphp
            @empty
            <tr>
                <td scope="row" class="kosong text-center" colspan="9">
                    <h3>
                        Jurnal Bulan {{ $month." ".$year }} Kosong
                    </h3>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endif
</body>

</html>
