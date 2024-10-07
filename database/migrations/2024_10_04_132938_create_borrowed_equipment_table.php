<?php

use App\Models\Equipment;
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
        Schema::create('borrowed_equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Equipment::class)->constrained();
            $table->string('borrower_first_name');
            $table->string('borrower_last_name');
            $table->string('borrower_email');
            $table->string('borrower_phone_number');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_returned');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowed_equipment');
    }
};
