<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Whoops\Run;

class Barang extends Model
{
    protected $table = 'barang';
    protected $guarded;

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }


}
