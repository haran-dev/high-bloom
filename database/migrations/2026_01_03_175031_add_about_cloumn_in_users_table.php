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
        Schema::table('users', function (Blueprint $table) {
            $table->text('about')->nullable()->after('email');
            $table->string('job')->nullable()->after('about');
            $table->text('country')->nullable()->after('job');
            $table->text('address')->nullable()->after('country');
            $table->text('phone')->nullable()->after('address');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['about', 'job', 'country', 'address', 'phone']);
        });
    }
};
