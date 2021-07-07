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
    public function getNewcert() //пользовался когда то можно удалять
    {
        return $this->hasMany(NewCert::class, ['customer_id' => 'id']);
    }
    public function getDoctype()
    {
        return $this->hasOne(Doc::class, ['id' => 'doc_type_id']);
    }
}