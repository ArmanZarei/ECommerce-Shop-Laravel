<?php

use App\Models\Coupon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code');
            $table->text('description')->nullable();
            $table->enum('type', Coupon::ALL_TYPES);
            $table->unsignedInteger('amount')->nullable();
            $table->unsignedTinyInteger('percentage')->nullable();
            $table->unsignedInteger('max_percentage_amount')->nullable();
            $table->timestamp('expired_at');

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
        Schema::dropIfExists('coupons');
    }
}
