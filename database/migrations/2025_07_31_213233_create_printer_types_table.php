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
        Schema::create('printer_types', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name'); // Printer type name
            $table->string('protocol'); // Communication protocol
            $table->boolean('status')->default(1); // Active/inactive
            $table->text('description')->nullable(); // Optional description
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printer_types');
    }
};
