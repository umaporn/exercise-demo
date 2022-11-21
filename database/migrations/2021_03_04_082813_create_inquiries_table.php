<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 254);
            $table->string('phone', 20);
            $table->text('message');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('need_on_site_service', [true, false])->nullable();
            $table->text('address')->nullable();
            $table->timestamp('updated_at');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiries');
    }
}
