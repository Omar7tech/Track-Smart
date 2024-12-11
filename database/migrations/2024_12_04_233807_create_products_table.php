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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("barcode")->nullable()->unique();
            $table->string("name");
            $table->unsignedBigInteger("category_id");
            $table->unsignedInteger("quantity")->default(0);
            $table->date("expiry_date")->nullable();
            $table->decimal("cost", 10, 2)->default(0.00);
            $table->decimal("price", 10, 2)->default(0.00);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
