<?php

class m240515_072150_create_counter_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('counters', [
			'id'=>'pk',
			'name'=>'VARCHAR(10)  NOT NULL',
			'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
        ]);
	}

	public function down()
	{
		$this->dropTable('counters');
	}

	
}