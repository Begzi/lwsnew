<?php


namespace app\models;


use yii\db\ActiveRecord;

class Uzs extends ActiveRecord
{
    public static function tableName()
    {
        return 'uz_list';
    }
    public function getCustomers()
    {
        return $this->hasOne(Customers::class, ['id' => 'customer_id']);
    }

    public function getCert()
    {
        return $this->hasMany(Cert::class, ['uz_id' => 'id']);
    }
    public function getCertUz()
    {
        return $this->hasMany(CertUz::class, ['uz_id' => 'id']);
    }
}