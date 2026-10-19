<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        Schema::create(config('expo-notifications.database.tokens_table_name', 'expo_tokens'), function (Blueprint $table) use ($driver) {
            $table->id();

            $table->morphs('owner');
            $value = $table->string('value');
            if ($driver === 'mysql') {
                $value->charset('ascii')->collation('ascii_bin');
            }

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('expo-notifications.database.tokens_table_name', 'expo_tokens'));
    }
};
