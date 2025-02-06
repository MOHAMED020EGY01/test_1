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
        Schema::create('profiles', function (Blueprint $table) {
            $table->string('frist_name');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('last_name');
            $table->string('birthday')->nullable();
            $table->enum('gender',['male','female']);
            $table->char('country',2);
            $table->char('locale',2)->default('en');
            /**
             * char => هيحجز العدد ال انت هتحطه طيب لو حطيت مثلا قل هيحجز نفس الرقم مثال 
             * مثال 
             * 
             * 255 max 
             * and element == 2 
             * size = 255 
             * 
             * varchar max = 255 
             * and elemnt = 2 
             * size 4 ?! اقل عدد يحجزه الفار كار هو 4 
             * 
             * طيب لو عملت 2 
             * فار كار هيحجز 4 
             * 
             * اما كار 
             * هيحجز 2 
             * 
             */
            $table->primary('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
