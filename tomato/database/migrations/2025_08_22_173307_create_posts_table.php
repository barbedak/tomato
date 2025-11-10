<?php

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->index()->nullable()->constrained('categories');
            $table->foreignId('profile_id')->index()->nullable()->constrained('profiles');
            $table->text('body')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedInteger('views')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('status')->nullable();

            $table->index(['published_at', 'profile_id']);

            $table->softDeletes();

            $table->unique(['profile_id', 'title']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
