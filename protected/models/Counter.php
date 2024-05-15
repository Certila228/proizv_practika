<?php
class Counter extends CActiveRecord
{
    public function tableName()
    {
        return 'counters';
    }

    public function rules()
    {
        return array(

            array('name,created_at,updated_at','required'),
            array('name','length','max'=>255),
        );
    }

    public function attributeLabels()
    {
        return array(
        'id'=>'ID',
		'name'=>'Name',
		'created_at' => 'Created_ad',
        'updated_at' => 'Updated_at'
        );
    }


    public function relations()
    {
        return array(
            'measurements' => array(self::HAS_MANY, 'Measurement', 'counter_id'),
        );
    }



    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
?>