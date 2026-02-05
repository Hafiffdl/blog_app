<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstFaq extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_faq';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
