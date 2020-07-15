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
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Data siswa</a></li>
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
            <h5 class="card-header">Data Siswa SMK NEGERI 1 WONOSOBO</h5>
            <div class="card-body">
                @if (Auth::user()->role == 1)
                <h2>SISWA KELAS {{$kls->kelas}}</h2>
                @endif
                <div id="custom-search" class="top-search-bar"
                    style="width:20%;float:left;margin-top:-1.5%;margin-bottom:2%">
                    @if(Auth::user()->role == "2")
                    <form action="{{\Request::url()}}" method="GET">
                        <input class=" form-control" name="search" type="search" placeholder="Search..">
                    </form>
                    @endif
                </div>

                @if(Auth::user()->role == "2")
                <div class="top-search-bar" style="float:right;margin-top:-2%;margin-bottom:2%;margin-right:-1.5rem ">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah siswa
                    </a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                                <form action="/siswa/create-post" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="inputText3" class="col-form-label">Nama siswa</label>
                                            <input id="inputText3" name="nama" type="text" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-select">Kelas</label>
                                            <select class="form-control" id="input-select" name="kelas_id">
                                                @foreach ($cls as $kelass)
                                                <option value="{{$kelass->id}}">{{$kelass->kelas}}</option>
                                                @endforeach
                                            </select>
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
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                                @foreach ($siswa as $siswas)
                                <form action="/siswa/{{$siswas->id}}/edit-post" method="POST">
                                    @endforeach
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="inputText3" class="col-form-label">Nama siswa</label>
                                            <input id="inputText3" name="nama" type="text" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-select">Kelas</label>
                                            <select class="form-control" id="input-select" name="kelas_id">
                                                @foreach ($cls as $kelass)
                                                <option value="{{$kelass->id}}">{{$kelass->kelas}}</option>
                                                @endforeach
                                            </select>
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
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            @if(Auth::user()->role == "2")
                            <th scope="col" style="text-align:center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $key => $siswas) <tr>
                            <th scope="row">{{$siswa->firstItem()+$key}}</th>
                            <td>{{$siswas->nama}}</td>
                            <td>{{$siswas->kelas->kelas}}</td>
                            @if(Auth::user()->role == "2")
                            <td style="width:120px">
                                <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-brand"><i
                                        class="fas fa-edit" style="color:white"></i>
                                </a>
                                <a href="/siswa/{{$siswas->id}}/delete" class="btn btn-secondary"><i
                                        class="fas fa-trash" style="color:white"></i></a>
                            </td>
                            @endif
                        </tr>
                        @empty
                        @if (\Request::has('search'))
                        <tr>
                            <th scope="row" rowspan="2" colspan="4" style="text-align:center">Data Siswa Bernama
                                {{$src}} Kosong</th>
                        </tr>
                        @else
                        <tr>
                            <th scope="row" rowspan="2" colspan="4" style="text-align:center">Data Siswa Kosong</th>
                        </tr>
                        @endif
                        @endforelse
                    </tbody>
                </table><br>
                {{$siswa->links()}}
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->

@endsection
