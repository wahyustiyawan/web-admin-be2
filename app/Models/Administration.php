<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;
    protected $table = 'administration';
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'email',
        'prodi',
        'tahun_ajar',
        'semester',
        'alamat_domisili',
        'alamat_ktp',
        'no_hp',
        'tempat_lahir',
        'tgl_lahir',
        'kelamin',
        'kebutuhan_khusus',
        'tinggal',
        'pembiayan',
        'nama_ayah',
        'nama_ibu',
        'kerja_ayah',
        'kerja_ibu',
        'pekerjaan',
        'penghasilan',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'pakta_integritas',
        'scan_ktp',
        'scan_kk',
        'scan_ijazah',
        'pas_foto',
        'transkip',
        'surat_rekomendasi',
        'program',
        'isVerified'
    ];

    protected $primaryKey = 'id';
    protected $casts = ['kebutuhan_khusus'=> 'array'];

}