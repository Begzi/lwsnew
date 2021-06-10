<?php


namespace app\controllers;


use app\models\Cert;
use app\models\Customers;
use app\models\NewCert;
use yii\data\Pagination;
use yii\web\Controller;

class NewcertController extends Controller
{
    public function actionIndex()
    {
        $cert = Cert::find()->asArray()->all();
        $customers = Customers::find()->asArray()->all();
        for ($i = 0; $i < count($cert); $i++)
        {
            $newcert = new NewCert();
            $query = NewCert::find()->where(['num' => $cert[$i]['num']])->one();
            if ($query == null)
            {
                $newcert->id = $cert[$i]['id'];
                $newcert->num = $cert[$i]['num'];
                $newcert->ex_date = $cert[$i]['ex_date'];
                $newcert->st_date = $cert[$i]['st_date'];
                $newcert->sc_link = $cert[$i]['sc_link'];
                $newcert->scanfile_format = $cert[$i]['scanfile_format'];
                $newcert->customer_id = $cert[$i]['customer_id'];
                $newcert->save();
                //newcert ничего нет внутри. ДУмать как в новые передавать!

            }

        }
        return $this->render('index', compact('customers'));
    }
}