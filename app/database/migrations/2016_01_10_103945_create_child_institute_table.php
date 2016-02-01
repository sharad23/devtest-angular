<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChildInstituteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('child_institute', function(Blueprint $table)
		{  
			$table->engine = 'MYISAM';
			$table->increments('id');
			$table->integer('child_id');
			$table->integer('institute_id');
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
		Schema::drop('child_institute');
	}

}
