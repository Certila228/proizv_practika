<?php

class m240513_091000_create_parameters_table extends CDbMigration
{
	public function up()
	{
		 $this->createTable('parameters',[
			'id' => 'pk',
			'name'=> 'VARCHAR(10) NOT NULL',
			'symbol'=>'VARCHAR(10)',
			'description'=>'VARCHAR(10)',
			'unit'=>'VARCHAR(10)',
		 ]);
	}

	public function down()
	{
		$this->dropTable('parameters');
	}

}