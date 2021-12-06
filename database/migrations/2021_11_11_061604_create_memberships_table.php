<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('sex');
            $table->text('age');
            $table->text('phone')->unique();
            $table->text('national_number')->unique();
            $table->text('form_number')->unique();
            $table->text('state_id');
            $table->text('district');
            $table->text('joining_date');
            $table->text('qualification_id');
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
        Schema::dropIfExists('memberships');
    }
}
