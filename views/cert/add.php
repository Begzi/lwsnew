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

        <?php for ($i = 0; $i < count($uzs); $i ++):?>
                <?=$form->field($model, 'serv1')->checkbox(['uncheck' => $uzs->id, 'value' => $uzs->id]) -> label($uzs->id); ?>

            <?php endfor?>
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsAddress[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'full_name',
                    'address_line1',
                    'address_line2',
                    'city',
                    'state',
                    'postal_code',
                ],
            ]); ?>

            <div class="form-group">
                <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'uzs-add-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>
            <?=$form->field($model, 'serv1')->checkbox(['checked'=>true])?>

        </div>
    </div>

</div>


