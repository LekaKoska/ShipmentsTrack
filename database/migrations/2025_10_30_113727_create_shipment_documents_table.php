<?php

use App\Models\ShipmentDocuments;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(ShipmentDocuments::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipment')->cascadeOnDelete();
            $table->string('shipment_document');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists(ShipmentDocuments::TABLE);
    }
};
