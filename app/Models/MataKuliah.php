<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliah';
    protected $fillable = [
        'judul',
        'deskripsi',
        'sks',
        'kategori_id',
        'kelas_id',
        'kode',
    ];

    protected $primaryKey = 'id';
    protected $casts = [
        'kategori_id' => 'integer',
        'kelas_id' => 'integer',
        'sks' => 'integer',
    ];
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id', 'id');
    }

    public function get_dokumen()
    {
    	return $this->hasMany(KontenDokumen::class);
    }

    public function get_video()
    {
    	return $this->hasMany(KontenVideo::class);
    }

    // public function video()
    // {
    //     return $this->belongsTo(KontenVideo::class, 'kontenVideo_id', 'id');
    // }

    // public function dokumen()
    // {
    //     return $this->belongsTo(KontenDokumen::class, 'kontenDokumen_id', 'id');
    // }

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id', 'id');
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
