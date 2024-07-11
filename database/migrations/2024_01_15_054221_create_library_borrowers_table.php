<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_borrowers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('borrower_userid');
            $table->string('borrower_cardno');
            $table->string('borrower_name');
            $table->string('borrower_class');
            $table->string('borrower_email');
            $table->string('borrower_phone');
            $table->string('borrower_username');
            $table->string('borrower_password');
            $table->tinyInteger('borrower_status')->default(0);
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
        Schema::dropIfExists('library_borrowers');
    }
}
