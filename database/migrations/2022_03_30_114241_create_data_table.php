<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_create');
            $table->dateTime('due_date');
            $table->string('carp_code');
            $table->string('category');
            $table->string('initiator');
            $table->string('initiator_div');
            $table->string('initiator_branch');
            $table->string('recipient');
            $table->string('recipient_div');
            $table->string('recipient_branch');
            $table->string('verified_by');
            $table->string('effectiveness');
            $table->dateTime('status_date');
            $table->string('stage');
            $table->string('status');
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
        Schema::dropIfExists('data');
    }
}
