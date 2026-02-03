<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstSyaratKi extends Model
{
    use HasFactory;

    protected $table = 'mst_syarat_ki';

    protected $fillable = [
        'mst_ki_id',
        'nama',
        'tipe',
        'value',
        'urutan',
    ];

    protected $casts = [
        'wajib_diisi' => 'boolean',
        'value' => 'array',
    ];

    public function mstKi()
    {
        return $this->belongsTo(MstKi::class, 'mst_ki_id');
    }
}
