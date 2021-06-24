<?php


namespace app\models;


use yii\base\Model;

class CertForm extends Model
{
    public $customer_id;
    public $num;
    public $st_date;
    public $ex_date;
    public $uz_id;
    public $sc_link;
    public $scan_file_format;
    public $number_for_add_uzs;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['num', 'customer_id', 'st_date', 'ex_date', 'uz_id', '$sc_link','scan_file_format','number_for_add_uzs'], 'required'],

//            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }
}