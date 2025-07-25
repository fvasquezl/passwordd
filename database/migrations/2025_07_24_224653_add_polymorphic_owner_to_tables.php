<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Eliminado: no agregar campos polimórficos


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('owner_id');
            $table->dropColumn('owner_type');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });

        Schema::table('credentials', function (Blueprint $table) {
            $table->dropColumn('owner_id');
            $table->dropColumn('owner_type');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('owner_id');
            $table->dropColumn('owner_type');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }
};