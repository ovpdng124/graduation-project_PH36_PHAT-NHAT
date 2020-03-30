<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableModifyVoucherIsSaleSalePriceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_sale')->nullable()->change();
            $table->float('sale_price')->nullable()->change();
            $table->unsignedBigInteger('voucher_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_sale')->change();
            $table->float('sale_price')->change();
            $table->unsignedBigInteger('voucher_id')->change();
        });
    }
}
