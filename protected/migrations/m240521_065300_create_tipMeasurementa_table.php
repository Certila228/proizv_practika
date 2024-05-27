<?php

class m240521_065300_create_tipMeasurementa_table extends CDbMigration
{
	public function up()
    {
        $parameters = [
            ['name' => 'voltage', 'symbol' => 'Uф', 'description' => 'Фазное напряжение', 'unit' => 'В'],
            ['name' => 'current', 'symbol' => 'I', 'description' => 'Сила тока', 'unit' => 'А'],
            ['name' => 'activePower', 'symbol' => 'P', 'description' => 'Активная мощность', 'unit' => 'кВт'],
            ['name' => 'reactivePower', 'symbol' => 'Q', 'description' => 'Реактивная мощность', 'unit' => 'кВАр'],
            ['name' => 'powerFactor', 'symbol' => 'cosφ', 'description' => 'Коэффициент мощности', 'unit' => "р"],
            ['name' => 'angle', 'symbol' => '∠', 'description' => 'Угол между фазными напряжениями', 'unit' => '°'],
            ['name' => 'frequency', 'symbol' => 'F', 'description' => 'Частота сети', 'unit' => 'Гц'],
        ];

        $this->insertMultiple('parameters', $parameters);
    }

    public function down()
    {
        $this->delete('parameters', "name IN ('voltage', 'current', 'activePower', 'reactivePower', 'powerFactor', 'angle', 'frequency')");
    }

}
?>