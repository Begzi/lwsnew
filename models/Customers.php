<?php


namespace app\models;


use yii\db\ActiveRecord;

class Customers extends ActiveRecord
{
    public static function tableName()
    {
        return 'customers';
    }
}