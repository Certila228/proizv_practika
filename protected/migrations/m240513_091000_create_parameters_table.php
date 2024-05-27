<?php

class m240513_091000_create_parameters_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('parameters', [
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'symbol' => 'string NOT NULL',
            'description' => 'string',
            'unit' => 'string NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('parameters');
    }
}
