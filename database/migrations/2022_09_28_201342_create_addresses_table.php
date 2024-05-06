<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->foreignId('province_id')->constrained();
            $table->foreignId('municipality_id')->nullable()->constrained();
            $table->integer('postal_code');
            $table->string('address');
            $table->string('house_number')->nullable();
            $table->string('completion_address')->nullable();
            $table->double('latitude', 10, 8)->nullable();
            $table->double('longitude', 11, 8)->nullable();
            $table->boolean('is_invoiceable')->default(1);
            $table->boolean('is_default')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('addresses');

        Schema::enableForeignKeyConstraints();
    }
}
