<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToIssuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('issues', function(Blueprint $table)
		{
			$table->tinyInteger('priority')->after('description')->default(2);
			$table->tinyInteger('status')->after('description')->default(1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('issues', function(Blueprint $table)
		{
			//
		});
	}

}
