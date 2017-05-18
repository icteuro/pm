<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timesheets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title',255);
			$table->text('description');
			$table->integer('user_id');
			$table->integer('project_id');
			$table->integer('task_id');
			$table->integer('issue_id');
			$table->dateTime('start_time');
			$table->dateTime('end_time');
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
		Schema::drop('timesheets');
	}

}
