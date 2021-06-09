<?php


namespace app\models;


use yii\db\ActiveRecord;

class Cert extends ActiveRecord
{
    public static function tableName()
    {
        return 'cert';
    }
    public function getCustomer()
    {
        return $this->hasOne(Customers::class, ['id' => 'customer_id']);
    }
    public function getUzs()
    {

        return $this->hasOne(Uzs::class, ['id' => 'uz_id']);
    }
}