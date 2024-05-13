<?php

class m240513_100324_new_table_mesurements extends CDbMigration
{
    public function up()
    {
        $this->createTable('measurements', [
            'id' => 'pk',
            'timestamp' => 'timestamp DEFAULT CURRENT_TIMESTAMP',
            'type_id' => 'int',
            'value' => 'decimal(10,2)',
        ]);

        
        $this->addForeignKey('fk_measurements_type_id', 'measurements', 'type_id', 'new_table_mesurements', 'polis_id');

    }

    public function down()
    {
        
        $this->dropForeignKey('fk_measurements_type_id', 'measurements');

       
        $this->dropTable('measurements');
    }
}
