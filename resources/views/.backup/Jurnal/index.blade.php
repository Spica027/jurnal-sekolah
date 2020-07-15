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
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{$message}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                @endif
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
                <div class="top-search-bar" style="float:right;margin-top:-2%;margin-bottom:2%;margin-right:-1.5rem ">
                    @if ($jam == "home")
                    <div class="btn btn-danger" data-toggle="modal" style="cursor:not-allowed;">
                        Pulang Ke Rumah
                    </div>
                    @elseif($jam == "break")
                    <div class="btn btn-danger" data-toggle="modal" style="cursor:not-allowed;">
                        Istirahat
                    </div>
                    @else
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Jurnal
                    </a>
                    @endif
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jurnal</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="/jurnal/create-post" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Mapel</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <select class="form-control" id="input-select" name="mapel">
                                                    @foreach ($mpl as $mapels)
                                                    <option value="{{$mapels->id}}">{{$mapels->mapel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Guru</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <select class="form-control" id="input-select" name="guru">
                                                    @foreach ($gr as $gurus)
                                                    <option value="{{$gurus->id}}">{{$gurus->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right"
                                                for="exampleFormControlTextarea1">Materi</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="materi"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right"
                                                for="exampleFormControlTextarea1">Keterangan</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="keterangan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"
                                                class="col-form-label">Absensi</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="absensi"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-secondary">Reset</a>
                                                <button type="submit" class="btn btn-primary">Tambah</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jurnal</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    @foreach ($jurnal as $jurnals)
                                    <form action="/jurnal/{{$jurnals->id}}/edit-post" method="POST">
                                        @endforeach
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Mapel</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <select class="form-control" id="input-select" name="mapel">
                                                    @foreach ($mpl as $mapels)
                                                    <option value="{{$mapels->id}}">{{$mapels->mapel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Guru</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <select class="form-control" id="input-select" name="guru">
                                                    @foreach ($gr as $gurus)
                                                    <option value="{{$gurus->id}}">{{$gurus->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right"
                                                for="exampleFormControlTextarea1">Materi</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="materi"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right"
                                                for="exampleFormControlTextarea1">Keterangan</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="keterangan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"
                                                class="col-form-label">Absensi</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="absensi"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-secondary">Reset</a>
                                                <button type="submit" class="btn btn-primary">Edit</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam Ke-</th>
                            <th scope="col">Mapel</th>
                            <th scope="col">Guru</th>
                            <th scope="col">Materi</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Absensi</th>
                            <th scope="col" style="text-align:center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1;
                        @endphp
                        @forelse ($jurnal as $jurnals) <tr>
                            <th scope="row">{{$i}}</th>
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
                            <td style="width:120px">
                                <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-brand"><i
                                        class="fas fa-edit" style="color:white"></i>
                                </a>
                                <a href="/jurnal/{{$jurnals->id}}/delete" class="btn btn-secondary"><i
                                        class="fas fa-trash" style="color:white"></i></a>
                            </td>
                        </tr>
                        @php
                        $i++
                        @endphp
                        @empty
                        <tr>
                            <th scope="row" rowspan="2" colspan="9" style="text-align:center">Jurnal Hari Ini Kosong
                            </th>
                        </tr>
                        @endforelse
                    </tbody>
                </table><br>
                <div class="keterangan" style="float:right;">
                    <p style="margin-right:100px">Keterangan :</p>
                    <div style=" margin-top:-15px;margin-left:100px;">
                        <div class="ket">
                            <div class="ket-color"
                                style="width:10px;height:10px;background-color:#DA0419;display:inline-block">
                            </div>
                            <div class="ket-nama" style="display:inline-block;margin-left:10%">Sakit</div>
                        </div>
                        <div class="ket">
                            <div class="ket-color"
                                style="width:10px;height:10px;background-color:#F3B600;display:inline-block">
                            </div>
                            <div class="ket-nama" style="display:inline-block;margin-left:10%">Ijin</div>
                        </div>
                        <div class="ket">
                            <div class="ket-color"
                                style="width:10px;height:10px;background-color:#17C0DC;display:inline-block">
                            </div>
                            <div class="ket-nama" style="display:inline-block;margin-left:10%">Alpha</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->

@endsection
