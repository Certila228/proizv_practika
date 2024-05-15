<?php

class Parameter extends CActiveRecord
{
    public function tableName()
    {
        return 'parameters';
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
            'id' => 'ID',
            'name' => 'Name',
            'symbol' => 'Symbol',
            'description' => 'Description',
            'unit' => 'Unit',
        );
    }

    public function relations()
    {
        return array(
            'measurements' => array(self::HAS_MANY, 'Measurement', 'parameter_id'),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
?>
