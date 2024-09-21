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
        Schema::create(config('laravel-reactions.table', 'reactions'), function (Blueprint $table) {
            $table->id();

            $userForeignType = config('laravel-reactions.user.foreign_key_type', 'id');
            $userForeignName = config('laravel-reactions.user.foreign_key');
            $userForeignTableName = config('laravel-reactions.user.table');

            if ($userForeignType === 'ulid') {
                $table->foreignUlid($userForeignName)
                    ->nullable()
                    ->constrained($userForeignTableName)
                    ->nullOnDelete();
            } else if ($userForeignType === 'uuid') {
                $table->foreignUuid($userForeignName)
                    ->nullable()
                    ->constrained($userForeignTableName)
                    ->nullOnDelete();
            } else {
                $table->foreignId($userForeignName)
                    ->nullable()
                    ->constrained($userForeignTableName)
                    ->nullOnDelete();
            }

            $table->morphs('reactable');
            $table->string('type');
            $table->string('ip')->nullable();

            $table->unique([$userForeignName, 'reactable_type', 'reactable_id', 'ip'], 'reaction_user_name_per_ip');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('laravel-reactions.table', 'reactions'));
    }
};
