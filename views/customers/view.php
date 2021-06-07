<?php
$this->title = 'Customer';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
//Лучше тут и индиекса кидать сам обьект, а не тольно её ИД и искать её в action


?>
<div class="col-md-12">
    <div class="col-md-3">
        <div class="single-auto">

            <h3><?php echo $customer['fullname'] ?></h3>
            <h4><span>Brand: <?php echo $customer['shortname'] ?></span></h4>
            <p>How much: <?php echo $customer['address'] ?></p>
        </div>
    </div>
    <?php
//    if (Yii::$customer->session->hasFlash('contactFormSubmitted')): ?>
<!--        <a href="--><?//= \yii\helpers\Url::to(['/auto/delete','id' => $customer['id']])?><!--" >-->
<!--            Delete this auto-->
<!--        </a>-->
<!---->
<!---->
<!--    --><?php //endif; ?>
</div>
<div class="col-md-12">
    <div class="col-md-3">
    <a href="<?= \yii\helpers\Url::to(['/uz/add','customer_id' => $customer['id']])?>" >
        Add
    </a>
    <div class="form-group">
        <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'customers-add-button']) ?>
        <!--ХЗ КАК РАБОТАЕТ ЭТА ЧЁРТОВА КНОПК!-->
    </div>
    </div>
</div>