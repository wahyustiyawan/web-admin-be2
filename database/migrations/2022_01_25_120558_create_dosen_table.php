<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_dosen', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', [1,2,3])->default(3);
            // 1 => Academic & Career Expert
            // 2 => Administration & Regulation Expert 
            // 3 => Contract Lecturer & Content Creator Expert
            $table->string('alamat');
            $table->string('nidn');
            $table->string('ktp');
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
            $table->boolean('isVerified')->nullable();
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
        Schema::dropIfExists('dosen');
    }
}
