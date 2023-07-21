<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('room_special_property', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')
                ->constrained('rooms')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('special_property_id')
                ->constrained('special_properties')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('value', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_special_property');
    }
};
