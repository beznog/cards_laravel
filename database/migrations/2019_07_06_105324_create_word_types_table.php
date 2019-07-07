<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateWordTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('word_type', 20);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::table('word_types')
            ->insert([
                'id' => NULL,
                'word_type' => 'noun',
                'created_at' => NULL,
                'updated_at' => NULL
            ]);
        DB::table('word_types')
            ->insert([
                'id' => NULL,
                'word_type' => 'verb',
                'created_at' => NULL,
                'updated_at' => NULL
            ]);
        DB::table('word_types')
            ->insert([
                'id' => NULL,
                'word_type' => 'adjective',
                'created_at' => NULL,
                'updated_at' => NULL
            ]);
        DB::table('word_types')
            ->insert([
                'id' => NULL,
                'word_type' => 'other',
                'created_at' => NULL,
                'updated_at' => NULL
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('word_types');
    }
}
