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
        Schema::create('subscriber_subscribing', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('subscriber_id')->index()->constrained('profiles');
            $table->foreignId('subscribing_id')->index()->constrained('profiles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriber_subscribing');
    }
};
