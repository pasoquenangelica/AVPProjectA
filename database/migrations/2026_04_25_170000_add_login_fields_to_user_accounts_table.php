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
        Schema::table('user_accounts', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->string('email')->unique()->after('username');
            $table->string('password')->after('email');
            $table->string('role')->default('student')->after('password');
            $table->boolean('is_active')->default(true)->after('role');
            $table->boolean('must_change_password')->default(false)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'email',
                'password',
                'role',
                'is_active',
                'must_change_password',
            ]);
        });
    }
};
