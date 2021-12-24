<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;
    protected $table = 'pertemuan';
    protected $fillable = [
        'pertemuan',
        'judul',
        'deskripsi',
        'mata_kuliah_id',
        'kontenVideo_id',
        'kontenDokumen_id'
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'kontenVideo_id' => 'array',
        'pertemuan' => 'integer',
        'kontenDokumen_id' => 'array',
        'mata_kuliah_id' => 'integer',
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id', 'id');
    }

    public function video()
    {
        return $this->belongsTo(KontenVideo::class, 'kontenVideo_id', 'id');
    }

    public function dokumen()
    {
        return $this->belongsTo(KontenDokumen::class, 'kontenDokumen_id', 'id');
    }
    
    public function get_userAssignment()
    {
        return $this->hasMany(UserAssignment::class);
    }

    // public function setVideoAttribute($value)
    // {
    //     $this->attributes['kontenVideo_id'] = json_encode($value);
    // }

    // public function getVideoAttribute($value)
    // {
    //     return $this->attributes['kontenVideo_id'] = json_decode($value);
    // }

    // public function setDokumenAttribute($value)
    // {
    //     $this->attributes['kontenDokumen_id'] = json_encode($value);
    // }

    // public function getDokumenAttribute($value)
    // {
    //     return $this->attributes['kontenDokumen_id'] = json_decode($value);
    // }
}
