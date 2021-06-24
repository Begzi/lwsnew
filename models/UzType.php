<?php


namespace app\models;


use yii\db\ActiveRecord;

class UzType extends ActiveRecord
{
    public static function tableName()
    {
        return 'uz_type';
    }

    public function getUzs()
    {
        return $this->hasOne(Uzs::class, ['type_id' => 'id']);
    }
}