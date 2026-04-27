<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            // ✅ Step 1: Drop foreign key first
            $table->dropForeign(['task_id']);

            // ✅ Step 2: Now drop the column
            $table->dropColumn('task_id');

            // ✅ Ensure blog_id exists
            if (!Schema::hasColumn('payments', 'blog_id')) {
                $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
            }

            // ✅ Ensure payment_reference exists
            if (!Schema::hasColumn('payments', 'payment_reference')) {
                $table->string('payment_reference')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('task_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }
};
