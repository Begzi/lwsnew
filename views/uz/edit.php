<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use kartik\date\DatePicker;
use yii\web\View;
use app\models\UzsForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Uzs ADD';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <div class="uz_list_add">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php if (Yii::$app->session->hasFlash('uzlistFormSubmitted')): ?>

            <div class="alert alert-success">
                You write Customer. You can continue to write a new Customer.
            </div>


        <?php endif; ?>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'uz-list-form']); ?>

                <?= $form->field($model, 'type_id')
                    ->dropDownList($type,  ['options'=>[$uz->type_id =>['Selected'=>true]]]);
                ?>

                <?= $form->field($model, 'net_id')
                    ->dropDownList($net,  ['options'=>[$uz->net_id =>['Selected'=>true]]]);
                ?>

                <?= $form->field($model, 'supply_time')->widget(DatePicker::className(),[
                    'name' => 'dp_1',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['value' => date('Y-m-d', strtotime($uz->supply_time))],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-MM-dd',
                        'autoclose'=>true,
                        'weekStart'=>1, //неделя начинается с понедельника
                        'startDate' => '01.05.2015', //самая ранняя возможная дата
                        'todayBtn'=>true, //снизу кнопка "сегодня"
                    ]
                ]); ?>

                <?php $model->number_for_add = 1 ?>

                <div class="form-group">

                </div>
                <p type="text" id="customer_description">
                    <?
                    if ($uz['description'] == NULL){
                        echo ('Примечания отсутствуют.');
                    }
                    else {
                        echo ($uz['description']);
                    }
                    $text = preg_replace( "#<br />#", "\n", $uz->description );
                    $uz->description = $text;
                    // при вводе примечания не выводились и знак следующей строки!
                    ?>
                </p>
                <?= $form->field($model, 'description')->textarea(['class' => "form-control",
                    'style'=>"resize:vertical",
                    'value'=>$uz->description
                ]);?>




                <div class="form-group">
                    <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary', 'name' => 'uzs-add-button']) ?>
                    <?= Html::a('Отмена изменений', ['/customers/view', 'id' => $uz->customers->id], ['class'=>'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
    <div class="col-md-4 col-md-offset-4">
        <?= Html::a('Удалить узел', ['/uz/delete', 'id' => $uz->id], ['class'=>'btn btn-primary']) ?>

    </div>
</div>



<!--            <div class="form-group">-->
<!--                --><?//= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'customers-add-button']) ?>
<!--                --><?php
//                Modal::begin([
//                    'header' => '<h2>Hello world</h2>',
//                    'toggleButton' => [
//                        'label' => 'Добавить узел',
//                        'tag' => 'button',
//                        'class' => 'btn btn-primary'
//                    ],
//                    'footer' => 'Низ окна',
//                ]);
//
//                echo 'Say hello...';
//
//                Modal::end();
//                ?>
<!--            </div>-->
