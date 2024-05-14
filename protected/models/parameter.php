<?php

class Parameter extends CActiveRecord
{
    public function tableName()
    {
        return 'create_parameters_table';
    }

    public function rules()
    {
        return array(
            array('name, unit', 'required'),
            array('name, symbol, description', 'length', 'max' => 255),
            array('unit', 'length', 'max' => 10),
        );
    }

    public function attributeLabels()
    {
        return array(
            'parameter_id' => 'Parameter ID',
            'name' => 'Name',
            'symbol' => 'Symbol',
            'description' => 'Description',
            'unit' => 'Unit',
        );
    }

    public function relations()
    {
        return array(
            'measurements' => array(self::HAS_MANY, 'Measurement', 'type_id'),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
?>
