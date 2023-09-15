<?php

use App\Traits\Database\Migration as DatabaseMigration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use DatabaseMigration;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->decimal('old_price', 8, 2);
            $table->decimal('cost', 8, 2)->nullable();
            $table->string('type');
            $table->string('sku')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->unsignedBigInteger('security_stock')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('order')->nullable();
            $this->addSeoFields($table);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skus');
    }
};
