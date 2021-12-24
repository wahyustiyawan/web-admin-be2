<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $fillable = [
        'user_id',
        'tipe',
        'mata_kuliah_id',
        'nilai',
    ];
    protected $casts = [
        'user_id' => 'integer',
        'mata_kuliah_id' => 'integer',
        'nilai' => 'integer',
    ];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
