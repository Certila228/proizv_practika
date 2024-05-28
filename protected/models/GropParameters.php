<?php

/**
 * @property integer $id
 * @property string $name
 */

class GropParameters extends CActiveRecord
{
    public function tableName()
    {
        return 'GropParameters';
    }

    public function rules()
    {
        return array(
            array('name', 'required'),
            array('id', 'numerical', 'integerOnly' => true),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
        );
    }

    public function relations()
    {
        return array(
            'parameter' => array(self::BELONGS_TO, 'Parameter', 'parameter_id'),
        );
    }
}