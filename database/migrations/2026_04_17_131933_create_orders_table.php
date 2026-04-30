<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Shared\Enums\OrderStatus;
use Shared\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('number')->unique();
            $table->string('status')->default(OrderStatus::PENDING)->index();
            $table->integer('total');
            $table->timestamps();

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
