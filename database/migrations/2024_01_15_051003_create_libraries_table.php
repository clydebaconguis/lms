<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('library_orgname')->nullable();
            $table->string('library_name');
            $table->string('library_email')->nullable();
            $table->string('library_phone')->nullable();
            $table->string('library_website')->nullable();
            $table->string('library_department')->nullable();
            $table->integer('library_manager')->nullable();
            $table->string('library_incharge')->nullable();
            $table->string('library_asst')->nullable();
            $table->tinyInteger('library_status')->nullable();
            $table->tinyInteger('deleted')->default(0);
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
        Schema::dropIfExists('libraries');
    }
}
