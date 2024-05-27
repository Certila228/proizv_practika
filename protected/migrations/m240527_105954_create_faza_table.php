<?php

class m240527_105954_create_faza_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('parameters', 'faza', 'INTEGER');

	}

	public function down()
	{
		$this->dropColumn('parameters', 'faza',);

	}

	
}