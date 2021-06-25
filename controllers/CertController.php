<?php


namespace app\controllers;


use app\models\CertForm;
use app\models\Uzs;
use Yii;
use yii\web\Controller;

class CertController extends Controller
{
    public function actionAdd($customer_id)
    {
//        if (Yii::$app->user->identity->username != 'admin') {
//            return $this->actionError();
//        }
        $model = new CertForm();
        if ($model->load(Yii::$app->request->post())) {

            Yii::$app->session->setFlash('uzlistFormSubmitted');
//            $customers = Customers::find()->all();
            $uz = new Cert();
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


            $this->redirect(array('customers/view', 'id'=>$customer_id));
        }
        $uzs =  Uzs::find()->where(['customer_id' => $customer_id])->all();
//        $uzs = $customer_id->uzs;
        for ($i = 0; $i < count($uzs); $i++){
            array_push($model->check_box, $uzs[$i]);
        }
        return $this->render('add', [
            'model' => $model,
            'customer_id' => $customer_id,
            'uzs' => $uzs,
        ]);
    }

}