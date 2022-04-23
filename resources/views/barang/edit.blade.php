@extends('layouts.master')
@section('menuBarang', 'active')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
            <x-alert />
            <div class="container p-3">
                <h3> <i class="fas fa-boxes    "></i> Edit Barang {{ $id->nama }}</h3>
                <hr>
                <form action="{{ route('barangUpdate', ['id' => $id->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-6">
                            <label for="nama">Nama</label>
                            <input value="{{ $id->nama }}" name="nama" type="text" class="form-control bg-light my-2"
                                id="nama">
                            <label for="spesifikasi">Spesifikasi</label>
                            <input value="{{ $id->spesifikasi }}" name="spesifikasi" type="text"
                                class="form-control bg-light my-2" id="spesifikasi">
                            <label for="kategori">Kategori</label>
                            <input value="{{ $id->kategori }}" name="kategori" type="text"
                                class="form-control bg-light my-2" id="kategori">
                            <label for="hargaBeli">Harga Beli</label>
                            <input value="{{ $id->hargaBeli }}" name="hargaBeli" type="text"
                                class="form-control bg-light my-2" id="hargaBeli" required>
                            <label for="hargaJual">Harga Jual</label>
                            <input value="{{ $id->hargaJual }}" name="hargaJual" type="text"
                                class="form-control bg-light my-2" id="hargaJual" required>
                        </div>
                        <div class="col-6">
                            <label for="ukuran">Ukuran</label>
                            <input value="{{ $id->ukuran }}" name="ukuran" type="text" class="form-control bg-light my-2"
                                id="ukuran">
                            <label for="berat">Berat</label>
                            <input value="{{ $id->berat }}" name="berat" type="text" class="form-control bg-light my-2"
                                id="berat">
                            <label for="lokasi">Lokasi</label>
                            <input value="{{ $id->lokasi }}" name="lokasi" type="text" class="form-control bg-light my-2"
                                id="lokasi">
                            <label for="foto">Foto Barang</label>
                            @if ($id->foto)
                                <div style="">
                                    <img src="{{ $id->getFirstMediaUrl() }}" alt=""
                                        style="object-fit: cover;width: 150px; height:150px">
                                </div>
                            @else
                                <td> - </td>
                            @endif
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
