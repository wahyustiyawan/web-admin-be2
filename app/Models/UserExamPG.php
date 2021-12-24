<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExamPG extends Model
{
    use HasFactory;
    protected $table = 'user_exampg';
    protected $fillable = [
        'user_id',
        'mata_kuliah_id',
        'exam_id',
        'soal',
        'jawaban'
    ];

    
    protected $primaryKey = 'id';

    
    protected $casts = [
        'user_id' => 'integer',
        'mata_kuliah_id' => 'integer',
        'exam_id' => 'integer',
    ];

}
