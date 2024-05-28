<?php

class m240528_084338_create_id_grupParameters_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('parameters','gropParameters_id','INTEGER');
		$this->addForeignKey('fk_grop_parameters_parameter_id','parameters', 'gropParameters_id', 'GropParameters', 'id' );
    }
	

	public function down()
	{
		$this->dropForeignKey('fk_grop_parameters_parameter_id','parameters' );
		$this->dropColumn('parameters','gropParameters_id');
    }
	
}