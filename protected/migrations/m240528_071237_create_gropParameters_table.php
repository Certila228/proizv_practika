<?php

class m240528_071237_create_gropParameters_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('GropParameters', [
            'id' => 'pk',
            'name' => 'string NOT NULL',
        ]);
	}

	public function down()
	{
		$this->dropTable('GropParemeters');
	}


}