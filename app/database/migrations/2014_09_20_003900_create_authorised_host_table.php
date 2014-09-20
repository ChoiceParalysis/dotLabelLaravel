<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorisedHostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authorised_host', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('ipaddress', 16)->unique();
			$table->smallInteger('subnet')->nullable();
			$table->text('description')->nullable();
			$table->timestamps();
			$table->tinyInteger('enabled');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('authorised_host');
	}

}
