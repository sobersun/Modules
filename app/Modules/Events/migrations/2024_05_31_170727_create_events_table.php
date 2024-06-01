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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('method', 10);
            $table->string('url', 255);
            $table->string('model_class', 255);
            $table->string('event', 10);
            $table->unsignedBigInteger('model_id')->nullable();
            $table->longText('attribute_data')->nullable();
            $table->text('extra')->nullable();
            $table->unsignedBigInteger('state_id')->default(1);
            $table->unsignedBigInteger('type_id')->default(0);
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
