<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryCirculationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_circulation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('circulation_book_id');
            $table->string('circulation_name')->nullable();
            $table->string('circulation_utype')->nullable();
            $table->integer('circulation_members_id');
            $table->double('circulation_penalty')->nullable();
            $table->string('circulation_due_date')->nullable();
            $table->string('circulation_date_borrowed')->nullable();
            $table->string('circulation_date_returned')->nullable();
            $table->tinyInteger('circulation_status')->default(0);
            $table->tinyInteger('circulation_deleted')->default(0);
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
        Schema::dropIfExists('library_circulation');
    }
}
