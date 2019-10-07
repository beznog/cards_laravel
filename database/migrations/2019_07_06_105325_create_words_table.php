<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('morpheme_id')->unsigned()->index()->nullable()->default(NULL);
            $table->bigInteger('word_type_id')->unsigned()->index()->nullable()->default(NULL);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            
            $table->foreign('word_type_id')
              ->references('id')->on('word_types')
              ->onDelete('cascade');

            $table->foreign('morpheme_id')
              ->references('id')->on('morphemes')
              ->onDelete('cascade');

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
        Schema::dropIfExists('words');
    }
}
