<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use app\models\CertForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
$this->title = 'Uzs ADD';
$this->params['breadcrumbs'][] = $this->title;
$tmp=Array();
?>

<div class="container">
    <div class="cert_add">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php if (Yii::$app->session->hasFlash('certFormSubmitted')): ?>

            <div class="alert alert-success">
                You write Cert. You can continue to write a new Customer.
            </div>


        <?php endif; ?>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'uz-list-form']); ?>



                <?= $form->field($model, 'num')->textInput(['autofocus' => true])  ?>

                <?= $form->field($model, 'st_date')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'sc_link')->fileInput(['autofocus' => true]); ?>

                <?= $form->field($model, 'scanfile_format')->textInput(['autofocus' => true])  ?>


                <?php $model->customer_id = $customer_id ?>

                <?php for($i=0; $i < count($uzs); $i++):?>
                    <?php $tmp[$uzs[$i]->id] = $uzs[$i]->uztype->name;;?>
                <?php endfor;?>
                <?= $form->field($model, 'uzs_box[]')->
                checkboxList($tmp);?>

                <div class="form-group">
                    <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'uzs-add-button']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>

