<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCompanies extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('website')->nullable();
            $table->string('jalan')->default('');
            $table->string('provinsi')->default('');
            $table->string('kota')->default('');
            $table->string('kode_pos')->nullable();
            $table->string('nib')->default('');
            $table->string('npwp')->default('');
            $table->string('akta')->default(''); // path file
            $table->string('tdp')->default(''); // path file
            $table->string('nama_hrd')->default('');
            $table->string('telepon_hrd')->default('');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'website',
                'jalan',
                'provinsi',
                'kota',
                'kode_pos',
                'nib',
                'npwp',
                'akta',
                'tdp',
                'nama_hrd',
                'telepon_hrd',
            ]);
        });
    }
}
