<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;
use App\Models\barang;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(){
        $supplier = supplier::latest()->get();
        $label = barang::select('nama')->get()->toArray();
        // dd($label);
        return view('supplier.index',compact('supplier'));
    }
    public function create(){
        return view('supplier.form');
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'nama'   => 'required',
                'alamat'   => 'required',
                'telepon'   => 'required',
            ]);
            $requestData = $request->all();
            supplier::create($requestData);
            DB::commit();
            return redirect()->route('supplier')->with('success','Data Berhasil Disimpan');
        }  catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
        return redirect()->route('supplier')->with('success','Data Berhasil Disimpan');
    }
    public function edit(supplier $id){
        return view('supplier.edit',compact('id'));        
    }
    public function update(Request $request, supplier $id){
        $request->validate([
            'nama'   => 'required',
            'alamat'   => 'required',
            'telepon'   => 'required',
        ]);
        $requestData = $request->all();
        $id->update($requestData);
        return redirect()->route('supplier')->with('success','Data Berhasil Dirubah');
    }
    public function destroy(supplier $id){
        $id->delete();
        return redirect()->route('supplier')->with('sukses','Data Berhasil Dihapus');
    }
}
