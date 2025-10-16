<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $guarded;

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
