<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesumaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('check_salesumaryday', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('saledete');
     		$table->string('customerid',6);
     		$table->string('productgroup',5);
     		$table->string('grade',10);
     		$table->string('customertype',15);
     		$table->integer('buy');
     		$table->integer('promotion');
     		$table->integer('qty');
     		$table->integer('price');
     		$table->integer('note');
     		$table->string('type',20);
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
		Schema::drop('check_salesumaryday');
	}

}
