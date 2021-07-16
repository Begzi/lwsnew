<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use kartik\date\DatePicker;
use app\models\ContactForm;
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
                    ->dropDownList($type);
                ?>

                <?= $form->field($model, 'net_id')
                    ->dropDownList($net);
                ?>

                <?= $form->field($model, 'supply_time')->widget(DatePicker::className(),[
                    'name' => 'dp_1',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['placeholder' => 'Ввод даты...'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-MM-dd',
                        'autoclose'=>true,
                        'weekStart'=>1, //неделя начинается с понедельника
                        'startDate' => '01.05.2015', //самая ранняя возможная дата
                        'todayBtn'=>true, //снизу кнопка "сегодня"
                    ]
                ]); ?>

                <?= $form->field($model, 'number_for_add')->textInput(['autofocus' => true, 'value' => 1]) ?>




                <div class="form-group">
                    <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'uzs-add-button']) ?>
                    <?= Html::a('Отмена', ['/customers/view','id' => $customer_id], ['class'=>'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>

