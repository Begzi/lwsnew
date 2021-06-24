<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use app\models\CertForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Uzs ADD';
$this->params['breadcrumbs'][] = $this->title;
?>
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

            <?= $form->field($model, 'ex_date')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'uz_id')->textInput(['autofocus' => true])  ?>

            <?= $form->field($model, 'sc_link')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'scan_file_format')->textInput(['autofocus' => true])  ?>

            <?= $form->field($model, 'number_for_add_uzs')->textInput(['autofocus' => true]) ?>

            <?php $model->customer_id = $customer_id ?>




            <div class="form-group">
                <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'uzs-add-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>


