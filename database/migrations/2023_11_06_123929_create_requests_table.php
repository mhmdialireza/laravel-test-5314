<?php

use App\Enums\Urgency;
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
            $table->boolean('has_manager_approved');
            $table->boolean('has_supervisor_approved');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('urgency', array_column(Urgency::cases(), 'value'));
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