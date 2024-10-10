<?php

use App\Enum\EquipmentStatus;
use App\Enum\OperatingUnitAndProject;
use App\Enum\OrganizationUnit;
use App\Enum\Unit;
use App\Models\ResponsiblePerson;
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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ResponsiblePerson::class)->constrained();
            $table->enum('organization_unit', OrganizationUnit::values());
            $table->enum('operating_unit_project', OperatingUnitAndProject::values());
            $table->string('property_number')->unique();
            $table->integer('quantity');
            $table->enum('unit', Unit::values());
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date_acquired');
            $table->string('fund')->nullable();
            $table->string('ppe_class')->nullable();
            $table->string('estimated_useful_time')->nullable();
            $table->decimal('unit_price', 15, 2);
            $table->decimal('total_amount', 15, 2);
            $table->enum('status', EquipmentStatus::values());
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
