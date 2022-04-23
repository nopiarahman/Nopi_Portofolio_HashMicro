<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\barang;
use App\Models\Detail;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
class PenjualanController extends Controller
{
    public function index(Request $request){
        $baru = penjualan::firstOrCreate([
            'status'=>'open'
        ]);
        $barangKeluar = penjualan::orderBy('id','DESC')->first();
        $barangKeluar->update([
            'tanggal'=>Carbon::now()->isoFormat('YYYY-MM-DD'),
            'user_id'=>auth()->user()->id
        ]);
        $detail = Detail::where('penjualan_id',$barangKeluar->id)->get();
        return view('penjualan.index',compact('detail','barangKeluar'));        
    }
    public function detailSimpan(Request $request){
        $request->validate([
            'barang_id'   => 'required',
            'jumlah'   => 'required',
        ]);
        $barang=barang::find($request->barang_id);
        $barangKeluar = Penjualan::orderBy('id','DESC')->first();
        $requestData = $request->all();
        $requestData['total']=$barang->hargaJual*$request->jumlah;
        $requestData['penjualan_id']=$barangKeluar->id;
        if($request->jumlah > $barang->jumlah){
            return redirect()->route('penjualan')->with('error','Transaksi Gagal, Stok Barang '.$barang->nama.' Tidak Mencukupi, Sisa Stok = '.$barang->jumlah.' buah');
        }
        try {
            DB::beginTransaction();
            Detail::create($requestData);
            $barang->update(['jumlah'=>$barang->jumlah-$request->jumlah]);
            DB::commit();
            return redirect()->route('penjualan')->with('success','Data Berhasil Disimpan');
        } catch (\exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    public function selesaiTransaksi(){
        $barangKeluar = penjualan::orderBy('id','DESC')->first();
        try {
            DB::beginTransaction();
            $barangKeluar->update(['status'=>'closed']);
            DB::commit();
            return view('penjualan.struk',compact('barangKeluar'));
        } catch (\exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    public function keluarHapus(detail $id){
        $stokBarang=barang::find($id->barang_id);
        $stokBarang->update(['jumlah'=>$stokBarang->jumlah+$id->jumlah]);
        $id->delete();
        return redirect()->back()->with('sukses','Barang Berhasil Dihapus');
    }
}
