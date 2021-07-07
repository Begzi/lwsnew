<?php


namespace app\controllers;


use app\models\Customers;
use app\models\CustomersForm;
use phpDocumentor\Reflection\Types\Array_;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class CustomersController extends Controller{
    public function actionIndex() {
        $query = Customers::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 15]);
        $customers = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('customers', 'pages'));
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionView($id){
        function build_sorter($key) {
            return function ($a, $b) use ($key) {
                return strnatcmp($a[$key], $b[$key]);
            };
        }

        $model = new CustomersForm();
        if ($model->load(Yii::$app->request->post())) {
            $customer_tmp = new Customers();
            $customer_tmp->fullname = $model->fullname;
            $customer_tmp->shortname = $model->shortname;
            $customer_tmp->address = $model->address;
            $customer_tmp->description = $model->description;
            $customer_tmp->UHH = $model->UHH;
            $customer_tmp->doc_type_id = $model->doc_type_id;
            $customer_tmp->save();

            $this->redirect(array('site/index'));

        }

        $customer = Customers::findOne($id);

//        $customer = $customers[0];
//        if (Yii::$app->user->identity->username == 'admin') {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//        }
        $uzs = $customer->uzs;
        $cert = $customer->cert;
        usort($uzs, build_sorter('type_id'));
        $tmp= [];
        $realuzs= [];
        $k=0;
        for ($i=0; $i < count($uzs); $i++){
            if (empty($tmp)){
                array_push($tmp,$uzs[$i]);
            }
            else{
                if ($uzs[$i]->type_id == $tmp[$k]->type_id){
                    array_push($tmp,$uzs[$i]);
                    $k++;
                }
                else{
                    array_push($realuzs,$tmp);
                    $tmp=[];
                    $k=0;
                    $i=$i-1;
                }

            }
        }
        array_push($realuzs,$tmp);
        return $this->render('view', [
            'customer' => $customer,
            'realuzs' => $realuzs,
            'cert' => $cert,
            'model' => $model,
            ]);
    }

    public function actionAdd() {
//        if (Yii::$app->user->identity->username != 'admin') {
//            return $this->actionError();
//        }
        $model = new CustomersForm();
        if ($model->load(Yii::$app->request->post())) {

            Yii::$app->session->setFlash('contactFormSubmitted');
//            $customers = Customers::find()->all();
            $cumstomer = new Customers();
            $cumstomer->fullname = $model->fullname;
            $cumstomer->shortname = $model->shortname;
            $cumstomer->address = $model->address;
            $cumstomer->description = $model->description;
            $cumstomer->UHH = $model->UHH;
            $cumstomer->doc_type_id = $model->doc_type_id;
            $cumstomer->save();

            $query = Customers::find()->where(['fullname' => $model->fullname])->all();

            $this->redirect(array('customers/view', 'id'=>$query[0]['id']));
        }
        return $this->render('add', [
            'model' => $model,
        ]);

    }

    public function actionSearchfull(){

        $search = Yii::$app->request->get('search');

        $search1 = str_replace(' ','', $search);

        $query = Customers::find()->where(['like', 'replace(fullname, " ", "")', $search1]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 15]);
        $customers = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', [
            'customers' => $customers,
            'pages' => $pages,
            'searchfull' => $search1
        ]);

    }
    public function actionSearchshort(){

        $search = Yii::$app->request->get('search');

        $search1 = str_replace(' ','', $search);

        $query = Customers::find()->where(['like', 'replace(fullname, " ", "")', $search1]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 15]);
        $customers = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', [
            'customers' => $customers,
            'pages' => $pages,
            'searchshort' => $search1
        ]);

    }
}