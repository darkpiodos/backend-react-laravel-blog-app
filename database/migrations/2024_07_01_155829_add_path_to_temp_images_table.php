<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('temp_images', function (Blueprint $table) {
            $table->string('path'); // Add 'path' column
        });
    }

    public function down()
    {
        Schema::table('temp_images', function (Blueprint $table) {
            $table->dropColumn('path'); // Drop 'path' column if rolling back
        });
    }
};
