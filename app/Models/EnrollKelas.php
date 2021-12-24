<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollKelas extends Model
{
    use HasFactory;
    protected $table = 'enroll_kelas';
    protected $fillable = [
        'user_id',
        'kelas_id',
        'iscomplete',
        // 'kategori,'
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'iscomplete' => 'boolean',
        'user_id' => 'integer',
        'kelas_id' => 'integer',
    ];

    public function enroll_mata_kuliah()
    {
        return $this->hasMany(Enrolls::class);
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
}
