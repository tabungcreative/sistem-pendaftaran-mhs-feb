<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skripsi', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->foreign('tahun_ajaran_id')
                    ->references('id')->on('tahun_ajaran');
            $table->string('judul');
            $table->string('pembimbing1');
            $table->string('pembimbing2');
            $table->string('file_berkas')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_transkrip')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('file_kk')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('file_lembar_bimbingan')->nullable();
            $table->string('file_pembayaran_semester')->nullable();
            $table->string('file_pembayaran_skripsi')->nullable();
            $table->string('file_sertifikat')->nullable();
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
        Schema::dropIfExists('skripsi');
    }
};
