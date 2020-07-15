@extends('Template.template')

@section('title')
Data Siswa | Journal
@endsection
@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="header">
        @if (Auth::user()->role == 1)
        <h3>SISWA KELAS {{$kls->kelas}}</h3>
        @endif
        @if(Auth::user()->role == "2")
        <h3>Data Siswa</h3>
        <form action="{{\Request::url()}}" method="GET">
            <div class="form-group">
                <input type="text" class="search" name="search" placeholder="Mau Cari Siapa?"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mau Cari Siapa?'" />
                <button type="submit" class="btn caris">
                    <i class="fas fa-search"></i>
                </button>
                <button type="button" class="btn tambah" data-toggle="modal" data-target="#modalscrollable">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </form>
        @endif
    </div>

    <!-- Content -->
    <div class="konten">
        <!-- Filter Kelas -->
        @if(Auth::user()->role == "2")
        <select
            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value="">Pilih Kelas</option>
            @forelse ($cls as $kelas)
            <option value="{{$kelas->id}}">{{$kelas->kelas}}</option>
            @empty
            <option value="">Belum Ada Kelas Terdaftar</option>
            @endforelse
        </select>
        @endif
        @forelse ($siswa as $key => $siswas)
        <div class="list">
            <div class="item">

                @if (Auth::user()->role == "2")
                <a class="item-swipe" href="#"> {{$siswas->id}}. {{$siswas->nama}}</a>
                <div class="item-back">
                    <button class="action second btn-edit" type="button">
                        <a href="{{$siswas->id}}/edit">
                            <span class="material-icons">edit</span>
                        </a>
                    </button>
                    <button class="action first btn-delete" type="button">
                        <a href="{{$siswas->id}}/delete">
                            <span class="material-icons">delete</span>
                        </a>
                    </button>
                </div>
                @else
                <a class="item-swipex" href="#"> {{$siswas->id}}. {{$siswas->nama}}</a>
                @endif
            </div>
        </div>
        @empty
        @if (\Request::has('search'))
        <div class="list">
            <div class="item">
                <a class="item-swipex" href="#">
                    <center>
                        Data Siswa Bernama <u>{{$src}}</u> Tidak Ditemukan
                    </center>
                </a>
            </div>
        </div>
        @else
        <div class="list">
            <div class="item">
                <a class="item-swipex" href="#">
                    <center>
                        Data Siswa Kosong
                    </center>
                </a>
            </div>
        </div>
        @endif
        @endforelse
        {{$siswa->links()}}
    </div>


    <!-- Modal Section -->
    <div class="modal fade mod1" id="modalscrollable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" width="100%">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Tambah Data Siswa.
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-box">
                        <form action="/siswa/create-post" method="post" class="form-horizontal needs-validation"
                            novalidate>
                            @csrf
                            <div class="form-group col-md-12">
                                <label>Nama Siswa</label>
                                <input type="text" class="form-control" name="nama" autocomplete="off" required>
                                <div class="invalid-feedback">Nama Siswa Tidak Boleh Kosong.</div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Kelas</label>
                                <select class="kelas-select" name="kelas_id">
                                    @forelse ($cls as $kelas)
                                    <option value="{{$kelas->id}}">{{$kelas->kelas}}</option>
                                    @empty
                                    <option value="">Belum Ada Kelas Terdaftar</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="bottom-button">
                                <input type="reset" class="btn btn-danger" id="danger">
                                <button type="submit" name="signup" class="btn btn-success">
                                    Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade mod2" id="modalfade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" width="100%">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Pilih Data
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="konten-data mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <a class="isi-data" href="/siswa">
                                        <i class="fas fa-user-graduate mb-3"></i>
                                        <span>Data Siswa</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <a class="isi-data" href="/guru">
                                        <i class="fas fa-user-tie mb-3"></i>
                                        <span>Data Guru</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
