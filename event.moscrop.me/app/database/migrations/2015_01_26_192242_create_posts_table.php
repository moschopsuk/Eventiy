<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_posts', function($table)
		{
			$table->bigIncrements('id');
			$table->smallInteger('user_id');
			$table->smallInteger('event_id');
			$table->string('type');
			$table->morphs('postable');
			$table->timestamps();
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
		Schema::drop('event_posts');
	}

}
