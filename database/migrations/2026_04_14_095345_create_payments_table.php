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
  
        // Schema::create('payments', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('task_id')->constrained()->cascadeOnDelete();
        //     $table->decimal('amount',8,2)->default(1000); // price per task
        //     $table->string('status')->default('success');
        //     $table->timestamps();

        //     $table->unique(['user_id','task_id']); // prevent double payment
        // });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
            $table->string('payment_reference')->nullable();
            $table->timestamps();
            $table->unique(['user_id','blog_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('task_id');
        });
    }

};
