@extends('layouts.master')
@section('menuInput', 'active')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
            <x-alert />
            <div class="container p-3">
                <form action="{{ route('prosesInput') }}" method="POST" enctype="multipart/form-data">
                    <h3> <i class="fa fa-pencil" aria-hidden="true"></i> User Input Test</h3>
                    <hr>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6">
                            <label for="nama">Input 1</label>
                            <input value="{{ old('satu') }}" name="satu" type="text" class="form-control bg-light my-2"
                                id="satu" required>
                            <label for="dua">Input 2</label>
                            <input value="{{ old('dua') }}" name="dua" type="text" class="form-control bg-light my-2"
                                id="dua" required>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Kirim</button>
                    {{-- <a class="btn btn-danger btn-sm" href="/barang" role="button"><i class="fas fa-undo"></i> BATAL</a> --}}
            </div>
            </form>
        </div>
        </div>
    </section>
@endsection
