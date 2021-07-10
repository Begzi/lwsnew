<?php


namespace app\controllers;


use app\models\Cert;
use app\models\CertForm;
use app\models\CertUz;
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
//            $tmp = Array();
//            Yii::$app->session->setFlash('uzlistFormSubmitted');
//            for ($i=0; $i < count($model->uzs_box); $i++) {
//                $tmp[] = $model->uzs_box[$i];
//            }
//            return $this->render('check', [
//                'model' => $model->uzs_box
//            ]);
//            $customers = Customers::find()->all();
            $cert = new Cert();

            $cert->num = $model->num;
            $cert->st_date = $model->st_date;
            $cert->sc_link = $model->sc_link;

            if (date('m-d', strtotime($cert->st_date)) == '01-01'){
                $cert->ex_date = date('Y-m-d', strtotime(''.$cert->st_date.'+1 year - 1 day'));
            }
            else {
                $cert->ex_date = date('Y-m-d', strtotime(''.$cert->st_date.'+1 year'));
            }

            $cert->scanfile_format = $model->scanfile_format;
            $cert->customer_id = $customer_id;
            $cert->save();


            $cert =  Cert::find()->where(['num' => $model->num])->all();
            for ($i = 0; $i < count($model->uzs_box); $i++){
                $certuz = new CertUz();
                $certuz->cert_id = $cert[0]->id;
                $certuz->uz_id = $model->uzs_box[$i];
                $certuz->save();
            }

            return $this->redirect(array('customers/view', 'id'=>$customer_id));


        }
        $uzs =  Uzs::find()->where(['customer_id' => $customer_id])->all();
        return $this->render('add', [
            'model' => $model,
            'customer_id' => $customer_id,
            'uzs' => $uzs,
        ]);
    }

}