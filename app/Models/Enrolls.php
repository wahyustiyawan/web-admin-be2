<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\UserVideo;
use app\Models\UserDokumen;

class Enrolls extends Model
{
    use HasFactory;
    protected $table = 'enrolls';
    protected $fillable = [
        'user_id',
        'mata_kuliah_id',
        'enroll_kelas_id',
        'iscomplete',
        // 'kategori,'
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'iscomplete' => 'boolean',
        'user_id' => 'integer',
        'mata_kuliah_id' => 'integer',
        'enroll_kelas_id' => 'integer',
    ];

    public function get_dokumen()
    {
    	return $this->hasMany(userDokumen::class);
    }

    public function get_video()
    {
    	return $this->hasMany(userVideo::class);
    }

    public function get_kelas()
    {
    	return $this->belongsTo(Kelas::class);
    }

    public function mata_kuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }

    public function enroll_kelas()
    {
        return $this->belongsTo(EnrollKelas::class, 'enroll_kelas_id', 'id');
    }
}
