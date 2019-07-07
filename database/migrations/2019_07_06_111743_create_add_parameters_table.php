<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('word_id');

            $table->char('article_type', 20)
                ->nullable(true);
            $table->string('plural')
                ->nullable(true);

            $table->boolean('reflexive')
                ->nullable(true);
            $table->string('preposition')
                ->nullable(true);
            $table->char('modal_verb', 20)
                ->nullable(true);
            $table->char('regularity', 20)
                ->nullable(true);
            $table->string('prasens')
                ->nullable(true);
            $table->string('prateritum')
                ->nullable(true);
            $table->string('partizip')
                ->nullable(true);

            $table->integer('importance')
                ->nullable(true);
            $table->integer('complexity')
                ->nullable(true);
            $table->integer('knowledge')
                ->nullable(true);
            
            $table->string('examples')
                ->nullable(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('word_id')
                  ->references('id')->on('words')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_parameters');
    }
}
