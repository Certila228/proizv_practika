<?php

class m240513_091000_new_table_parameters extends CDbMigration
{
	public function up()
	{
		 $this->createTable('parameters',[
			'id' => 'pk',
			'name'=> 'VARCHAR NOT NULL',
			'symbol'=>'VARCHAR',
			'description'=>'VARCHAR',
			'unit'=>'VARCHAR(10)',
		 ]);
	}

	public function down()
	{
		
	}

}