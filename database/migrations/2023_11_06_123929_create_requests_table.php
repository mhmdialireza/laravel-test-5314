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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 32);
            $table->string('description', 256);
            $table->boolean('has_manager_approved')->default(false);
            $table->boolean('has_supervisor_approved')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('importance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
