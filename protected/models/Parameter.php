<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $symbol
 * @property string $description
 * @property string $unit
 */
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
        
            array('id, name, symbol, description, unit', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'measurements' => array(self::HAS_MANY, 'Measurement', 'parameter_id'),
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
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
?>

