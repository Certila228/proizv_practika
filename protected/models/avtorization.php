<?php
class Avtorization  extends CActiveRecord
{
    public function tableName()
    {
        return 'avtorization';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
?>