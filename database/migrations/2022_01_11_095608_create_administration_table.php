<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administration', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan')->nullable();
            $table->string('nama_tengah')->nullable();
            $table->string('nama_akhir')->nullable();
            $table->string('nik')->nullable();
            $table->string('email')->nullable();
            $table->string('prodi')->nullable();
            $table->string('tahun_ajar')->nullable();
            $table->string('semester')->nullable();
            $table->string('alamat_domisili')->nullable();
            $table->string('alamat_ktp')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('tinggal')->nullable();
            $table->string('pembiaya')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('kerja_ayah')->nullable();
            $table->string('kerja_ibu')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('penghasilan')->nullable();
            $table->string('pakta_integritas')->nullable();
            $table->string('scan_ktp')->nullable();
            $table->string('scan_kk')->nullable();
            $table->string('scan_ijazah')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('transkip')->nullable();
            $table->string('surat_rekomendasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administration');
    }
}
