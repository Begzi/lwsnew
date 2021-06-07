<?php


namespace app\controllers;


use app\models\UzForm;
use app\models\Uzs;
use Yii;
use yii\web\Controller;

class UzController extends Controller
{
    public function actionAdd($customer_id)
    {
//        if (Yii::$app->user->identity->username != 'admin') {
//            return $this->actionError();
//        }
        $model = new UzForm();
        if ($model->load(Yii::$app->request->post())) {

            Yii::$app->session->setFlash('uzlistFormSubmitted');
//            $customers = Customers::find()->all();
            $uz = new Uzs();
//            for ($i = 0; $i < count($customers); $i++) {
//                if ($customers[$i]['name'] == $model->name && $customers[$i]['brand'] == $model->brand) {
//                    $cumstomer->number = $customers[$i]['number'] + 1;
//                    $cumstomer->name = $customers[$i]['name'];
//                    $cumstomer->brand = $customers[$i]['brand'];
//                    $cumstomer[$i]->delete();
//                    $cumstomer->save();
//                    return $this->refresh();
//                }
//            }
            $uz->customer_id = $customer_id;
            $uz->type_id = $model->type_id;
            $uz->net_id = $model->net_id;
            $uz->support_a = $model->support_a;
            $uz->save();



            return $this->refresh();
        }
        return $this->render('add', [
            'model' => $model,
        ]);
    }
}