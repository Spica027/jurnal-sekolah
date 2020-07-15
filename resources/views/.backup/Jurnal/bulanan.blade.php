@extends('Template.xxx');
@section('content')

<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row" style="margin-top:-3rem">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">SMK NEGERI 1 WONOSOBO</h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce
                        sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Data Jurnal</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="card">
            <div class="card-body">
                <div id="custom-search" class="top-search-bar"
                    style="width:20%;float:left;margin-top:-1.5%;margin-bottom:2%">
                    <form action="{{\Request::url()}}" method="GET">
                        <input class=" form-control" name="search" type="month" value="{{$dt}}">
                        <button type="submit" class="btn btn-block">Submit</button>
                    </form>
                    <a href="{{"/jurnal/print/".$dt}}">
                        <button type="submit" class="btn btn-warning">Print PDF</button>
                    </a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            @if (Auth::user()->role==2)
                            <th scope="col">Kelas</th>
                            @endif
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam Ke-</th>
                            <th scope="col">Mapel</th>
                            <th scope="col">Guru</th>
                            <th scope="col">Materi</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1;
                        @endphp
                        @forelse ($jurnal as $jurnals) <tr>
                            <th scope="row">{{$i}}</th>
                            @if (Auth::user()->role==2)
                            <td>{{$jurnals->kelas->kelas}}</td>
                            @endif
                            <td>{{$jurnals->tanggal}}</td>
                            <td>{{$jurnals->jam}}</td>
                            <td>{{$jurnals->mapel->mapel}}</td>
                            <td>{{$jurnals->guru->nama}}</td>
                            <td>{{$jurnals->materi}}</td>
                            <td>{{$jurnals->keterangan}}</td>
                            <td style="font-size:10pt">
                                @foreach ($jurnals->siswa as $jurnalx)
                                @if ($jurnalx->pivot->keterangan == "Sakit")
                                <li class="text-danger">{{$jurnalx->nama}}</li>
                                @endif
                                @if ($jurnalx->pivot->keterangan == "Ijin")
                                <li class="text-warning">{{$jurnalx->nama}}</li>
                                @endif
                                @if ($jurnalx->pivot->keterangan == "Alpha")
                                <li class="text-info">{{$jurnalx->nama}}</li>
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        @php
                        $i++
                        @endphp
                        @empty
                        @if (\Request::has('search'))
                        <tr>
                            <th scope="row" rowspan="2" colspan="9" style="text-align:center">Jurnal Bulan
                                {{$month . " " . $year}} Kosong
                            </th>
                        </tr>
                        @else
                        <tr>
                            <th scope="row" rowspan="2" colspan="9" style="text-align:center">Jurnal Bulan
                                Jurnal Kosong
                            </th>
                        </tr>
                        @endif
                        @endforelse
                    </tbody>
                </table><br>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->

@endsection
