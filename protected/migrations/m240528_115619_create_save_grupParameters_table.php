<?php

class m240528_115619_create_save_grupParameters_table extends CDbMigration
{
	public function up()
	{
		$GropParameters = [
            ['name' => 'voltage a'],
            ['name' => 'current'],
            ['name' => 'activePower'],
            ['name' => 'reactivePower'],
            ['name' => 'powerFactor'],
            ['name' => 'angle'],
            ['name' => 'frequency'],
        ];
		$this->insertMultiple('GropParameters', $GropParameters);
	}

	public function down()
	{
		echo "m240528_115619_create_save_grupParameters_table does not support migration down.\n";
		return false;
	}

	
}