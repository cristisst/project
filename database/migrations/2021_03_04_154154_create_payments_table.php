<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('body_name');
            $table->string('organisation_unit');
            $table->string('expense_category');
            $table->bigInteger('expenditure_code');
            $table->date('date')->nullable();
            $table->string('transaction_number');
            $table->decimal('amount', 20, 2)->default(0);
            $table->string('supplier_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
