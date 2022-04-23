@extends('layouts.master')
@section('menuBarang', 'active')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
            <x-alert />
            <div class="container p-3">
                <h3> <i class="fas fa-boxes    "></i> Edit Supplier {{ $id->nama }}</h3>
                <hr>
                <form action="{{ route('supplierUpdate', ['id' => $id->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-6">
                            <label for="nama">Nama</label>
                            <input value="{{ $id->nama }}" name="nama" type="text" class="form-control bg-light"
                                id="nama">
                            <label for="alamat">Alamat</label>
                            <input value="{{ $id->alamat }}" name="alamat" type="text" class="form-control bg-light"
                                id="alamat" required>
                            <label for="telepon">Telepon</label>
                            <input value="{{ $id->telepon }}" name="telepon" type="text" class="form-control bg-light"
                                id="telepon" required>

                        </div>
                        <div class="col-6">
                            <label for="kota">Kota</label>
                            <input value="{{ $id->kota }}" name="kota" type="text" class="form-control bg-light"
                                id="kota">
                            <label for="Keterangan">Keterangan</label>
                            <input value="{{ $id->keterangan }}" name="keterangan" type="text"
                                class="form-control bg-light" id="keterangan">
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
