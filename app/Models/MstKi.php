<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstKi extends Model
{
    use HasFactory;

    protected $table = 'mst_ki';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function syarat()
    {
        return $this->hasMany(MstSyaratKi::class, 'mst_ki_id')->orderBy('urutan');
    }

    public function usulan()
    {
        return $this->hasMany(TrxUsulanKi::class, 'mst_ki_id');
    }
}
