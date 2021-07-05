<?php


namespace app\models;


use yii\base\Model;

class CertForm extends Model
{
    public $customer_id;
    public $num;
    public $st_date;
    public $sc_link;
    public $scanfile_format;
    public $number_for_add_uzs;
    public $uzs_box = array();


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['num', 'uzs_box', 'customer_id', 'st_date', 'sc_link','scanfile_format','number_for_add_uzs'], 'required'],

//            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }
}