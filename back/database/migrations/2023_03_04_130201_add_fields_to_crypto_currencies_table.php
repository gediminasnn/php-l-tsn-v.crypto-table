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
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->string('name');
            $table->string('symbol')->unique();
            $table->decimal('price', 18, 2);
            $table->bigInteger('market_cap');
            $table->decimal('percent_change_24h', 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->removeColumn("name");
            $table->removeColumn("symbol");
            $table->removeColumn("price");
            $table->removeColumn("market_cap");
            $table->removeColumn("percent_change_24h");
        });
    }
};
