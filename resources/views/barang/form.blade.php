@extends('layouts.master')
@section('menuBarang', 'active')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container p-3">
                <form action="{{ route('barangSimpan') }}" method="POST" enctype="multipart/form-data">
                    <h3> <i class="fas fa-boxes    "></i> Tambah Data Barang</h3>
                    <hr>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6">
                            <label for="nama">Nama</label>
                            <input value="{{ old('nama') }}" name="nama" type="text" class="form-control bg-light my-2"
                                id="nama" required>
                            <label for="spesifikasi">Spesifikasi</label>
                            <input value="{{ old('spesifikasi') }}" name="spesifikasi" type="text"
                                class="form-control bg-light my-2" id="spesifikasi" required>
                            <label for="kategori">Kategori</label>
                            <input value="{{ old('kategori') }}" name="kategori" type="text"
                                class="form-control bg-light my-2" id="kategori">
                            <label for="hargaBeli">Harga Beli</label>
                            <input value="{{ old('hargaBeli') }}" name="hargaBeli" type="number"
                                class="form-control bg-light my-2" id="hargaBeli" required>
                            <label for="hargaJual">Harga Jual</label>
                            <input value="{{ old('hargaJual') }}" name="hargaJual" type="number"
                                class="form-control bg-light my-2" id="hargaJual" required>
                        </div>
                        <div class="col-6">
                            <label for="ukuran">Ukuran</label>
                            <input value="{{ old('ukuran') }}" name="ukuran" type="text"
                                class="form-control bg-light my-2" id="ukuran">
                            <label for="berat">Berat</label>
                            <input value="{{ old('berat') }}" name="berat" type="text" class="form-control bg-light my-2"
                                id="berat">
                            <label for="lokasi">Lokasi Barang</label>
                            <input value="{{ old('lokasi') }}" name="lokasi" type="text"
                                class="form-control bg-light my-2" id="lokasi">
                            <label for="foto">Foto Barang</label>
                            <input value="{{ old('foto') }}" name="foto" type="file" class="form-control bg-light my-2"
                                id="foto">
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                    <a class="btn btn-danger btn-sm" href="/barang" role="button"><i class="fas fa-undo"></i> BATAL</a>
            </div>
            </form>
        </div>
        </div>
    </section>
@endsection
