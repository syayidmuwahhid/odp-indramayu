<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('title');
            $table->string('banner');
            $table->text('history');
            $table->string('icon');
            $table->text('description');
            $table->string('keywords');
            $table->string('tags');
            $table->string('facebook');
            $table->string('youtube');
            $table->string('x');
            $table->string('instagram');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
