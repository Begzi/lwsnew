<?php


namespace app\models;


use yii\db\ActiveRecord;

class Customers extends ActiveRecord
{
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUzs()
    {
        return $this->hasMany(Uzs::class, ['customer_id' => 'id']);
    }
    public function getCert()
    {
        return $this->hasMany(Cert::class, ['customer_id' => 'id']);
    }
}