<?php

class m240513_100324_create_mesurements_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('measurements', [
            'id' => 'pk',
            'timestamp' => 'timestamp DEFAULT CURRENT_TIMESTAMP',
            'parameter_id' => 'int',
            'value' => 'decimal(10,2)',
        ]);

        
        $this->addForeignKey('fk_measurements_type_id', 'measurements', 'parameter_id', 'parameters', 'id');

    }

    public function down()
    {
        
        $this->dropForeignKey('fk_measurements_type_id', 'measurements');

       
        $this->dropTable('measurements');
    }
}
