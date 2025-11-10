<?php

use App\Models\Comment;
use App\Models\Profile;
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
        Schema::create('comment_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->index()->constrained('comments');
            $table->foreignId('profile_id')->index()->constrained('profiles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_profile');
    }
};
