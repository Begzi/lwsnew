<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use app\models\CastomersForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Customers ADD';
$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="container">
    <div class="customers_add">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php if (Yii::$app->session->hasFlash('HaveUHHFormSubmitted')): ?>

            <div class="alert alert-success">
                Организация с таким ИНН существует
            </div>



        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('WrongUHHFormSubmitted')): ?>

            <div class="alert alert-success">
                Не правильно введён ИНН
            </div>



        <?php endif; ?>


        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'customers-form']); ?>

                <?= $form->field($model, 'fullname')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'shortname')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'address')->textInput(['autofocus' => true])  ?>

                <?= $form->field($model, 'description')->textInput() ?>

                <?= $form->field($model, 'UHH')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'doc_type_id')
                ->dropDownList([
                '1' => 'Электронный',
                '2' => 'Бумажный',
                ],
                [
                'prompt' => 'Выберите один вариант'
                ]);?>
                <div class="form-group">
                    <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'customers-add-button']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>