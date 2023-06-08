<?php

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photo_user', function (Blueprint $table) {
            $table->foreignIdFor(Photo::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->index(['photo_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_user', function (Blueprint $table) {
            $table->dropForeignIdFor(Photo::class);
            $table->dropForeignIdFor(User::class);
            $table->drop('photo_user');
        });
    }
};
