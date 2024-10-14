<?php

use App\Models\Supply;
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
        Schema::create('supply_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Supply::class)->constrained()->cascadeOnDelete();
            $table->integer('total_quantity');
            $table->integer('total_used');
            $table->integer('total_added');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_histories');
    }
};
