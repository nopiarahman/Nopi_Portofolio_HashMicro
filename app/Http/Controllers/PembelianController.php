<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pembelian;
use App\Models\barang;
use App\Models\supplier;
use Illuminate\Support\Facades\DB;
use PDF;
class PembelianController extends Controller
{
    public function index(Request $request){
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangMasuk = Pembelian::whereBetween('tanggalMasuk',[$start,$end])->get();
        return view('pembelian.index',compact('barangMasuk','start','end'));        
    }
    public function cari(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = barang::select('id', 'nama')->where('nama', 'LIKE', '%'.$cari.'%')
                                                ->get();
            return response()->json($data);
        }
    }
    public function cariSupplier(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = supplier::select('id', 'nama')->where('nama', 'LIKE', '%'.$cari.'%')
                                               ->get();

            return response()->json($data);
        }   
    }
    public function store(Request $request){
        $request->validate([
            'barang_id'   => 'required',
            'supplier_id'   => 'required',
            'tanggalMasuk'   => 'required',
            'jumlah'   => 'required',
        ]);
        $requestData = $request->all();
        try {
            DB::beginTransaction();
            Pembelian::create($requestData);
            $barang=barang::find($request->barang_id);
            $barang->update(['jumlah'=>$barang->jumlah+$request->jumlah]);
            DB::commit();
            return redirect()->route('masuk')->with('success','Data Berhasil Disimpan');
        } catch (\exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    public function pembelianCetak(Request $request){
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangMasuk = pembelian::whereBetween('tanggalMasuk',[$start,$end])->get();
        $pdf=PDF::loadview('pembelian.cetak',compact('barangMasuk'))->setPaper('A4','portait');
        return $pdf->download('Riwayat Barang Masuk .pdf');
    }
}
