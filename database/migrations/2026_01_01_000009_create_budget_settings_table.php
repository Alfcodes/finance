<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained();
            $table->decimal('monthly_income', 12, 2)->default(0);
            $table->json('categories');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_settings');
    }
};
