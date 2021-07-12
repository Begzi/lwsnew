<?php


namespace app\controllers;


use app\models\Cert;
use app\models\CertUz;
use app\models\Customers;
use app\models\NewCert;
use app\models\Uzs;
use yii\data\Pagination;
use yii\web\Controller;

class NewcertController extends Controller
{
    public function actionIndex()//надо чтобы сам создавал NewCert записи, он пока не может
    {
        $cert = Cert::find()->asArray()->all();
        $customers = Customers::find()->asArray()->all();
        $k = 1;
        for ($i = 0; $i < count($cert); $i++)
        {
            $query = NewCert::find()->where(['num' => $cert[$i]['num']])->one();
            if ($query == null)
            {
                $newcert = new NewCert();
                $newcert->id = $k;
                $newcert->num = $cert[$i]['num'];
                $newcert->ex_date = $cert[$i]['ex_date'];
                $newcert->st_date = $cert[$i]['st_date'];
                $newcert->sc_link = $cert[$i]['sc_link'];
                $newcert->scanfile_format = $cert[$i]['scanfile_format'];
                $newcert->customer_id = $cert[$i]['customer_id'];
                $newcert->save();
                //newcert ничего нет внутри. ДУмать как в новые передавать!
                $k++;

            }

        }
        $cert = NewCert::find()->asArray()->all();
        return $this->render('index', compact('customers', 'cert'));
    }
    public function actionCheck()// перед использованием этой кнопки нужно использовать кнопку выше, сертификаты привести в нормальный вид и потом их же и использовать
        //надо будет newcert переименовать в обычный cert. Очень важно
    {
        $cert = Cert::find()->asArray()->all();
        $newcert = NewCert::find()->asArray()->all();
        $customers = Customers::find()->asArray()->all();
        $uzs = Uzs::find()->asArray()->all();


        for ($i = 0; $i < count($cert); $i++)
        {
            for ($j = 0; $j < count($uzs); $j++)
            {
                if ($cert[$i]['uz_id'] == $uzs[$j]['id'])
                {
                    $query = NewCert::find()->where(['num' => $cert[$i]['num']])->one();
                    $certuzs = new CertUz();
                    $certuzs->cert_id = $query->id;
                    $certuzs->uz_id = $uzs[$j]['id'];
                    $certuzs->save();
                }
            }
        }


        return $this->render('check', compact('customers'));
    }
    public function actionKatya()
    {
        $uzs = Uzs::find()
            ->where(['net_id' => 2])
            ->all();

        return $this->render('katya', compact('uzs'));
    }

    public function actionKonstantin()
    {
        $customer = Customers::find()
            ->all();
        $check1='Красноярск,';
        $check2='Красноярск ';
        $check3='Красноярск.';
        $uzs = array();
        for ($i=0; $i < count($customer); $i++){

            $pos1 = strripos($customer[$i]->address, $check1);
            $pos2 = strripos($customer[$i]->address, $check2);
            $pos3 = strripos($customer[$i]->address, $check3);

            if ($pos1 === true or $pos2 === true or $pos3 === true ){
                array_merge($uzs, $customer->uzs);
            }

        }
        return $this->render('konstantin', compact('uzs', 'customer'));
    }
    public function actionNewcertuz()
    {
        $uzs = Uzs::find()->all();
        foreach ($uzs as $value){
            $value->support_a = $value->certuz[count($value->certuz) - 1]->cert->id;
            $value->save();
        }
        return $this->redirect(array('customers/index'));
    }
}