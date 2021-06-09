<?php


namespace app\controllers;


use app\models\Customers;
use app\models\CustomersForm;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class CustomersController extends Controller
{
    public function actionIndex()
    {
        $query = Customers::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4]);
        $customers = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('customers', 'pages'));
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
//        if (Yii::$app->user->identity->username != 'admin') {
//            return $this->actionError();
//        }
        $model = new CustomersForm();
        if ($model->load(Yii::$app->request->post())) {

            Yii::$app->session->setFlash('contactFormSubmitted');
//            $customers = Customers::find()->all();
            $cumstomer = new Customers();
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
            $cumstomer->fullname = $model->fullname;
            $cumstomer->shortname = $model->shortname;
            $cumstomer->address = $model->address;
            $cumstomer->description = $model->description;
            $cumstomer->save();



            return $this->refresh();
        }
        return $this->render('add', [
            'model' => $model,
        ]);

    }
    public function actionView($id)
    {
        $customer = Customers::findOne($id);
//        $customer = $customers[0];
//        if (Yii::$app->user->identity->username == 'admin') {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//        }
        $uzs = $customer->uzs;
        $cert = $customer->cert;
        return $this->render('view', [
            'customer' => $customer,
            'uzs' => $uzs,
            'cert' => $cert,

            ]);
    }
}