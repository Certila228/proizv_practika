<?php

class m240515_090853_add_counter_id_to_measurements_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('measurements', 'counter_id', 'INTEGER');

		$this->addForeignKey('fk_counter_id', 'measurements', 'counter_id', 'counters', 'id');
	}

	public function down()
	{
		$this->dropForeignKey('fk_counter_id', 'measurements', 'counter_id', 'counters', 'id');
		$this->dropColumn('measurements', 'counter_id',);

		
	}


}