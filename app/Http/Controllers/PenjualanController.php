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

    public function inputTest(Request $request)
    {
        return view('inputTest.index');
    }
    public function prosesInput(Request $request)
    {
        $satu = str_split($request->satu);
        $dua = str_split($request->dua);
        $intersect = array_intersect($satu,$dua);
        $hasil = (count($intersect)*100)/count($satu);
        return redirect()->back()->with('success',
        'Input 1 = '.$request->satu.', Input 2 = '.$request->dua.', Karakter '.implode($intersect).'('.count($intersect).' karakter) ditemukan di '.$request->dua.', presentase '.$hasil.'%');
        
    }

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
    public function transaksi(Request $request){
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangKeluar = penjualan::whereBetween('tanggal',[$start,$end])->orderBy('id','DESC')->get();
        return view('transaksi.index',compact('barangKeluar','start','end'));
    }
    public function transaksiCetak(Request $request){
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangKeluar = Penjualan::whereBetween('tanggal',[$start,$end])->get();
        $pdf=PDF::loadview('transaksi.cetak',compact('barangKeluar'))->setPaper('A4','portait');
        return $pdf->download('Riwayat Barang Keluar Van Trophy .pdf');
    }
}
