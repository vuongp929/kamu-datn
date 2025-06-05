<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('stars')->unsigned(); // từ 1 đến 5
            $table->text('content')->nullable(); // nội dung đánh giá
            $table->timestamps();

            $table->unique(['user_id', 'product_id']); // mỗi user chỉ đánh giá 1 lần
        });
    }

    public function down(): void {
        Schema::dropIfExists('ratings');
    }
};
