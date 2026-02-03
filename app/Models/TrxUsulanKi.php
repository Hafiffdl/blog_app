<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxUsulanKi extends Model
{
    use HasFactory;

    protected $table = 'trx_usulan_ki';

    protected $fillable = [
        'user_id',
        'mst_ki_id',
        'judul',
        'tanggal',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mstKi()
    {
        return $this->belongsTo(MstKi::class, 'mst_ki_id');
    }
}
