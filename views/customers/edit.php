<?php

use app\models\CastomersForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Customers DESCRIPTION';
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

                <?= $form->field($model, 'fullname')->textInput(['autofocus' => true, 'value'=>$customer->fullname])->label('Полное имя учреждения') ?>

                <?= $form->field($model, 'shortname')->textInput(['autofocus' => true, 'value'=>$customer->shortname])->label('Короткое имя учреждения')?>

                <?= $form->field($model, 'address')->textInput(['autofocus' => true, 'value'=>$customer->address])->label('Юридический аддресс')  ?>

                <?= $form->field($model, 'description')->textInput([ 'value'=>$customer->description])->label('Примеучание') ?>

                <?= $form->field($model, 'UHH')->textInput(['autofocus' => true, 'value'=>$customer->UHH])->label('ИНН')?>

                <?= $form->field($model, 'doc_type_id')
                    ->dropDownList([
                        '1' => 'Электронный',
                        '2' => 'Бумажный',
                    ],
                        ['options'=>[$customer['doc_type_id']=>['Selected'=>true]]]);?>
                <div class="form-group">
                    <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'customers-add-button']) ?>
                    <?= Html::a('Отмена изменений', ['/customers/view', 'id' => $customer['id']], ['class'=>'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

        <?= Html::a('Объеденить заказчиков', ['/customers/association', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>

    </div>
</div>