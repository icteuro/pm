<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdToFilemanager extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('file_manager', function($table) {
			$table->integer('project_id');
			$table->integer('task_id');
			$table->integer('issue_id');
			$table->dropColumn('related_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('file_manager', function($table) {
			$table->dropColumn('project_id');
			$table->dropColumn('task_id');
			$table->dropColumn('issue_id');
			$table->integer('related_id');
		});
	}

}
