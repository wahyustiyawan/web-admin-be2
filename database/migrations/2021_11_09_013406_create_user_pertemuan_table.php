<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserpertemuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pertemuan', function (Blueprint $table) {
            $table->id();
            $table->integer('progress');
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("enrolls_id")->constrained("enrolls")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("pertemuan_id")->constrained("pertemuan")->onDelete("cascade")->onUpdate("cascade");
            $table->boolean('iscomplete')->default(false);
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
        Schema::dropIfExists('userpertemuan');
    }
}
