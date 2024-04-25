<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visionaries', function (Blueprint $table) {
            $table->id();
            $table->string('LoyaltyNo');
            $table->unsignedInteger('LoyaltyPoints');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visionaries');
    }
};
