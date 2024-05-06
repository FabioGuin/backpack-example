<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('code')->unique();
            $table->string('name')->index();
            $table->string('surname')->index();
            $table->string('company')->index();
            $table->string('vat', 11)->unique()->nullable();
            $table->string('tax_code', 16)->unique()->nullable();
            $table->string('pec')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_number_alt')->nullable();
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

        Schema::dropIfExists('customers');

        Schema::enableForeignKeyConstraints();
    }
}
