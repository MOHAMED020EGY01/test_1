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
            $table->string('name');
            $table->string('slug');
            $table->foreignId('stores_id')->constrained('stores')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('description')->unique();
            $table->integer('quantity')->unsigned()->default(0);
            $table->float('price')->unsigned()->default(0);
            $table->float('compare_price')->nullable()->unsigned()->default(0);
            $table->json('options')->nullable();
            $table->json('rating')->default(0);
            $table->boolean('featured')->default(0);
            $table->enum('state',['Active','draft','Inactive'])->default('Active');
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
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
