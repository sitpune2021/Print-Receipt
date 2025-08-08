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
        Schema::create('printers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('printer_type_id')->constrained('printer_types')->onDelete('cascade');
            $table->string('mac_address');
            $table->string('model');
            $table->string('display_name');
            $table->foreignId('registered_by')->constrained('users')->onDelete('cascade');
            $table->date('registration_date');

            $table->timestamps();

            // 🔐 Unique MAC address per user
            $table->unique(['registered_by', 'mac_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printers');
    }
};
