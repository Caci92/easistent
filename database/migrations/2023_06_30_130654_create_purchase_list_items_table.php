<?php

use App\Models\PurchaseList;
use App\Models\User;
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
        Schema::create('purchase_list_items', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreignIdFor(PurchaseList::class);
            $table->foreignIdFor(User::class);
            $table->dateTime('completed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_list_items');
    }
};
