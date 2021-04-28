<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_type_id')->nullable();
            $table->unsignedBigInteger('company_sector_id')->nullable();
            $table->unsignedBigInteger('company_industry_id')->nullable();
            $table->string('code')->nullable();
            $table->char('cnpj', 14)->nullable();
            $table->string('name');
            $table->string('trend_name')->nullable();
            $table->string('site')->nullable();
            $table->unsignedBigInteger('employees_number')->nullable();
            $table->unsignedBigInteger('company_address_id')->nullable();

            $table->string('environment');
            $table->string('database');
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
