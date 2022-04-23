<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\barang;
class BarangController extends Controller
{
    public function index(){
        $barang = Barang::orderBy('nama')->paginate(20);
        return view('barang.index',compact('barang'));
    }
    public function create()
    {
        return view('barang.form');
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'nama'   => 'required',
                'hargaBeli'   => 'required|integer',
                'hargaJual'   => 'required|integer',
            ]);
            $requestData = $request->all();
            $barang = new Barang;
            $barang = Barang::create($requestData);
            if($request->hasFile('foto')){
                $barang
                ->addMediaFromRequest('foto')
                ->withResponsiveImages()
                ->toMediaCollection();
            }
            $barang->save();
            DB::commit();
        }  catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
        return redirect()->route('barang')->with('success','Data Berhasil Disimpan');
    }
    public function edit(Barang $id)
    {
        return view('barang.edit',compact('id'));
    }
    public function update(Request $request, Barang $id)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'nama'   => 'required',
                'hargaBeli'   => 'required|integer',
                'hargaJual'   => 'required|integer',
            ]);
            $requestData=$request->all();
            $id->update($requestData);
            if($request->hasFile('foto')){
                $id->clearMediaCollection();
                $id->addMediaFromRequest('foto')
                ->withResponsiveImages()
                ->toMediaCollection();
            }
            DB::commit();
            return redirect()->route('barang')->with('success','Barang Berhasil Disimpan');
        }  catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    public function destroy(Barang $id)
    {
        try {
            DB::beginTransaction();
            if($id->relation){
                return redirect()->back()->with('error','Gagal. Barang telah mempunyai order!');
            }
            $id->delete();
            DB::commit();
            return redirect()->back()->with('success','Barang Berhasil Dihapus');    
        }  catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
}
