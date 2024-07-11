<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('book_qty');
            $table->string('book_isbn');
            $table->string('book_edition')->nullable();
            $table->string('book_title');
            $table->text('book_description')->nullable();
            $table->string('book_received')->nullable();
            $table->string('book_callnum')->nullable();
            $table->string('book_copyright')->nullable();
            $table->string('book_img')->nullable();
            $table->double('book_price');
            $table->integer('book_genre');
            $table->string('book_author')->nullable();
            $table->integer('book_category');
            $table->string('book_publisher')->nullable();
            $table->string('library_branch');
            $table->integer('book_available');
            $table->tinyInteger('book_status')->default(0);
            $table->tinyInteger('book_deleted')->default(0);
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
        Schema::dropIfExists('library_books');
    }
}
