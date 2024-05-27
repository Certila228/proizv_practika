<?php

class m240527_085753_create_avtorization_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('avtorization',[
			'id'=> 'INT AUTO_INCREMENT PRIMARY KEY',
			'session_id'=> 'VARCHAR(255) NOT NULL',
			'user_id'=> 'INT NOT NULL',
			'expires_at'=> 'TIMESTAMP NOT NULL',
			'created_at'=> 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
		]);
	}

	public function down()
	{
		$this->dropTable('avtorization');
	}

	
}