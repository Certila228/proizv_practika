<?php

/**
 * @property int $id
 * @property string $timestamp
 * @property int $type_id
 * @property float $value
 */
class Measurement extends CActiveRecord
{
    public function tableName()
    {
        return 'measurements';
    }

    public function rules()
    {
        return array(
            array('timestamp, parameter_id, value', 'required'),
            array('parameter_id', 'exist', 'attributeName' => 'id', 'className' => 'Parameter'),
            array('timestamp', 'date', 'format' => 'yyyy-MM-dd hh:mm:ss'),
            array('value', 'numerical', 'integerOnly' => false, 'min' => 0, 'max' => 99999999.99),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'timestamp' => 'Timestamp',
            'parameter_id' => 'Type ID',
            'value' => 'Value',
        );
    }

    public function relations()
    {
        return array(
            'parameter' => array(self::BELONGS_TO, 'Parameter', 'parameter_id'),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
?>