<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->string('owner_type')->nullable();
            $table->index(['owner_id', 'owner_type']);
        });
    }
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropIndex(['owner_id', 'owner_type']);
            $table->dropColumn(['owner_id', 'owner_type']);
        });
    }
};
