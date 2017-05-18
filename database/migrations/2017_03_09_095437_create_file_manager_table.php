<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileManagerTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('file_manager', function(Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->integer('type'); //1 = project, 2 = task, 3 = issue, 4 = others
            $table->integer('related_id'); //if available
            $table->integer('created_by');  //user_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('file_manager');
    }

}
