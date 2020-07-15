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
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{$message}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
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
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Data Guru</a></li>
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
            <h5 class="card-header">Data Guru SMK NEGERI 1 WONOSOBO</h5>
            <div class="card-body">
                <div id="custom-search" class="top-search-bar"
                    style="width:20%;float:left;margin-top:-1.5%;margin-bottom:2%">
                    <form action="/guru" method="GET">
                        <input class=" form-control" name="search" type="search" placeholder="Search..">
                    </form>
                </div>
                @if(Auth::user()->role == "2")
                <div class="top-search-bar" style="float:right;margin-top:-2%;margin-bottom:2%;margin-right:-1.5rem ">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Guru
                    </a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                                <form action="/guru/create-post" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="inputText3" class="col-form-label">Nama Guru</label>
                                            <input id="inputText3" name="nama" type="text" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputText2" class="col-form-label">Kode Guru</label>
                                            <input id="inputText2" name="kode" type="text" class="form-control"
                                                style="text-transform:uppercase" maxlegth="4"
                                                oninput="this.value = this.value.toUpperCase()" required>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                                <form action="/guru/create-post" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="inputText3" class="col-form-label">Nama Guru</label>
                                            <input id="inputText3" name="nama" type="text" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputText2" class="col-form-label">Kode Guru</label>
                                            <input id="inputText2" name="kode" type="text" class="form-control"
                                                style="text-transform:uppercase" maxlegth="4"
                                                oninput="this.value = this.value.toUpperCase()" required>
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
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kode</th>
                            @if(Auth::user()->role == "2")
                            <th scope="col" style="text-align:center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guru as $key => $gurus) <tr>
                            <th scope="row">{{$guru->firstItem()+$key}}</th>
                            <td>{{$gurus->nama}}</td>
                            <td>{{$gurus->kode}}</td>
                            @if(Auth::user()->role == "2")
                            <td style="width:120px">
                                <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-brand"><i
                                        class="fas fa-edit" style="color:white"></i>
                                </a>
                                <a href="/guru/{{$gurus->id}}/delete" class="btn btn-secondary"><i class="fas fa-trash"
                                        style="color:white"></i></a>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <th scope="row" rowspan="2" colspan="4" style="text-align:center">Data Guru Kosong</th>
                        </tr>
                        @endforelse
                    </tbody>
                </table><br>
                {{$guru->links()}}
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->

@endsection
