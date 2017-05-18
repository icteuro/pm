<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEndTimeStartTimeTimesheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('timesheets', function(Blueprint $table)
		{
			$table->dateTime('start_time')->change();
			$table->dateTime('end_time')->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('timesheets', function(Blueprint $table)
		{
			//
		});
	}

}
