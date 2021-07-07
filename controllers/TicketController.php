<?php
namespace app\controllers;


use app\models\Customers;
use yii\web\Controller;

class TicketController extends Controller
{
    public function actionIndex($customer_id)
    {
        $query = Customers::find()->all();
        $k=1;
        foreach ($query as $value){
            $value->doc_type_id = $k;
            $value->save();
        }
    }
}