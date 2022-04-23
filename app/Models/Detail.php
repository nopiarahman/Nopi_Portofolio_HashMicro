<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = "detail";
    protected $guarded = ['id','created_at','updated_at'];

    /**
     * Get the barang associated with the penjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
    /**
     * Get the keluarBarang that owns the penjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penjualan()
    {
        return $this->belongsTo(penjualan::class);
    }
}
