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

    public function getCertUz()
    {

        return $this->hasOne(CertUz::class, ['cert_id' => 'id']);
    }

//embed.src = 'scans/'+customer_id+'/'+uz_id+'/'+sc_link+'.'+scanfile_format+'';
//скан доставался в прошлом сайте
}