<?php


namespace app\models;


use yii\db\ActiveRecord;

class CertUz extends ActiveRecord
{
    public static function tableName()
    {
        return 'cert_uz';
    }
    public function getNewcert()
    {
        return $this->hasOne(NewCert::class, ['id' => 'cert_id']);
    }

    public function getUzs()
    {
        return $this->hasOne(Cert::class, ['id' => 'uz_id']);
    }
}