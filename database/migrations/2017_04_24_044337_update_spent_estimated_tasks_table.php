<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSpentEstimatedTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tasks', function(Blueprint $table)
		{
			$table->float('estimated_hour')->change();
			$table->float('spent_hour')->change();
			$table->dateTime('estimated_start_date')->change();
			$table->dateTime('estimated_end_date')->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tasks', function(Blueprint $table)
		{
			$table->integer('estimated_hour')->change();
			$table->integer('spent_hour')->change();
		});
	}

}
