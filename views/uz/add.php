<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\web\View;
use app\models\UzsForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Uzs ADD';
$this->params['breadcrumbs'][] = $this->title;

?>
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


            <?= $form->field($model, 'type_id')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'net_id')->textInput(['autofocus' => true])  ?>

            <?= $form->field($model, 'support_a')->textInput(['autofocus' => true]) ?>

            <?php $model->number_for_add = 1 ?>




            <div class="form-group">
                <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'uzs-add-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
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
