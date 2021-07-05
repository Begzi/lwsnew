<?php


namespace app\models;


use yii\db\ActiveRecord;

class UzNet extends ActiveRecord
{
    public static function tableName()
    {
        return 'net_list';
    }

    public function getUzs()
    {
        return $this->hasOne(Uzs::class, ['net_id' => 'id']);
    }
}