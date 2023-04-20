<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->string('name', 255);
        $table->string('lastname', 255);
        $table->string('email', 255);
        $table->string('phone', 255);
        $table->string('dni', 255);
        $table->string('birthday');
	      $table->tinyInteger('status', 1)->default(0)->nullable(false);
        $table->longText('ticket');
        $table->integer('prize');
	      $table->string('lang', 2);
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
      Schema::dropIfExists('tickets');
    }
}
