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
        Schema::table('students', function (Blueprint $table) {
            $table->string('fname')->after('id');
            $table->string('mname')->nullable()->after('fname');
            $table->string('lname')->after('mname');
            $table->string('contactno')->after('lname');
            $table->foreignId('degree_id')->nullable()->after('contactno')->constrained('degrees')->nullOnDelete();
            $table->foreignId('user_account_id')->nullable()->after('degree_id')->constrained('user_accounts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_account_id');
            $table->dropConstrainedForeignId('degree_id');
            $table->dropColumn([
                'fname',
                'mname',
                'lname',
                'contactno',
            ]);
        });
    }
};
