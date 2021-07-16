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

        $customer = Customers::findOne($id);
        $model = new CustomersForm();
    // Изменение описания и тип обмена документооборота
        if ($model->load(Yii::$app->request->post())) {
            if ($model->doc_type_id == NULL) {
                $customer->description = $model->description;
                $customer->save();
            } elseif ($model->description == NULL) {
                $customer->doc_type_id = $model->doc_type_id;
                $customer->save();
            }
        }

        $customer = Customers::findOne($id);

        $text = preg_replace( "#\r?\n#", "<br />", $customer->description );
        $customer->description = $text;
        // при вывводе примечания выводились и знак следующей строки!


        $uzs = $customer->uzs;
        usort($uzs, build_sorter('type_id'));
        $date = date('Y-m-d ', time());
        $tmp= [];
        $realuzs= [];
        $k=0;
        // делёшься узлов по типу
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
                    array_push($tmp,$uzs[$i]);
                }

            }
        }
        array_push($realuzs,$tmp);

        $date = Yii::$app->formatter->asDate( time());
        $date_check=[];
        $date_k = 0;
        $date_l = 0;
        for ($i = 0; $i < count($realuzs); $i++) {
            for ($j = 0; $j < count($realuzs[$i]); $j++) {
                $check_tmp =  Yii::$app->formatter->asDate( $realuzs[$i][$j]->actualcert->ex_date);
                if ($check_tmp) {
                    if (strtotime($date) < strtotime( $check_tmp)) {
                        $date_k++;
                    }
                }
            }
            if (($realuzs[$i][0]->type_id == 0 or $realuzs[$i][0]->type_id == 2 or $realuzs[$i][0]->type_id == 3 or
                $realuzs[$i][0]->type_id == 4 or $realuzs[$i][0]->type_id == 9 or $realuzs[$i][0]->type_id == 11 or
                $realuzs[$i][0]->type_id == 14 or $realuzs[$i][0]->type_id == 15 or $realuzs[$i][0]->type_id == 16)
            && ($date_k < count($realuzs[$i])))
            {
                for ($j = 0; $j < count($realuzs[$i]); $j++) {
                    $check_tmp =  Yii::$app->formatter->asDate( $realuzs[$i][$j]->actualcert->ex_date);
                    if ($check_tmp) {
                        if (strtotime($date) < strtotime( $check_tmp)) {
                            $date_k++;
                        }
                        elseif (strtotime( Yii::$app->formatter->asDate( $realuzs[$i][$j]->supply_ex_time)) >
                            strtotime($date)){
                            $date_l++;
                        }
                    }
                }
            }
            if ($date_k == count($realuzs[$i])) {
                array_push( $date_check, 'У всех узлов действуюдщие сертификаты');
            } elseif ($date_k == 0) {
                if ($date_l > 0){
                    array_push( $date_check,  'У всех узлов нет сертификатов, но есть на базовой гарантии');
                }
                else{
                    array_push( $date_check,  'У всех узлов нет действующих сертификатов');
                }
            } else {
                if ($date_l > 0){
                    array_push( $date_check, 'У некоторых узлов нет действующих сертификатов, и есть на базовой гарантии');
                }
                else{
                    array_push( $date_check, 'У некоторых узлов нет действующих сертификатов');
                }
            }
            $date_k = 0;


        }

        return $this->render('view', [
            'customer' => $customer,
            'realuzs' => $realuzs,
            'date' => $date,
            'model' => $model,
            'date_check' => $date_check
            ]);
    }

    public function actionAdd() {
//        if (Yii::$app->user->identity->username != 'admin') {
//            return $this->actionError();
//        }
        $model = new CustomersForm();
        if ($model->load(Yii::$app->request->post())) {

            if (strlen(strval($model->UHH))== 12){
                Yii::$app->session->setFlash('WrongUHHFormSubmitted');
                return $this->render('add', [
                    'model' => $model,
                ]);

            }
            $query = Customers::find()->where(['UHH' => $model->UHH])->all();
            if ($query != NULL ){
                Yii::$app->session->setFlash('HaveUHHFormSubmitted');
                return $this->render('add', [
                    'model' => $model,
                ]);

            }
//            $customers = Customers::find()->all();
            $customer = new Customers();
            $customer->fullname = $model->fullname;
            $customer->shortname = $model->shortname;
            $customer->address = $model->address;
            $customer->description = $model->description;
            $customer->UHH = $model->UHH;
            $customer->doc_type_id = $model->doc_type_id;
            $customer->save();

            $query = Customers::find()->where(['fullname' => $model->fullname])->all();

            return $this->redirect(array('customers/view', 'id'=>$query[0]['id']));
        }
        return $this->render('add', [
            'model' => $model,
        ]);

    }

    public function actionEdit($id) {
//        if (Yii::$app->user->identity->username != 'admin') {
//            return $this->actionError();
//        }
        $customer = Customers::findOne($id);
        $model = new CustomersForm();
        if ($model->load(Yii::$app->request->post())) {

            if (strlen(strval($model->UHH))== 12){
                Yii::$app->session->setFlash('WrongUHHFormSubmitted');

                return $this->render('description', [
                    'model' => $model,
                    'customer' => $customer
                ]);

            }
            $query = Customers::find()->where(['UHH' => $model->UHH])->all();
            for ($i = 0; $i < count($query); $i++){
                if ($query[$i]->id != $customer->id ){
                    Yii::$app->session->setFlash('HaveUHHFormSubmitted');
                    return $this->render('edit', [
                        'model' => $model,
                    ]);

                }

            }
//            $customers = Customers::find()->all();
            $customer->fullname = $model->fullname;
            $customer->shortname = $model->shortname;
            $customer->address = $model->address;
            $customer->description = $model->description;
            $customer->UHH = $model->UHH;
            $customer->doc_type_id = $model->doc_type_id;
            $customer->save();

            $query = Customers::find()->where(['fullname' => $model->fullname])->all();

            return $this->redirect(array('customers/view', 'id'=>$query[0]['id']));
        }
        return $this->render('edit', [
            'model' => $model,
            'customer' => $customer
        ]);

    }
    public function actionSearchfull(){

        $search = Yii::$app->request->get('search');

        $search1 = str_replace(' ','', $search);

        $query = Customers::find()->orFilterWhere(['like', 'shortname', $search1])
            ->orFilterWhere(['like', 'fullname', $search1])
            ->orFilterWhere(['id'=> $search1]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 15]);
        $customers = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', [
            'customers' => $customers,
            'pages' => $pages,
            'searchfull' => $search1
        ]);

    }
    public function actionAssociation(){

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