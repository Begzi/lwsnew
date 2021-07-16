<?php


namespace app\controllers;


use app\models\UzForm;
use app\models\UzNet;
use app\models\Uzs;
use app\models\UzType;
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
            $uz->supply_time = strval($model->supply_time);
            $uz->save();



            return $this->redirect(array('customers/view', 'id'=>$customer_id));
        }
        $query = UzType::find()->all();
        $type=Array();
        for ($i=0; $i < count($query); $i++){
            array_push($type,$query[$i]->name);
        }
        $query = UzNet::find()->all();
        $net=Array();
        for ($i=0; $i < count($query); $i++){
            array_push($net,$query[$i]->name);
        }
        return $this->render('add', [
            'model' => $model,
            'type' => $type,
            'net' => $net,
            'customer_id' => $customer_id
        ]);
    }
    public function actionEdit($id)
    {
//        if (Yii::$app->user->identity->username != 'admin') {
//            return $this->actionError();
//        }
        $model = new UzForm();

        $uz = Uzs::findOne($id);
        if ($model->load(Yii::$app->request->post())) {

            Yii::$app->session->setFlash('uzlistFormSubmitted');
//            $customers = Customers::find()->all();
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
            $uz->type_id = $model->type_id;
            $uz->net_id = $model->net_id;
            $uz->supply_time = strval($model->supply_time);
            if (date('m-d', strtotime(strval($model->supply_time))) == '01-01'){
                $uz->supply_ex_time = date('Y-m-d', strtotime(''.strval($model->supply_time).'+1 year - 1 day'));
            }
            else {
                $uz->supply_ex_time = date('Y-m-d', strtotime(''.strval($model->supply_time).'+1 year'));
            }
            $uz->description = $model->description;
            $uz->save();



            return $this->redirect(array('customers/view', 'id'=>$uz->customers->id));
        }
        $query = UzType::find()->all();
        $type=Array();
        for ($i=0; $i < count($query); $i++){
            array_push($type,$query[$i]->name);
        }
        $query = UzNet::find()->all();
        $net=Array();
        for ($i=0; $i < count($query); $i++){
            array_push($net,$query[$i]->name);
        }
        return $this->render('edit', [
            'model' => $model,
            'type' => $type,
            'net' => $net,
            'uz' => $uz
        ]);
    }
    public function actionManyadd($customer_id)
    {
//        if (Yii::$app->user->identity->username != 'admin') {
//            return $this->actionError();
//        }
        $model = new UzForm();
        if ($model->load(Yii::$app->request->post())) {

            Yii::$app->session->setFlash('uzlistFormSubmitted');
//            $customers = Customers::find()->all();
            for ($i=0; $i<$model->number_for_add; $i++) {
                $uz = new Uzs();
                $uz->customer_id = $customer_id;
                $uz->customers->uz_list_id = $uz->id;
                $uz->type_id = $model->type_id;
                $uz->net_id = $model->net_id;
                $uz->support_a = $model->support_a;
                $uz->save();


            }


            return $this->redirect(array('customers/view', 'id'=>$customer_id));
        }
        $query = UzType::find()->all();
        $type=Array();
        for ($i=0; $i < count($query); $i++){
            array_push($type,$query[$i]->name);
        }
        $query = UzNet::find()->all();
        $net=Array();
        for ($i=0; $i < count($query); $i++){
            array_push($net,$query[$i]->name);
        }
        return $this->render('manyadd', [
            'model' => $model,
            'type' => $type,
            'net' => $net,
            'customer_id' => $customer_id
        ]);
    }
    public function actionDelete($id){
        $uz = Uzs::findOne($id);
        $id = $uz->customers->id;
        $uz->delete();
        return $this->redirect(array('customers/view', 'id'=>$uz->customers->id));
    }

    public function actionDescription($id)
    {
        $uz = Uzs::findOne($id);
        $model = new UzForm();
        if ($model->load(Yii::$app->request->post())) {

            $uz->description = $model->description;
            $uz->save();

        }
        return $this->render('description', [
            'uz' => $uz,
            'model' => $model
        ]);
    }
}