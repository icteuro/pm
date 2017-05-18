<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('issues', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('title',150);
                        $table->integer('project_id');
                        $table->integer('parent_task_id');
                        $table->integer('assigned_to');
                        $table->integer('estimated_hours');
                        $table->text('description');
                        $table->date('estimated_start_date');
                        $table->date('estimated_end_date');
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
		Schema::drop('issues');
	}

}
