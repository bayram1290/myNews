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
        Schema::create('news_views', function (Blueprint $table) {
            $table->unsignedInteger('news_id');
            $table->string('session_id');
            $table->string('author_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void  {
        Schema::dropIfExists('news_views');
    }
};
