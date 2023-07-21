<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')->constrained('vendors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedTinyInteger('beds_count');
            $table->decimal('price_per_night', 10, 0, true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
