<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/* traits Spatie Media Library */
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class barang extends Model implements HasMedia
{
    /* use Spatie Media Library */
    use InteractsWithMedia;
    use HasFactory;
    protected $table = "barang";
    protected $guarded = ['id','created_at','updated_at'];
}
